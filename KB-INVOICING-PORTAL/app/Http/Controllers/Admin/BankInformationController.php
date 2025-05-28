<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankInformation;
class BankInformationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(BankInformation::latest())
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.banks.edit', $row->id);
                    $deleteUrl = route('admin.banks.destroy', $row->id);

                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></a>';
                                      // Delete Button
                                      $btn .= '<a href="#" data-id="' . $row->id . '" data-url="' . $deleteUrl . '" class="delete btn btn-danger btn-sm me-1">';
                                      $btn .= '<i class="fas fa-trash-alt"></i>';
                                      $btn .= '</a>';
                  

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn() // Adds DT_RowIndex

                ->make(true);
        }

        return view('admin.banks.index');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'iban' => 'nullable',
            'branch' => 'nullable',
            'currency' => 'nullable',
            'swift_code' => 'nullable',
        ]);

        $bank = BankInformation::create($data);

        return response()->json(['message' => 'Bank information saved successfully.']);
    }

    public function create()
    {
        return view('admin.banks.create');
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $bank = BankInformation::findOrFail($id);
        return view('admin.banks.edit', compact('bank'));
        // return response()->json($server);
    }

    public function update(Request $request,$id)
    {
        $bank = BankInformation::find($id);

        $data = $request->validate([
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'iban' => 'nullable',
            'branch' => 'nullable',
            'currency' => 'nullable',
            'swift_code' => 'nullable',
        ]);

        $bank->update($data);

        return response()->json(['message' => 'Bank information updated successfully.']);
    }

    public function destroy($id)
    {
        $bank = BankInformation::find($id);
        $bank->delete();
        return response()->json(['message' => 'Bank information deleted successfully.']);
    }
}
