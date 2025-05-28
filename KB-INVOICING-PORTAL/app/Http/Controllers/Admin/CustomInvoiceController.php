<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomInvoice;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    BankInformation,

};
class CustomInvoiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $invoices = CustomInvoice::query()->latest()->get();
            ;

            return datatables()->of($invoices)
                ->addIndexColumn()
                ->addColumn('payment_status', fn($row) => $row->payment_status ? 'Paid' : 'Unpaid')
                ->addColumn('total_price', function ($row) {
                    $total = 0;
                    if (is_array($row->meta_data)) {
                        foreach ($row->meta_data as $item) {
                            $total += ($item['quantity'] ?? 0) * ($item['price'] ?? 0);
                        }
                    }
                    return $row->currency_symbol .''. number_format($total, 2);
                })
                ->addColumn('actions', function ($row) {
                    $editUrl = route('admin.custom-invoices.edit', $row->id);
                    $invoiceUrl = route('admin.custom-invoices.invoice', ['id' => $row->id]);
                    $deleteUrl = route('admin.custom-invoices.destroy', $row->id);

                    // Edit Button
                    $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm me-1">';
                    $btn .= '<i class="fas fa-edit"></i>';
                    $btn .= '</a>';

                    // Delete Button
                    $btn .= '<a href="#" data-id="' . $row->id . '" data-url="' . $deleteUrl . '" class="delete btn btn-danger btn-sm me-1">';
                    $btn .= '<i class="fas fa-trash-alt"></i>';
                    $btn .= '</a>';

                    // Invoice Button
                    $btn .= '<a href="' . $invoiceUrl . '" class="invoice btn btn-success btn-sm">';
                    $btn .= '<i class="fas fa-file"></i>';
                    $btn .= '</a>';

                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }


        return view('admin.custom-invoices.index');
    }

    public function create()
    {
        $banks = BankInformation::all();

        return view('admin.custom-invoices.create', compact('banks'));
    }

    public function store(Request $request)
    {
        // Decode meta_data JSON string manually (from JS)
        $metaDataArray = [];
        if ($request->filled('meta_data')) {
            try {
                $metaDataArray = json_decode($request->input('meta_data'), true);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Invalid order details format.'], 422);
            }
        }

        // Validate input
        $validated = $request->validate([
            'c_name' => 'required|string|max:255',
            'c_email' => 'nullable|email',
            'c_phone' => 'nullable|string|max:20',
            'c_address' => 'nullable|string',
            'company_name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'bank_information_ids' => 'nullable|array',
            'bank_information_ids.*' => 'exists:bank_information,id',
            'payment_status' => 'boolean',
            'logo_image' => 'nullable|image|max:2048',
            'currency' => 'required|string',

        ]);

        $currencySymbols = [
            'USD' => '$',
            'GBP' => '£',
            'PKR' => '₨.',
            'MYR' => 'RM.',

            // add more if needed
        ];

        // Handle file upload
        if ($request->hasFile('logo_image')) {
            $validated['logo_image'] = $request->file('logo_image')->store('logos', 'public');
        }

        // Generate a unique invoice number with random 7 digits
        $randomNumber = mt_rand(10000, 99999); // Generate a 7-digit random number
        $newInvoiceNumber = 'INV' . $randomNumber;

        // Assign decoded meta_data
        $validated['invoice_number'] = $newInvoiceNumber;

        $validated['meta_data'] = $metaDataArray;

        $validated['currency_symbol'] = $currencySymbols[$request->currency] ?? $request->currency; // fallback



        // Create invoice
        $invoice = CustomInvoice::create($validated);

        // Return JSON response to JS (redirect will not work in AJAX)
        return response()->json([
            'message' => 'Invoice created successfully!',
            'orderId' => $invoice->id
        ]);
    }


    public function edit($id)
    {
        $invoice = CustomInvoice::findOrFail($id);
        $banks = BankInformation::all();

        return view('admin.custom-invoices.edit', compact('invoice', 'banks'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([

            'c_name' => 'required|string|max:255',
            'c_email' => 'nullable|email',
            'c_phone' => 'nullable|string|max:20',
            'c_address' => 'nullable|string',
            'company_name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'bank_information_ids' => 'nullable|array',
            'bank_information_ids.*' => 'exists:bank_information,id',
            'payment_status' => 'boolean',
            'order_details' => 'nullable|array',
            'logo_image' => 'nullable|image|max:2048',
            'currency' => 'required|string',

        ]);

        // Define currency symbols
        $currencySymbols = [
            'USD' => '$',
            'GBP' => '£',
            'PKR' => '₨.',
            'MYR' => 'RM.',

            // Add more if needed
        ];

        $invoice = CustomInvoice::findOrFail($id);

        if ($request->hasFile('logo_image')) {
            $validated['logo_image'] = $request->file('logo_image')->store('logos', 'public');
        } else {
            unset($validated['logo_image']);
        }
        unset($validated['order_details']);

        $validated['currency_symbol'] = $currencySymbols[$request->currency] ?? $request->currency; // fallback

        $invoice->update($validated);

        return response()->json(['message' => 'Invoice updated successfully!']);
    }

    public function destroy($id)
    {
        try {
            // Find the order by ID and delete it
            $invoice = CustomInvoice::findOrFail($id);

            if ($invoice->logo_image) {
                Storage::disk('public')->delete($invoice->logo_image);
            }

            $invoice->delete();

            return response()->json(['message' => 'Invoice deleted successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete the Invoice.'], 500);
        }
    }

    public function invoice($id)
    {
        $invoice = CustomInvoice::findOrFail($id);
        $bankInfos = BankInformation::whereIn('id', $invoice->bank_information_ids ?? [])->get();

        // Initialize items
        $items = [];

        // Decode meta_data only if it's a valid JSON string
        if (!empty($invoice->meta_data)) {
            $decodedMeta = is_array($invoice->meta_data)
                ? $invoice->meta_data
                : json_decode($invoice->meta_data ?? '[]', true);

            if (is_array($decodedMeta)) {
                foreach ($decodedMeta as $item) {
                    // Calculate expire_in from start_date and end_date
                    $start = !empty($item['start_date']) ? \Carbon\Carbon::parse($item['start_date']) : null;
                    $end = !empty($item['end_date']) ? \Carbon\Carbon::parse($item['end_date']) : null;

                    $expireIn = '-';
                    if ($start && $end) {
                        $expireIn = $start->diffInDays($end) . ' Days';
                    }

                    $items[] = [
                        'description' => $item['description'] ?? '-',
                        'price' => isset($item['is_free']) && $item['is_free'] ? 'Free' : ($item['price'] ?? 0),
                        'quantity' => $item['quantity'] ?? 1,
                        'expire_in' => $expireIn,
                        'total' => isset($item['is_free']) && $item['is_free'] ? '-' : (($item['price'] ?? 0) * ($item['quantity'] ?? 1)),
                    ];
                }
            }
        }

        $data = [
            'invoice_no' => $invoice->invoice_number,
            'currency_symbol' => $invoice->currency_symbol,
            'date' => $invoice->created_at->format('Y-m-d'),
            'payment_status' => $invoice->payment_status,

            'user' => [
                'name' => $invoice->c_name,
                'address' => $invoice->c_address,
                'email' => $invoice->c_email,
                'phone' => $invoice->c_phone,
            ],
            'items' => $items,
            'bank_infos' => $bankInfos->map(function ($bank) {
                return [
                    'bank_name' => $bank->bank_name,
                    'account_name' => $bank->account_name,
                    'account_number' => $bank->account_number,
                    'swift_code' => $bank->swift_code,
                    'iban' => $bank->iban,

                ];
            }),
            'notes' => $invoice->notes,
            'logo_image' => $invoice->logo_image,
        ];


        return view('admin.custom-invoices.invoice', compact('data'));
    }

}
