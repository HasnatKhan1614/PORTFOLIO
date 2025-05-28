<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    Product,
    ProductImage,
    CarModel
};

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('car_model')->with('car_model.make')->get();
    
        return Inertia::render("Product/Index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $car_models = CarModel::with('make')->get();
        $years = [];
    
        for ($year = date('Y'); $year >= date('Y') - 33; $year--){
            $years[] = $year;
        }
        return Inertia::render("Product/Create",compact('years','car_models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  request()
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        // Validate the incoming request data
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'quantity' => 'required|integer|min:1',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'car_model_id' => 'nullable',
            'year' => 'nullable|integer|min:0',
            'barcode' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::where('barcode',request()->input('barcode'))->first();

        if($product){
            return response()->json(['error' => 'Barcode Already Exist'], 422);
        }
    
        // Create the product
        $product = Product::create([
            'name' => request()->input('name'),
            'description' => request()->input('description'),
            'quantity' => request()->input('quantity'),
            'buying_price' => request()->input('buying_price'),
            'selling_price' => request()->input('selling_price'),
            'car_model_id' => request()->input('car_model_id'),
            'year' => request()->input('year'),
            'barcode' => request()->input('barcode'),
        ]);
    
        // Handle image upload
        if (request()->hasFile('image')) {
            $imagePath = request()->file('image')->store('products'); // Store the image
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $imagePath, // Use the variable holding the image path
            ]);
        }

        return response()->json(['success' => 'created successfully'], 200);    
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car_models = CarModel::with('make')->get();
        $product = Product::find($id);
        $years = [];
    
        for ($year = date('Y'); $year >= date('Y') - 33; $year--){
            $years[] = $year;
        }
        return Inertia::render("Product/Edit",compact('product','years','car_models'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  request()
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // Validate the incoming request data
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'quantity' => 'required|integer|min:1',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'car_model_id' => 'nullable',
            'year' => 'nullable|integer|min:0',
            'barcode' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Find the product by ID
        $product = Product::find($id);
    
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

    
        // Handle image upload
        if (request()->hasFile('image')) {
            $imagePath = request()->file('image')->store('products'); // Store the image
    
            // Create a new ProductImage record
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $imagePath, // Use the variable holding the image path
            ]);
        }
    
        // Update the product information
        $product->update([
            'name' => request()->input('name'),
            'description' => request()->input('description'),
            'quantity' => request()->input('quantity'),
            'buying_price' => request()->input('buying_price'),
            'selling_price' => request()->input('selling_price'),
            'car_model_id' => request()->input('car_model_id'),
            'year' => request()->input('year'),
            'barcode' => request()->input('barcode'),
        ]);
    
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $product = Product::find($id);
     $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }


}
