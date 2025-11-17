<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Account;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_id';
    public $timestamps = false;

    protected $fillable = [
        'account_id',
        'type',
        'amount',
        'balance_after',
        'transaction_date',
        'description'
    ];

    protected $casts = [
        'account_id' => 'integer',
        'type' => 'string',
        'amount' => 'decimal:2',
        'balance_after' => 'decimal:2',
        'transaction_date' => 'datetime',
        'description' => 'string',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'account_id');
    }


}
