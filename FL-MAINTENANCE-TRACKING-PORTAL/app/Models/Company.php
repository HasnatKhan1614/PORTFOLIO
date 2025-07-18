<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    use HasFactory;

    protected $fillable = ['name', 'tax_number', 'email', 'address'];

    public function buildings() {
        return $this->hasMany(Building::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class);
    }
}

