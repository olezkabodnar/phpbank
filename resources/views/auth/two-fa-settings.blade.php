@extends('layouts.app')

@section('title', 'Two-Factor Authentication')

@section('content')
    <!-- User Info Header -->
    <div class="user-info-header">
        <svg class="user-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        <span class="text-sm">{{ $account->first_name }} {{ $account->last_name }}</span>
    </div>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="success-message">
            <div class="success-message-content">
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="error-alert">
            <div class="error-alert-content">
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Two-Factor Authentication Card -->
    <div class="card">
        <h2 class="card-title">Two-Factor Authentication</h2>

        <div class="card-content">
            <!-- Status Display -->
            <div class="detail-row">
                <p class="detail-label">Status:</p>
                <p class="detail-value">
                    <span class="{{ $account->two_fa_enabled ? 'status-active' : 'status-inactive' }}">
                        {{ $account->two_fa_enabled ? 'Enabled' : 'Disabled' }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <form method="POST" action="{{ route('2fa.toggle') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-action {{ $account->two_fa_enabled ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                    <svg class="btn-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                    </svg>
                    <span>{{ $account->two_fa_enabled ? 'Disable' : 'Enable' }}</span>
                </button>
            </form>

            @if($account->two_fa_enabled)
                <form method="POST" action="{{ route('2fa.test.send') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-action">
                        <svg class="btn-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        <span>Send Test Message</span>
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection