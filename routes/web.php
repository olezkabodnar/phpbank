<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
//welcome route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/account/topup', [AccountController::class, 'topupValidation'])->name('account.topup.post');

// account Routes
Route::get('/account', [AccountController::class, 'index'])->name('account.index');
Route::get('/account/change-password', [AccountController::class, 'showChangePasswordForm'])->name('account.changePassword');
Route::get('/account/change-email', [AccountController::class, 'showChangeEmailForm'])->name('account.changeEmail');
Route::get('/account/2fa', [AccountController::class, 'show2FAForm'])->name('account.twoFA');
Route::get('/account/transactions', [AccountController::class, 'showTransactions'])->name('account.transactions');
Route::get('/account/transfer', [AccountController::class, 'showTransferForm'])->name('account.transfer');
Route::get('/account/topup', [AccountController::class, 'showTopupForm'])->name('account.topup');
Route::get('/password-recovery', [AccountController::class, 'showPasswordRecovery'])->name('password.recovery');

