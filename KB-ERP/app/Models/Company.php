<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'country',
        'city',
        'street',
        'postal_code',
        'logo_image',
        'status',
    ];
}
