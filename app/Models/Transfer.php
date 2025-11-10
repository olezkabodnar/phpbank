<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transfer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'from_account_id',
        'to_account_id',
        'external_bank',
        'external_account_no',
        'amount' => 'decimal:2',
        'transfer_date' => 'datetime',
        'status',
        'confirm_code',
    ];

    public function sender()
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    public function recipient()
    {
        return $this->belongsTo(Account::class, 'to_account_id');
    }
}
