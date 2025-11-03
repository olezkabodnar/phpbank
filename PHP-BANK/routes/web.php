<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/account', [AccountController::class, 'index'])->name('account.index');
