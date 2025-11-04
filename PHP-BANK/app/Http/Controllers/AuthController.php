<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
  
    public function showLoginForm()
    {
        return view('auth.login');
    }

   
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $account = Account::where('email', $request->email)->first();

        if (!$account || !Hash::check($request->password, $account->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }

        if ($account->status !== 'A') {
            return back()->withErrors([
                'email' => 'This account is not active.',
            ]);
        }

        // Store account in session table
        Session::put('account_id', $account->account_id);
        Session::put('account', $account);

        return redirect()->route('account.index')->with('success', 'Login successful!');
    }

   //display register form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // validate registration
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => 'required|email|unique:accounts,email|max:50',
            'phone_no' => 'required|unique:accounts,phone_no|max:15',
            'dob' => 'required|date|before:18 years ago',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $account = Account::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'dob' => $request->dob,
                'password' => Hash::make($request->password),
                'two_fa_enabled' => 'N',
                'status' => 'A',
                'balance' => 0.00,
            ]);

            // Auto-login after registration
            Session::put('account_id', $account->account_id);
            Session::put('account', $account);

            return redirect()->route('account.index')->with('success', 'Account created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Failed to create account. ' . $e->getMessage(),
            ])->withInput();
        }
    }

    public function logout()
    {
        Session::forget(['account_id', 'account']);
        Session::flush();

        return redirect()->route('welcome')->with('success', 'Logged out successfully!');
    }
}