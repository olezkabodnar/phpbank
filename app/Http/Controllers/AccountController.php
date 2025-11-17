<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Session;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;


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

    public function topupValidation(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:5|max:9999.99',

            'card_name' => [
                'required',
                'max:50',
                'regex:/^[A-Za-z\s]+$/',
            ],

            'card_number' => [
                'required',
                'digits:16',
            ],

            'exp_date' => [
                'required',
                'date_format:m/y',
                function ($attribute, $value, $fail) {
                    try {
                        $exp = \Carbon\Carbon::createFromFormat('m/y', $value)->startOfMonth();
                    } catch (\Exception $e) {
                        return $fail('Invalid expiry date format.');
                    }

                    $now = now()->startOfMonth();
                    $max = now()->addYears(15)->startOfMonth(); 

                    if ($exp->lt($now)) {
                        $fail('The card expiration date cannot be in the past.');
                    }

                    if ($exp->gt($max)) {
                        $fail('The card expiration date cannot be more than 15 years from now.');
                    }
                },
            ],

            'cvv' => [
                'required',
                'digits:3',
            ],
        ], [
            'amount.required' => 'Please enter an amount.',
            'amount.min'      => 'Minimum top up is €5.',
            'amount.max'      => 'Maximum top up is €9999.',
            'card_name.regex' => 'Cardholder name must only contain letters and spaces.',
            'card_number.digits' => 'Card number must be 16 digits.',
            'cvv.digits' => 'CVV must be 3 digits.',
        ]);


        $accountId = Session::get('account_id');
        if (!$accountId) {
            return redirect()->route('login')->withErrors('Please login first');
        }

        $account = Account::find($accountId);
        if (!$account) {
            Session::forget('account_id');
            return redirect()->route('login')->withErrors('Account not found');
        }

        DB::transaction(function () use ($account, $request) {
            $account->deposit($request->amount);
        });

        Session::put('account', $account);

        return redirect()->back()->with('success', 'Top-up successful! New balance: €' . number_format($account->balance, 2));

    }

    public function showPasswordRecovery()
    {
        return view('account.recover-password');
    }

}
