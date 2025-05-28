<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequestItem;
use App\Models\MaintenanceRequestItemAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Str;
use App\Mail\MaintenanceRequestCreated;
use Illuminate\Support\Facades\Mail;
class MaintenanceRequestItemController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('list-maintenance-request-items')) {
            abort(403, 'Unauthorized');
        }
        $maintenanceRequestId = $request->query('maintenance_request_id');

        $items = MaintenanceRequestItem::with('attachments')->where('maintenance_request_id', $maintenanceRequestId)->get();

        return view('pages.maintenance-items.index', [
            'items' => $items,
            'maintenance_request_id' => $maintenanceRequestId
        ]);
    }

    public function create(Request $request)
    {
        $maintenanceRequestId = $request->query('maintenance_request_id');
        return view('pages.maintenance-items.create', [
            'maintenance_request_id' => $maintenanceRequestId
        ]);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('create-maintenance-request-items')) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'maintenance_request_id' => 'required|exists:maintenance_requests,id',
            'title' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'status' => 'required|in:waiting,first contact,started,in progress,finished,unable to complete,quoted',
            'attachments.*' => 'file|max:20480', // 20MB max per file
        ]);

        $item = MaintenanceRequestItem::create($validated);
        $mrid = $validated['maintenance_request_id'];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $originalName = $file->getClientOriginalName();
                $filename = 'mriid_' . $item->id . '_' . $originalName;
                $folder = 'attachments/mrid_' . $mrid;
                $path = $file->storeAs($folder, $filename, 'public');

                $item->attachments()->create([
                    'file_path' => $path,
                    'original_name' => $originalName,
                ]);
            }
        }

        // Prepare email data
        $attachments = $item->attachments->map(function ($att) {
            return [
                'file_path' => $att->file_path,
                'original_name' => $att->original_name,
            ];
        })->toArray();

        $emailData = [
            'building_name' => $item->maintenanceRequest->building->name,
            'company_name' => $item->maintenanceRequest->company->name,
            'status' => $item->status,
            'title' => $item->title,
            'tax_number' => $item->maintenanceRequest->building->tax_number,
            'description' => $item->remarks,
            'attachments' => $attachments,
        ];

        // Send email with try-catch
        try {
            Mail::to($item->maintenanceRequest->company->email)
                ->cc('geral@jamanutencoes.pt') // Replace with actual CC email
                ->send(new MaintenanceRequestCreated($emailData));

            \Log::info('Email Sent Successfully');

        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            // Optionally: return a warning message to frontend
        }

        return response()->json(['message' => 'Maintenance item created successfully']);
    }





    public function edit($id)
    {
        $item = MaintenanceRequestItem::with('attachments')->findOrFail($id);
        return view('pages.maintenance-items.edit', compact('item'));
    }


    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('edit-maintenance-request-items')) {
            abort(403, 'Unauthorized');
        }
        $item = MaintenanceRequestItem::findOrFail($id);

        $validated = $request->validate([
            'maintenance_request_id' => 'required|exists:maintenance_requests,id',
            'title' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'status' => 'required|in:waiting,first contact,started,in progress,finished,unable to complete,quoted',
            'attachments.*' => 'file|max:20480',
        ]);

        $item->update($validated);
        $mrid = $validated['maintenance_request_id'];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $index => $file) {
                $extension = $file->getClientOriginalExtension();
                $originalName = $file->getClientOriginalName();
                $filename = 'mriid_' . $item->id . '_' . $originalName;

                $folder = 'attachments/mrid_' . $mrid;
                $path = $file->storeAs($folder, $filename, 'public');

                $item->attachments()->create([
                    'file_path' => $path,
                    'original_name' => $originalName,
                ]);
            }
        }

        return response()->json(['message' => 'Maintenance item updated successfully']);
    }



    public function destroy($id)
    {
        if (!auth()->user()->can('delete-maintenance-request-items')) {
            abort(403, 'Unauthorized');
        }
        MaintenanceRequestItem::findOrFail($id)->delete();
        return response()->json(['message' => 'Item deleted!']);
    }

    public function download($id)
    {
        $attachment = MaintenanceRequestItemAttachment::findOrFail($id);
        $filePath = $attachment->file_path;

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath, $attachment->original_name);
        }

        abort(404, 'File not found.');
    }

    public function downloadAllAttachments($id)
    {
        $item = MaintenanceRequestItem::with('attachments')->findOrFail($id);

        if ($item->attachments->isEmpty()) {
            return redirect()->back()->with('error', 'No attachments found.');
        }

        $zip = new ZipArchive();
        $zipFileName = 'attachments_' . Str::slug($item->title) . '_' . now()->timestamp . '.zip';
        $zipPath = storage_path("app/public/tmp/{$zipFileName}");

        if (!file_exists(dirname($zipPath))) {
            mkdir(dirname($zipPath), 0755, true);
        }

        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            foreach ($item->attachments as $attachment) {
                $filePath = storage_path('app/public/' . $attachment->file_path);
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, $attachment->original_name);
                }
            }
            $zip->close();
        } else {
            return redirect()->back()->with('error', 'Could not create ZIP file.');
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

}
