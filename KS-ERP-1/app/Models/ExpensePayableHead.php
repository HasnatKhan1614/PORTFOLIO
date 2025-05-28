<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensePayableHead extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    public function expense_payable()
    {
        return $this->hasMany(ExpensePayable::class, 'expense_payable_head_id');
    }
}
