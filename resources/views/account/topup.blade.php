@extends('layouts.app')

@section('title', 'Top Up')

@section('content')

    <!-- Back Button -->
    <div class="flex items-center mb-8">
        <a href="{{ route('account.index') }}" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back to Account</span>
        </a>
    </div>

    <!-- Top Up Form -->
    <div class="main-content p-6">
        <div class="card">
            <div class="card-title">Top Up Balance</div>
            <p class="mb-6 text-gray-400">Enter the amount and your card details to top up your balance.</p>

            <div class="card-content space-y-6">
                
                <!-- Current Balance -->
                <div class="balance-flex">
                    <div class="balance-section">
                        <div class="balance-label">Current Balance</div>
                        <div class="balance-amount">€{{ number_format($account->balance,2) }}</div>
                        <div class="balance-subtext">Available to spend</div>
                    </div>
                    <div class="balance-right">
                        <div class="balance-label">Account</div>
                        <div class="text-sm text-gray-300">{{ $account->email ?? '—' }}</div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('account.topup.post') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Amount -->
                    <div class="form-group">
                        <label class="form-label">Amount (€)</label>
                        <input type="number" name="amount" min="5" max="9999.99" step="0.01" class="form-input" placeholder="Enter amount to top up" value="{{ old('amount') }}">
                        @error('amount')
                            <div class="error-alert"><div class="error-alert-content">{{ $message }}</div></div>
                        @enderror
                    </div>

                    <!-- Cardholder Name -->
                    <div class="form-group">
                        <label class="form-label">Cardholder Name</label>
                        <input type="text" name="card_name" class="form-input" maxlength="50" placeholder="Name on Card" value="{{ old('card_name') }}">
                        @error('card_name')
                            <div class="error-alert"><div class="error-alert-content">{{ $message }}</div></div>
                        @enderror
                    </div>

                    <!-- Card Number -->
                    <div class="form-group">
                        <label class="form-label">Card Number</label>
                        <input type="text" name="card_number" maxlength="16" class="form-input" placeholder="XXXXXXXXXXXXXXXX" value="{{ old('card_number') }}">
                        @error('card_number')
                            <div class="error-alert"><div class="error-alert-content">{{ $message }}</div></div>
                        @enderror
                    </div>

                    <!-- Expiry + CVV (Side by side) -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">Expiration Date</label>
                            <input type="text" name="exp_date" class="form-input" maxlength="5" placeholder="MM/YY" value="{{ old('exp_date') }}">
                            @error('exp_date')
                                <div class="error-alert"><div class="error-alert-content">{{ $message }}</div></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">CVV</label>
                            <input type="password" name="cvv" maxlength="3" class="form-input" placeholder="XXX">
                            @error('cvv')
                                <div class="error-alert"><div class="error-alert-content">{{ $message }}</div></div>
                            @enderror
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" class="btn-primary">Top Up Now</button>
                        <a href="{{ route('account.index') }}" class="btn-secondary text-center">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
