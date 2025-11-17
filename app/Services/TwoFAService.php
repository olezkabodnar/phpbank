<?php

namespace App\Services;

use App\Models\Account;
use App\Models\TwoFACode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\TwoFACodeMail;

class TwoFAService
{
    /**
     * Generate and send a 2FA code to the account's email (for testing)
     */
    public function sendCode(Account $account): bool
    {
        try {
            // Create a new 2FA code
            $twoFACode = TwoFACode::createForAccount($account->account_id);

            // Send the code via email
            Mail::to($account->email)->send(new TwoFACodeMail($twoFACode, $account));

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send 2FA test code', [
                'account_id' => $account->account_id,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Check if account has 2FA enabled
     */
    public function isEnabled(Account $account): bool
    {
        return $account->two_fa_enabled === true || $account->two_fa_enabled === 'Y';
    }

    /**
     * Enable 2FA for an account
     */
    public function enable(Account $account): bool
    {
        try {
            $account->update(['two_fa_enabled' => true]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Disable 2FA for an account
     */
    public function disable(Account $account): bool
    {
        try {
            $account->update(['two_fa_enabled' => false]);
            // Clean up any existing codes
            TwoFACode::where('account_id', $account->account_id)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}