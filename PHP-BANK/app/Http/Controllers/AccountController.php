<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index()
    {
        // For demo, get first account. In production, use authenticated user's account
        $account = Account::first();

        if (!$account) {
            return redirect()->route('welcome')->with('error', 'No account found');
        }

        return view('account.index', compact('account'));
    }
}
