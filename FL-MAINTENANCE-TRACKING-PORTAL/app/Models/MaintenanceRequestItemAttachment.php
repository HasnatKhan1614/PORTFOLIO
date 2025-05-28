<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceRequestItemAttachment extends Model
{
    protected $fillable = ['maintenance_request_item_id', 'file_path','original_name'];


    public function item()
    {
        return $this->belongsTo(MaintenanceRequestItem::class, 'maintenance_request_item_id');
    }
}
