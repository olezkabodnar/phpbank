<?php

namespace App\Domain\Accounts;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Transactions\Transaction;
use App\Domain\Transfers\Transfer;

class Account extends Model
{
    protected $casts = [
        'first_name',
        'last_name',
        'dob' => 'date',
        'phone_no',
        'email',
        'password',
        'two_fa_enabled' => 'boolean',
        'status',
        'balance' => 'decimal:2',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function transfersSent()
    {
        return $this->hasMany(Transfer::class, 'from_account_id');
    }

    public function transfersReceived()
    {
        return $this->hasMany(Transfer::class, 'to_account_id');
    }
    
    public function setDobAttribute($value)
    {
        $dob = Carbon::parse($value);
        if ($dob->diffInYears(Carbon::now()) < 18) {
            throw ValidationException::withMessages(['dob' => 'User must be at least 18 years old.']);
        }

        $this->attributes['dob'] = $dob;
    }
    
    public function deposit(Account $account, float $amount)
    {
        DB::transaction(function () use ($account, $amount) {
            $account->balance = bcadd($account->balance, $amount, 2);
            $account->save();
        });
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst(strtolower($value));
    }

    public function setLastNameAttribute($value)
        {
            $this->attributes['last_name'] = ucfirst(strtolower($value));
        }

}
