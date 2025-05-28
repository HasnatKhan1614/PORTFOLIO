<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model {
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'tax_number', 'address', 'latitude', 'longitude'];

    public function scopeByCompany($query)
    {
        if (auth()->user()->hasRole('superadmin')) {
            return $query;
        }

        return $query->where('company_id', auth()->user()->company_id);
    }
    
    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function maintenanceRequests() {
        return $this->hasMany(MaintenanceRequest::class);
    }
    
}

