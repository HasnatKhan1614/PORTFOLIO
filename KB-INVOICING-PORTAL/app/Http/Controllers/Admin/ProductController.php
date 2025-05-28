<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Product::all())
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.products.edit', $row->id);

                    // Update Delete Button (Remove href, use data-url attribute instead)
                    // $btn = '<a  data-id="' . $row->id . '" class="edit btn btn-primary btn-sm">';
                    $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">';
                    $btn .= '<i class="fas fa-edit"></i>';
                    $btn .= '</a>';

                    $btn .= ' <a href="#" data-id="' . $row->id . '" data-url="' . route('admin.products.destroy', $row->id) . '" class="delete btn btn-danger btn-sm">';
                    $btn .= '<i class="fas fa-trash-alt"></i>';
                    $btn .= '</a>';

                    return $btn;
                })
                ->make(true);
        }

        return view('admin.products.index');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $product = Product::create($request->only(['name']));

        return response()->json(['message' => 'Product created successfully!', 'data' => $product]);
    }

    // Show the form for editing the specified resource.
    public function create()
    {
        return view('admin.products.create');
    }

    // Fetch product data
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
        // return response()->json($product);
    }

    // Update product data
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json(['success' => true, 'message' => 'Product updated successfully']);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully!']);
    }

}
