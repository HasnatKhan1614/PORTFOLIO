<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankInformation extends Model
{
    protected $fillable = [
        'bank_name',
        'account_name',
        'account_number',
        'iban',
        'branch',
        'currency',
        'swift_code',
    ];
}
