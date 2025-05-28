<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRequest extends Model {
    use HasFactory;

    protected $fillable = ['title','building_id', 'user_id', 'company_id', 'urgency', 'description', 'status', 'accounting_status'];

    public function scopeByCompany($query)
    {
        if (auth()->user()->hasRole(['superadmin', 'manager','developer'])) {
            return $query;
        }


        return $query->where('company_id', auth()->user()->company_id);
    }
    public function building() {
        return $this->belongsTo(Building::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
