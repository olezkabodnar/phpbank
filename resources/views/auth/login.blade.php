<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - PHP BANK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <div class="auth-container">
        <!-- Header -->
        <div class="auth-header">
            <h1 class="auth-title">Log In</h1>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="error-alert">
                <div class="error-alert-content">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Log In Form -->
        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <label for="email" class="form-label mb-3">Email Address</label>
                <div class="form-icon-wrapper">
                    <svg class="form-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="form-input-with-icon"
                        placeholder="your@email.com"
                    >
                </div>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password" class="form-label mb-3">Password</label>
                <div class="form-icon-wrapper">
                    <svg class="form-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="form-input-with-icon"
                        placeholder="••••••••"
                    >
                </div>
            </div>

            <div class="mt-2 flex justify-end">
                    <a class="auth-link">
                        Forgot password?
                    </a>
            </div>            

            <!-- Log In Button -->
            <button type="submit" class="btn-primary mt-8">
                Log In
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-white">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-[#e87f0c] font-semibold">
                    Sign in
                </a>
            </p>
    </div>
</body>
</html>
