<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectExpense extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'name', 'amount', 'remarks'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
