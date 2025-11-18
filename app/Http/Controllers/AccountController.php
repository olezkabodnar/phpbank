<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Session;
use App\Models\Transaction;
use App\Models\Transfer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


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

        // Get the last transaction for this account
        $lastTransaction = Transaction::where('account_id', $accountId)
            ->orderBy('transaction_date', 'desc')
            ->orderBy('transaction_id', 'desc')
            ->first();

        return view('account.index', compact('account', 'lastTransaction'));
                
        

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

    public function updatePassword(Request $request)
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

        // Validate the request
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Please enter your current password.',
            'password.required' => 'Please enter a new password.',
            'password.min' => 'New password must be at least 6 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        // Verify the current password
        if (!Hash::check($request->current_password, $account->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'The provided current password is incorrect.']);
        }

        // Check if new password is different from current
        if (Hash::check($request->password, $account->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'New password must be different from your current password.']);
        }

        try {
            // Update the password
            $account->password = Hash::make($request->password);
            $account->save();

            // Update session data if needed
            Session::put('account', $account);

            return redirect()->route('account.changePassword')
                ->with('success', 'Password has been successfully updated.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to update password. Please try again.']);
        }
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

    public function updateEmail(Request $request)
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

        // Validate the request
        $request->validate([
            'password' => 'required',
            'email' => 'required|email|unique:accounts,email,' . $account->account_id . ',account_id',
            'email_confirmation' => 'required|same:email',
        ], [
            'password.required' => 'Please enter your current password.',
            'email.required' => 'Please enter a new email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'email_confirmation.required' => 'Please confirm your new email address.',
            'email_confirmation.same' => 'Email confirmation does not match.',
        ]);

        // Verify the current password
        if (!Hash::check($request->password, $account->password)) {
            return redirect()->back()
                ->withInput($request->only('email', 'email_confirmation'))
                ->withErrors(['password' => 'The provided password is incorrect.']);
        }

        try {
            // Update the email
            $account->email = $request->email;
            $account->save();

            // Update session data if needed
            Session::put('account', $account);

            return redirect()->route('account.changeEmail')
                ->with('success', 'Email address has been successfully updated.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput($request->only('email', 'email_confirmation'))
                ->withErrors(['error' => 'Failed to update email address. Please try again.']);
        }
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
            $account->deposit($request->amount, 'Account Top-Up via Card ending (' . substr($request->card_number, -4) . ')');
        });

        Session::put('account', $account);

        return redirect()->back()->with('success', 'Top-up successful! New balance: €' . number_format($account->balance, 2));

    }

    public function processTransfer(Request $request)
    {
        $accountId = Session::get('account_id');
        if (!$accountId) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $account = Account::find($accountId);
        if (!$account) {
            Session::forget('account_id');
            return redirect()->route('login')->with('error', 'Account not found');
        }

        // Validate fields for internal transfer only
        $rules = [
            'transfer_type' => 'required|in:internal',
            'amount' => 'required|numeric|min:1|max:999999.99',
            'reference' => 'nullable|string|max:100',
            'recipient_email' => [
                'required',
                'email',
                'exists:accounts,email',
                function ($attribute, $value, $fail) use ($account) {
                    if ($value === $account->email) {
                        $fail('You cannot transfer to your own account.');
                    }
                },
            ],
        ];

        $messages = [
            'amount.required' => 'Please enter a transfer amount.',
            'amount.min' => 'Minimum transfer amount is €1.00.',
            'amount.max' => 'Maximum transfer amount is €999,999.99.',
            'recipient_email.required' => 'Please enter the recipient\'s email address.',
            'recipient_email.email' => 'Please enter a valid email address.',
            'recipient_email.exists' => 'No account found with this email address.',
        ];

        $validatedData = $request->validate($rules, $messages);

        // Check if sufficient balance
        if ($validatedData['amount'] > $account->balance) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['amount' => 'Insufficient balance for this transfer.']);
        }

        try {
            DB::transaction(function () use ($account, $validatedData) {
                $this->processInternalTransfer($account, $validatedData);
            });

            return redirect()->route('account.index')
                ->with('success', 'Transfer of €' . number_format($validatedData['amount'], 2) . ' completed successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Transfer failed. Please try again later.']);
        }
    }

    private function processInternalTransfer($senderAccount, $data)
    {
        // Find recipient account
        $recipientAccount = Account::where('email', $data['recipient_email'])->first();
        
        if (!$recipientAccount) {
            throw new \Exception('Recipient account not found');
        }

        // Create transfer record
        $transfer = Transfer::create([
            'from_account_id' => $senderAccount->account_id,
            'to_account_id' => $recipientAccount->account_id,
            'amount' => $data['amount'],
            'transfer_date' => Carbon::now(),
            'status' => 'Completed',
            'confirm_code' => null,
        ]);

        // Update balances
        $senderAccount->balance = bcadd($senderAccount->balance, '-' . $data['amount'], 2);
        $senderAccount->save();

        $recipientAccount->balance = bcadd($recipientAccount->balance, $data['amount'], 2);
        $recipientAccount->save();

        // Create transaction records
        Transaction::create([
            'account_id' => $senderAccount->account_id,
            'type' => 'Transfer Out',
            'amount' => '-' . $data['amount'],
            'balance_after' => $senderAccount->balance,
            'transaction_date' => Carbon::now(),
            'description' => 'Transfer to ' . $recipientAccount->email . 
                           (isset($data['reference']) && $data['reference'] ? ' - ' . $data['reference'] : ''),
        ]);

        Transaction::create([
            'account_id' => $recipientAccount->account_id,
            'type' => 'Transfer In',
            'amount' => $data['amount'],
            'balance_after' => $recipientAccount->balance,
            'transaction_date' => Carbon::now(),
            'description' => 'Transfer from ' . $senderAccount->email . 
                           (isset($data['reference']) && $data['reference'] ? ' - ' . $data['reference'] : ''),
        ]);
    }

    public function showPasswordRecovery()
    {
        return view('account.recover-password');
    }

}
