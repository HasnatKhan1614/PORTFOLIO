<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceRequestItem extends Model
{
    protected $fillable = ['title', 'maintenance_request_id', 'remarks', 'status'];

    public function attachments()
    {
        return $this->hasMany(MaintenanceRequestItemAttachment::class);
    }

    public function maintenanceRequest()
    {
        return $this->belongsTo(MaintenanceRequest::class);
    }


}
