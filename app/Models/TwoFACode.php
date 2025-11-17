<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TwoFACode extends Model
{
    use HasFactory;

    protected $table = 'two_fa_codes';
    
    // Disable automatic timestamps since we only need created_at
    public $timestamps = false;

    protected $fillable = [
        'account_id',
        'code',
        'expires_at',
        'used',
        'created_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean',
        'created_at' => 'datetime'
    ];

    /**
     * Relationship with Account model
     */
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'account_id');
    }

    /**
     * Generate a random 6-digit code
     */
    public static function generateCode(): string
    {
        return str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Create a new 2FA code for an account
     */
    public static function createForAccount($accountId): self
    {
        // Delete any existing unused codes for this account
        static::where('account_id', $accountId)->delete();

        return static::create([
            'account_id' => $accountId,
            'code' => static::generateCode(),
            'expires_at' => Carbon::now()->addMinutes(10),
            'used' => false,
            'created_at' => Carbon::now()
        ]);
    }

    /**
     * Get the number of remaining minutes until expiration
     */
    public function getRemainingMinutesAttribute(): int
    {
        if ($this->expires_at->isPast()) {
            return 0;
        }
        return $this->expires_at->diffInMinutes(Carbon::now());
    }
}