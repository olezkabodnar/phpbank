<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Session;

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
}
