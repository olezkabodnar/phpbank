@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- User Info Header -->
    <div class="user-info-header">
        <svg class="user-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        <span class="text-sm">{{ $account->first_name }} {{ $account->last_name }}</span>
    </div>

    <!-- Balance Card -->
    <div class="card">
        <h2 class="card-title">Account Balance</h2>

        <div class="card-content">
            <div class="balance-flex">
                <div>
                    <p class="balance-label">Current Balance:</p>
                    <p class="balance-amount">${{ number_format($account->balance, 0, '', ' ') }}</p>
                </div>
                <div class="balance-right">
                    <p class="balance-label">Last Transaction:</p>
                    <p class="balance-amount">-$200</p>
                    <p class="balance-subtext">(funds transfer)</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('account.topup') }}" class="btn-action">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                <span>Top up</span>
            </a>

            <a href="{{ route('account.transfer') }}" class="btn-action">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
                <span>Transfer</span>
            </a>

            <a href="{{ route('account.transactions') }}" class="btn-action">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Transactions</span>
            </a>
        </div>
    </div>

    <!-- Account Details Card -->
    <div class="card">
        <h2 class="card-title">Account Details</h2>

        <div class="card-grid">
            <!-- User Email Section -->
            <div class="card-content-account-details">
                <p class="detail-label">User Email</p>
                <p class="detail-value detail-highlight mb-6">{{ $account->email }}</p>

                <div class="detail-flex">
                    <span>password: ********</span>
                </div>

                <div class="card-corner">
                    <svg viewBox="0 0 23 26" aria-hidden="true">
                            <circle cx="11.5" cy="7" r="7" fill="currentColor" stroke="none" stroke-width="2"/>
                            <path d="M0,26v-4.23c0-3.74,3.89-6.77,8.68-6.77h5.63c4.8,0,8.68,3.03,8.68,6.77v4.23"
                                fill="currentColor" stroke="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                </div>
            </div>

            <!-- Account Security Section -->
            <div class="card-content-account-details">
                <p class="detail-label">Account Security</p>
                <div class="detail-row">
                    <p class="detail-label">Last Login:</p>
                    <p class="detail-value">{{ $account->updated_at->format('d M Y') }}</p>
                </div>

                <div class="detail-flex">
                    <span>2FA Status: <span class="status-active">Active</span></span>
                </div>

                <div class="card-corner">
                    <svg viewBox="0 0 21.79 25.14">
                        <path d="M17.47,8.57h-.34v-2.33h0c0-3.44-2.79-6.24-6.24-6.24s-6.24,2.79-6.24,6.24v2.33h-.34c-2.38,0-4.32,1.93-4.32,4.32v7.94c0,2.38,1.93,4.32,4.32,4.32h13.15c2.38,0,4.32-1.93,4.32-4.32v-7.94c0-2.38-1.93-4.32-4.32-4.32ZM6.91,8.57v-2.33h0c0-2.2,1.79-3.99,3.99-3.99s3.99,1.79,3.99,3.99h0v2.33h-7.98Z"
                            fill="currentColor"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endsection
