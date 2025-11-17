@extends('layouts.app')

@section('title', 'Change password')

@section('content')
<div class="grid h-full grid-rows-[auto_1fr]">
    <div class="user-info-header">
        <svg class="user-info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        <span class="text-sm">{{ $account->first_name }} {{ $account->last_name }}</span>
    </div>

    <div class="grid place-items-center">
        <div class="w-full max-w-md">
            <h1 class="auth-title mb-12 text-center">Change password</h1>

            @if (session('success'))
                <div class="success-message"><div class="success-message-content"><p>{{ session('success') }}</p></div></div>
            @endif
            @if ($errors->any())
                <div class="error-alert"><div class="error-alert-content">
                    @foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach
                </div></div>
            @endif

            <form method="POST" action="{{ route('account.changePassword.update') }}" class="space-y-6">
                @csrf

                <div class="form-group">
                    <label for="current_password" class="form-label">Current password</label>
                    <div class="form-icon-wrapper">
                        <svg class="form-icon" viewBox="0 0 21.79 25.14"><path d="M17.47,8.57h-.34v-2.33h0c0-3.44-2.79-6.24-6.24-6.24s-6.24,2.79-6.24,6.24v2.33h-.34c-2.38,0-4.32,1.93-4.32,4.32v7.94c0,2.38,1.93,4.32,4.32,4.32h13.15c2.38,0,4.32-1.93,4.32-4.32v-7.94c0-2.38-1.93-4.32-4.32-4.32ZM6.91,8.57v-2.33h0c0-2.2,1.79-3.99,3.99-3.99s3.99,1.79,3.99,3.99h0v2.33h-7.98Z" fill="currentColor"/></svg>
                        <input id="current_password" name="current_password" type="password" required class="form-input" placeholder="enter current password" autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">New password</label>
                    <div class="form-icon-wrapper">
                        <svg class="form-icon" viewBox="0 0 21.79 25.14"><path d="M17.47,8.57h-.34v-2.33h0c0-3.44-2.79-6.24-6.24-6.24s-6.24,2.79-6.24,6.24v2.33h-.34c-2.38,0-4.32,1.93-4.32,4.32v7.94c0,2.38,1.93,4.32,4.32,4.32h13.15c2.38,0,4.32-1.93,4.32-4.32v-7.94c0-2.38-1.93-4.32-4.32-4.32ZM6.91,8.57v-2.33h0c0-2.2,1.79-3.99,3.99-3.99s3.99,1.79,3.99,3.99h0v2.33h-7.98Z" fill="currentColor"/></svg>
                        <input id="password" name="password" type="password" required class="form-input" placeholder="enter new password" autocomplete="new-password" minlength="6">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm new password</label>
                    <div class="form-icon-wrapper">
                        <svg class="form-icon" viewBox="0 0 21.79 25.14"><path d="M17.47,8.57h-.34v-2.33h0c0-3.44-2.79-6.24-6.24-6.24s-6.24,2.79-6.24,6.24v2.33h-.34c-2.38,0-4.32,1.93-4.32,4.32v7.94c0,2.38,1.93,4.32,4.32,4.32h13.15c2.38,0,4.32-1.93,4.32-4.32v-7.94c0-2.38-1.93-4.32-4.32-4.32ZM6.91,8.57v-2.33h0c0-2.2,1.79-3.99,3.99-3.99s3.99,1.79,3.99,3.99h0v2.33h-7.98Z" fill="currentColor"/></svg>
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="form-input" placeholder="confirm new password" autocomplete="new-password">
                    </div>
                </div>

                <div class="pt-2">
                    <button class="btn-primary">Confirm password change</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
