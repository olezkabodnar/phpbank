<?php

namespace App\Domain\Transactions;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Accounts\Account;

class Transaction extends Model
{
    protected $casts = [
        'account_id',
        'type',
        'amount' => 'decimal:2',
        'transaction_date' => 'datetime',
        'description',
        'balance_after' 'decimal:2',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
