<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Session;
use App\Models\Transaction;

class AccountController extends Controller
{
    public function index()
    {
        // retrieve account from session
        $accountId = Session::get('account_id');

        if (!$accountId) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $account = Account::find($accountId);

        if (!$account) {
            Session::forget(['account_id', 'account']);
            return redirect()->route('login')->with('error', 'Account not found');
        }

        return view('account.index', compact('account'));
                
        

    }
    public function showChangePasswordForm()
    {
        $accountId = Session::get('account_id');

        if (!$accountId) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $account = Account::find($accountId);

        if (!$account) {
            Session::forget(['account_id', 'account']);
            return redirect()->route('login')->with('error', 'Account not found');
        }

        return view('account.change-password', compact('account'));
    }

    public function showChangeEmailForm()
    {
        $accountId = Session::get('account_id');

        if (!$accountId) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $account = Account::find($accountId);

        if (!$account) {
            Session::forget(['account_id', 'account']);
            return redirect()->route('login')->with('error', 'Account not found');
        }

        return view('account.change-email', compact('account'));
    }

    public function show2FAForm()
    {
        $accountId = Session::get('account_id');

        if (!$accountId) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $account = Account::find($accountId);

        if (!$account) {
            Session::forget(['account_id', 'account']);
            return redirect()->route('login')->with('error', 'Account not found');
        }

        return view('account.two-fa', compact('account'));
    }

    public function showTransactions()
    {
        $accountId = Session::get('account_id');

        if (!$accountId) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $account = Account::find($accountId);

        if (!$account) {
            Session::forget(['account_id', 'account']);
            return redirect()->route('login')->with('error', 'Account not found');
        }

        $transactions = $account->transactions;

        return view('account.transactions', compact('account', 'transactions'));
    }


    public function showTransferForm()
    {
        $accountId = Session::get('account_id');

        if (!$accountId) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $account = Account::find($accountId);

        if (!$account) {
            Session::forget(['account_id', 'account']);
            return redirect()->route('login')->with('error', 'Account not found');
        }

        return view('account.transfer', compact('account'));
    }

    public function showTopupForm()
    {
        $accountId = Session::get('account_id');

        if (!$accountId) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $account = Account::find($accountId);

        if (!$account) {
            Session::forget(['account_id', 'account']);
            return redirect()->route('login')->with('error', 'Account not found');
        }

        return view('account.topup', compact('account'));
    }

    public function showPasswordRecovery()
    {
        return view('account.recover-password');
    }

}
