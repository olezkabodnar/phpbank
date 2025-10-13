<?php

namespace App\Domain\Transfers;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Accounts\Account;

class Transfer extends Model
{
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
