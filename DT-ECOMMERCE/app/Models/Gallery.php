<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_details',
        'year',
        'make',
        'model',
        'drive',
        'rubbing',
        'trimming',
        'spacers',
        'front_wheel_spacers',
        'rear_wheel_spacers',
        'wheel_title',
        'front_wheel',
        'rear_wheel',
        'offset_wheel',
        'backspacing_wheel',
        'tire_title',
        'front_tire',
        'rear_tire',
        'brand_suspension',
        'suspension',
        'modification',
        'wheel_diameter',
        'wheel_width',
        'tire_height',
        'tire_width',
        'type_of_stance',
        'wheel_brand',
        'wheel_model',
        'tire_brand',
        'tire_model',
        'additional_information',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6',
        'image7',
        'image8',
    ];

    public static $rules = [
        'year' => 'nullable|integer',
        'make' => 'nullable|string|max:255',
        'model' => 'nullable|string|max:255',
        'drive' => 'nullable|string|max:255',
        'vehicle_details' => 'nullable|string|max:255',
        'rubbing' => 'nullable|string|max:255',
        'trimming' => 'nullable|string|max:255',
        'spacers' => 'nullable|string|max:255',
        'front_wheel_spacers' => 'nullable|string|max:255',
        'rear_wheel_spacers' => 'nullable|string|max:255',
        'wheel_title' => 'nullable|string|max:255',
        'front_wheel' => 'nullable|string|max:255',
        'rear_wheel' => 'nullable|string|max:255',
        'offset_wheel' => 'nullable|string|max:255',
        'backspacing_wheel' => 'nullable|string|max:255',
        'tire_title' => 'nullable|string|max:255',
        'front_tire' => 'nullable|string|max:255',
        'rear_tire' => 'nullable|string|max:255',
        'brand_suspension' => 'nullable|string|max:255',
        'suspension' => 'nullable|string|max:255',
        'modification' => 'nullable|string|max:255',
        'wheel_diameter' => 'nullable|string|max:255',
        'wheel_width' => 'nullable|string|max:255',
        'tire_height' => 'nullable|string|max:255',
        'tire_width' => 'nullable|string|max:255',
        'wheel_offset' => 'nullable|string|max:255',
        'type_of_stance' => 'nullable|string|max:255',
        'wheel_brand' => 'nullable|string|max:255',
        'wheel_model' => 'nullable|string|max:255',
        'tire_brand' => 'nullable|string|max:255',
        'tire_model' => 'nullable|string|max:255',
        'additional_information' => 'nullable|string',
        'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        'image6' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        'image7' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        'image8' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
