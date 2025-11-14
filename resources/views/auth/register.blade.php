<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - PHP BANK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page py-30">
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
            <h1 class="auth-title">Create Account</h1>
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

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="auth-form register">
            @csrf

            <!-- First Name -->
            <div class="form-group">
                <label for="first_name" class="form-label">First Name</label>
                <div class="form-icon-wrapper">
                    <svg class="form-icon" viewBox="0 0 23 26" aria-hidden="true">
                        <circle cx="11.5" cy="7" r="7" fill="currentColor" stroke="none" stroke-width="2"/>
                        <path d="M0,26v-4.23c0-3.74,3.89-6.77,8.68-6.77h5.63c4.8,0,8.68,3.03,8.68,6.77v4.23"
                            fill="currentColor" stroke="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autofocus maxlength="30" class="form-input" placeholder="John">
                </div>
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="last_name" class="form-label">Last Name</label>
                <div class="form-icon-wrapper">
                    <svg class="form-icon" viewBox="0 0 23 26" aria-hidden="true">
                        <circle cx="11.5" cy="7" r="7" fill="currentColor" stroke="none" stroke-width="2"/>
                        <path d="M0,26v-4.23c0-3.74,3.89-6.77,8.68-6.77h5.63c4.8,0,8.68,3.03,8.68,6.77v4.23"
                            fill="currentColor" stroke="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required maxlength="30" class="form-input" placeholder="Doe">
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="form-icon-wrapper">
                    <svg class="form-icon" viewBox="0 0 31.95 25.98">
                        <path d="M29.72,21.85l-9.53-8.6M12,13.24L2.47,21.85M1.75,6.07l11.71,8.2c.95.66,1.42,1,1.94,1.12.46.11.93.11,1.39,0,.52-.13.99-.46,1.94-1.12l11.71-8.2M8.4,24.46h14.91c2.41,0,3.61,0,4.53-.47.81-.41,1.47-1.07,1.88-1.88.47-.92.47-2.12.47-4.53v-9.18c0-2.41,0-3.61-.47-4.53-.41-.81-1.07-1.47-1.88-1.88-.92-.47-2.12-.47-4.53-.47h-14.91c-2.41,0-3.61,0-4.53.47-.81.41-1.47,1.07-1.88,1.88-.47.92-.47,2.12-.47,4.53v9.18c0,2.41,0,3.61.47,4.53.41.81,1.07,1.47,1.88,1.88.92.47,2.12.47,4.53.47Z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                        />
                    </svg>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required maxlength="50" class="form-input" placeholder="your@email.com">
                </div>
            </div>

            <!-- Phone Number -->
            <div class="form-group">
                <label for="phone_no" class="form-label">Phone Number</label>
                <div class="form-icon-wrapper">
                    <svg class="form-icon" viewBox="0 0 23 26" aria-hidden="true">
                        <circle cx="11.5" cy="7" r="7" fill="currentColor" stroke="none" stroke-width="2"/>
                        <path d="M0,26v-4.23c0-3.74,3.89-6.77,8.68-6.77h5.63c4.8,0,8.68,3.03,8.68,6.77v4.23"
                            fill="currentColor" stroke="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        />
                    </svg>
                    <input type="tel" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" required maxlength="15" class="form-input" placeholder="+1234567890">
                </div>
            </div>

            <!-- Date of Birth -->
            <div class="form-group mt-4">
                <label for="dob" class="form-label">Date of Birth</label>
                <div class="form-icon-wrapper">
                    <input type="date" id="dob" name="dob" value="{{ old('dob') }}" required class="form-input date-input">
                    <svg class="form-icon date-icon" viewBox="0 0 262 229" fill="#ffffff">
                        <path d="M237.02,26.12h-39.87v-15.93c0-5.63-4.57-10.2-10.2-10.2h-1.7c-5.63,0-10.2,4.57-10.2,10.2v15.93h-87.11v-15.93c0-5.63-4.57-10.2-10.2-10.2h-1.7c-5.63,0-10.2,4.57-10.2,10.2v15.93H25.97C11.63,26.12,0,37.75,0,52.09v151.93c0,14.34,11.63,25.97,25.97,25.97h211.05c14.34,0,25.97-11.63,25.97-25.97V52.09c0-14.34-11.63-25.97-25.97-25.97ZM249.72,190.79c0,14.34-11.63,25.97-25.97,25.97H39.23c-14.34,0-25.97-11.63-25.97-25.97v-102.25c0-14.34,11.63-25.97,25.97-25.97h184.53c14.34,0,25.97,11.63,25.97,25.97v102.25Z"/>
                    </svg>
                </div>  
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="form-icon-wrapper">
                    <svg class="form-icon" viewBox="0 0 21.79 25.14">
                        <path d="M17.47,8.57h-.34v-2.33h0c0-3.44-2.79-6.24-6.24-6.24s-6.24,2.79-6.24,6.24v2.33h-.34c-2.38,0-4.32,1.93-4.32,4.32v7.94c0,2.38,1.93,4.32,4.32,4.32h13.15c2.38,0,4.32-1.93,4.32-4.32v-7.94c0-2.38-1.93-4.32-4.32-4.32ZM6.91,8.57v-2.33h0c0-2.2,1.79-3.99,3.99-3.99s3.99,1.79,3.99,3.99h0v2.33h-7.98Z"
                            fill="currentColor"
                        />
                    </svg>
                <input type="password" id="password" name="password" required minlength="6" class="form-input" placeholder="••••••••">
                </div>
                <p class="form-helper-text">Minimum 6 characters</p>
            </div>

            <!-- Password Confirmation -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="form-icon-wrapper">
                    <svg class="form-icon" viewBox="0 0 21.79 25.14">
                        <path d="M17.47,8.57h-.34v-2.33h0c0-3.44-2.79-6.24-6.24-6.24s-6.24,2.79-6.24,6.24v2.33h-.34c-2.38,0-4.32,1.93-4.32,4.32v7.94c0,2.38,1.93,4.32,4.32,4.32h13.15c2.38,0,4.32-1.93,4.32-4.32v-7.94c0-2.38-1.93-4.32-4.32-4.32ZM6.91,8.57v-2.33h0c0-2.2,1.79-3.99,3.99-3.99s3.99,1.79,3.99,3.99h0v2.33h-7.98Z"
                            fill="currentColor"
                        />
                    </svg>
                <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6" class="form-input" placeholder="••••••••">
                </div>
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn-primary mt-8">
                Create Account
            </button>
        </form>

        <!-- Sign In Link -->
        <p class="mt-6 text-center text-sm text-white">
            Already have an account?
            <a href="{{ route('login') }}" class="text-[#e87f0c] font-semibold">
                Log in
            </a>
        </p>
    </div>
</body>
</html>
