<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Account;

class Transaction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'account_id',
        'type',
        'amount' => 'decimal:2',
        'transaction_date' => 'datetime',
        'description',
        'balance_after' => 'decimal:2',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
