<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - PHP BANK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
        <!-- Back button -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('welcome') }}"
            class="back-button">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7" />
                </svg>
                <span>Back</span>
            </a>
        </div>

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
                    <svg class="form-icon" viewBox="0 0 31.95 25.98">
                        <path d="M29.72,21.85l-9.53-8.6M12,13.24L2.47,21.85M1.75,6.07l11.71,8.2c.95.66,1.42,1,1.94,1.12.46.11.93.11,1.39,0,.52-.13.99-.46,1.94-1.12l11.71-8.2M8.4,24.46h14.91c2.41,0,3.61,0,4.53-.47.81-.41,1.47-1.07,1.88-1.88.47-.92.47-2.12.47-4.53v-9.18c0-2.41,0-3.61-.47-4.53-.41-.81-1.07-1.47-1.88-1.88-.92-.47-2.12-.47-4.53-.47h-14.91c-2.41,0-3.61,0-4.53.47-.81.41-1.47,1.07-1.88,1.88-.47.92-.47,2.12-.47,4.53v9.18c0,2.41,0,3.61.47,4.53.41.81,1.07,1.47,1.88,1.88.92.47,2.12.47,4.53.47Z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                        />
                    </svg>

                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="form-input" placeholder="your@email.com">
                </div>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password" class="form-label mb-3">Password</label>
                <div class="form-icon-wrapper">
                    <svg class="form-icon" viewBox="0 0 21.79 25.14">
                        <path d="M17.47,8.57h-.34v-2.33h0c0-3.44-2.79-6.24-6.24-6.24s-6.24,2.79-6.24,6.24v2.33h-.34c-2.38,0-4.32,1.93-4.32,4.32v7.94c0,2.38,1.93,4.32,4.32,4.32h13.15c2.38,0,4.32-1.93,4.32-4.32v-7.94c0-2.38-1.93-4.32-4.32-4.32ZM6.91,8.57v-2.33h0c0-2.2,1.79-3.99,3.99-3.99s3.99,1.79,3.99,3.99h0v2.33h-7.98Z"
                            fill="currentColor"
                        />
                    </svg>

                    <input type="password" id="password" name="password" required class="form-input" placeholder="••••••••">
                </div>
            </div>

            <div class="mt-2 flex justify-end cursor-pointer">
                    <a class="auth-link">Forgot password?</a>
            </div>            

            <!-- Log In Button -->
            <button type="submit" class="btn-primary mt-8">
                Log In
            </button>
        </form>

        <!-- Register Link -->
        <p class="mt-6 text-center text-sm text-white">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-[#e87f0c] font-semibold">Create account</a>
            </p>
    </div>
</body>
</html>
