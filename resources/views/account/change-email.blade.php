@extends('layouts.app')

@section('title', 'Change email')

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
            <h1 class="auth-title mb-12 text-center">Email Change</h1>

            @if (session('success'))
                <div class="success-message"><div class="success-message-content"><p>{{ session('success') }}</p></div></div>
            @endif
            @if ($errors->any())
                <div class="error-alert"><div class="error-alert-content">
                    @foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach
                </div></div>
            @endif

            <form method="POST" action="{{ route('account.changeEmail.update') }}" class="space-y-6">
                @csrf

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="form-icon-wrapper">
                        <svg class="form-icon" viewBox="0 0 21.79 25.14"><path d="M17.47,8.57h-.34v-2.33h0c0-3.44-2.79-6.24-6.24-6.24s-6.24,2.79-6.24,6.24v2.33h-.34c-2.38,0-4.32,1.93-4.32,4.32v7.94c0,2.38,1.93,4.32,4.32,4.32h13.15c2.38,0,4.32-1.93,4.32-4.32v-7.94c0-2.38-1.93-4.32-4.32-4.32ZM6.91,8.57v-2.33h0c0-2.2,1.79-3.99,3.99-3.99s3.99,1.79,3.99,3.99h0v2.33h-7.98Z" fill="currentColor"/></svg>
                        <input id="password" name="password" type="password" required class="form-input" placeholder="enter password">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">New email</label>
                    <div class="form-icon-wrapper">
                        <svg class="form-icon" viewBox="0 0 31.95 25.98"><path d="M29.72,21.85l-9.53-8.6M12,13.24L2.47,21.85M1.75,6.07l11.71,8.2c.95.66,1.42,1,1.94,1.12.46.11.93.11,1.39,0,.52-.13.99-.46,1.94-1.12l11.71-8.2M8.4,24.46h14.91c2.41,0,3.61,0,4.53-.47.81-.41,1.47-1.07,1.88-1.88.47-.92.47-2.12.47-4.53v-9.18c0-2.41,0-3.61-.47-4.53-.41-.81-1.07-1.47-1.88-1.88-.92-.47-2.12-.47-4.53-.47h-14.91c-2.41,0-3.61,0-4.53.47-.81.41-1.47,1.07-1.88,1.88-.47.92-.47,2.12-.47,4.53v9.18c0,2.41,0,3.61.47,4.53.41.81,1.07,1.47,1.88,1.88.92.47,2.12.47,4.53.47Z" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required class="form-input" placeholder="enter new email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email_confirmation" class="form-label">Confirm new email</label>
                    <div class="form-icon-wrapper">
                        <svg class="form-icon" viewBox="0 0 31.95 25.98"><path d="M29.72,21.85l-9.53-8.6M12,13.24L2.47,21.85M1.75,6.07l11.71,8.2c.95.66,1.42,1,1.94,1.12.46.11.93.11,1.39,0,.52-.13.99-.46,1.94-1.12l11.71-8.2M8.4,24.46h14.91c2.41,0,3.61,0,4.53-.47.81-.41,1.47-1.07,1.88-1.88.47-.92.47-2.12.47-4.53v-9.18c0-2.41,0-3.61-.47-4.53-.41-.81-1.07-1.47-1.88-1.88-.92-.47-2.12-.47-4.53-.47h-14.91c-2.41,0-3.61,0-4.53.47-.81.41-1.47,1.07-1.88,1.88-.47.92-.47,2.12-.47,4.53v9.18c0,2.41,0,3.61.47,4.53.41.81,1.07,1.47,1.88,1.88.92.47,2.12.47,4.53.47Z" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <input id="email_confirmation" name="email_confirmation" type="email" value="{{ old('email_confirmation') }}" required class="form-input" placeholder="confirm new email">
                    </div>
                </div>

                <div class="pt-2">
                    <button class="btn-primary">Confirm email change</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
