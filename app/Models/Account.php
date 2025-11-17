<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class Account extends Model
{
    use HasFactory;

    protected $primaryKey = 'account_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'dob',
        'phone_no',
        'email',
        'password',
        'two_fa_enabled',
        'status',
        'balance',
    ];

    protected $casts = [
        'dob' => 'date',
        'two_fa_enabled' => 'boolean',
        'balance' => 'decimal:2',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'account_id', 'account_id');
    }

    public function transfersSent()
    {
        return $this->hasMany(Transfer::class, 'from_account_id', 'account_id');
    }

    public function transfersReceived()
    {
        return $this->hasMany(Transfer::class, 'to_account_id', 'account_id');
    }

    public function twoFACodes()
    {
        return $this->hasMany(TwoFACode::class, 'account_id', 'account_id');
    }

    public function setDobAttribute($value)
    {
        $dob = Carbon::parse($value);
        if ($dob->diffInYears(Carbon::now()) < 18) {
            throw ValidationException::withMessages(['dob' => 'User must be at least 18 years old.']);
        }

        $this->attributes['dob'] = $dob;
    }

    public function deposit(float $amount)
    {
        DB::transaction(function () use ($amount) {
            $newBalance = bcadd((string)$this->balance, (string)$amount, 2);
            $this->attributes['balance'] = $newBalance;
            $this->save();
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
