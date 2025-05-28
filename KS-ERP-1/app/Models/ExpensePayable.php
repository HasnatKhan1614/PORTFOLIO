<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensePayable extends Model
{
    use HasFactory;

    protected $fillable = ['expense_payable_head_id','amount','remarks','date'];

    public function expense_payable_head()
    {
        return $this->belongsTo(ExpensePayableHead::class, 'expense_payable_head_id');
    }
}
