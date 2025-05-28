<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::where('user_id',auth()->user()->id)->get();
        return view('user.gallery.index', compact('gallery'));
    }

    public function store(Request $request)
    {
        // try {
            $validator = Validator::make($request->all(), Gallery::$rules);
        
            // Validate input
            if ($validator->fails()) {
                throw ValidationException::withMessages($validator->errors()->toArray());
            }
        
            $imagePaths = [];
        
            // Upload images
            for ($i = 1; $i <= 8; $i++) {
                $imageKey = 'image' . $i;
                if ($request->hasFile($imageKey)) {
                    $imagePaths[$imageKey] = $request->file($imageKey)->store('gallery', 'public');
                } else {
                    $imagePaths[$imageKey] = null; // Set to null if no file is uploaded
                }
            }
        
            // Create a new gallery entry
            $galleryData = $request->only([
                'vehicle_details','year', 'make', 'model', 'drive','rubbing', 'trimming',
                'spacers', 'front_wheel_spacers', 'rear_wheel_spacers', 'wheel_title',
                'front_wheel', 'rear_wheel', 'offset_wheel', 'backspacing_wheel', 'tire_title',
                'front_tire', 'rear_tire', 'brand_suspension', 'suspension', 'modification',
                'wheel_diameter', 'wheel_width', 'tire_height', 'tire_width', 'wheel_offset',
                'type_of_stance', 'wheel_brand', 'wheel_model', 'tire_brand', 'tire_model',
                'additional_information',
            ]);
        
            $galleryData = array_merge($galleryData, $imagePaths);
            $galleryData['user_id'] = auth()->user()->id;
        
            // Begin transaction
            DB::beginTransaction();
        
            // Create gallery entry
            $gallery = Gallery::create($galleryData);
        
            // Commit transaction
            DB::commit();
        
            return back()->with('success', 'Gallery entry created successfully');
        
        // } catch (ValidationException $e) {
        //     return back()->withErrors($e->validator->errors())->withInput();
        
        // } catch (\Exception $e) {
        //     // Rollback transaction if an error occurred
        //     DB::rollBack();
        
        //     return back()->with('error', 'Failed to create gallery entry. Please try again later.');
        // }
        
    }
    
    
    public function destroy(Gallery $gallery)
    {
        // Delete the image files from storage
        for ($i = 1; $i <= 8; $i++) {
            $imagePath = 'gallery/' . $gallery['image' . $i];
            if ($gallery['image' . $i] && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    
        // Delete the gallery record from the database
        $gallery->delete();
    
        return back()->with('success', 'Image deleted successfully');
    }
}    
