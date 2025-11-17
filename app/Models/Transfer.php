<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transfer extends Model
{
    use HasFactory;

    protected $primaryKey = 'transfer_id';
    public $timestamps = false;

    protected $fillable = [
        'from_account_id',
        'to_account_id',
        'external_bank',
        'external_account_no',
        'amount',
        'transfer_date',
        'status',
        'confirm_code',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transfer_date' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(Account::class, 'from_account_id', 'account_id');
    }

    public function recipient()
    {
        return $this->belongsTo(Account::class, 'to_account_id', 'account_id');
    }
}
