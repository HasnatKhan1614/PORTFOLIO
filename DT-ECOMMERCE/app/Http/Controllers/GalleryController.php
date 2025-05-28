<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;


class GalleryController extends Controller
{
    public function index(Request $request)
    {
        // Start with the base query
        $query = Gallery::query();
    
        // Check if year is set
        if ($request->filled('year')) {
            $query->where('year', '=', $request->input('year'));
        }
    
        // Loop through the other parameters and add to the query
        $parameters = [
            'suspension', 'modification', 'rubbing', 'suspension_brand',
            'wheel_diameter', 'wheel_width', 'tire_height', 'tire_width',
            'wheel_offset', 'type_of_stance', 'spacers', 'tire_brand'
        ];
    
        foreach ($parameters as $param) {
            if ($request->filled($param)) {
                $values = $request->input($param);
                $query->whereIn($param, $values);
            }
        }
    
        // Execute the query to get the gallery
        $gallery = $query->get();
    
        // Return the gallery to the view
        return view('gallery', compact('gallery'));
    }

    public function gallery_detail($id)
    {
        $query = Gallery::query();

        $query->where('id',$id);

        $data = $query->first(); 

        return view('gallery-detail',compact('data'));

    }
    
}
