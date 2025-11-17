<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Services\TwoFAService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TwoFAController extends Controller
{
    protected $twoFAService;

    public function __construct(TwoFAService $twoFAService)
    {
        $this->twoFAService = $twoFAService;
    }

    /**
     * Get the current logged-in account
     */
    private function getCurrentAccount()
    {
        $accountId = Session::get('account_id');
        if (!$accountId) {
            return null;
        }
        return Account::find($accountId);
    }

    /**
     * Show the 2FA settings page
     */
    public function settings()
    {
        $account = $this->getCurrentAccount();
        if (!$account) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        return view('auth.two-fa-settings', compact('account'));
    }

    /**
     * Toggle 2FA status (enable/disable)
     */
    public function toggle(Request $request)
    {
        $account = $this->getCurrentAccount();
        if (!$account) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $isEnabled = $this->twoFAService->isEnabled($account);
        $success = $isEnabled 
            ? $this->twoFAService->disable($account)
            : $this->twoFAService->enable($account);

        if ($success) {
            Session::put('account', $account->fresh());
            $message = $isEnabled ? 'Two-Factor Authentication disabled.' : 'Two-Factor Authentication enabled.';
            return redirect()->route('2fa.settings')->with('success', $message);
        }

        return redirect()->route('2fa.settings')->with('error', 'Failed to update Two-Factor Authentication.');
    }

    /**
     * Test sending a 2FA code
     */
    public function testSend()
    {
        $account = $this->getCurrentAccount();
        if (!$account) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        if (!$this->twoFAService->isEnabled($account)) {
            return redirect()->route('2fa.settings')->with('error', 'Two-Factor Authentication is not enabled.');
        }

        if ($this->twoFAService->sendCode($account)) {
            return redirect()->route('2fa.settings')->with('success', 'Test code sent to your email.');
        }

        return redirect()->route('2fa.settings')->with('error', 'Failed to send test code.');
    }
}