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
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autofocus maxlength="30" class="form-input" placeholder="John">
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required maxlength="30" class="form-input" placeholder="Doe">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="form-icon-wrapper">
                    <svg class="form-icon" viewBox="0 0 31.95 25.98">
                        <path
                            d="M29.72,21.85l-9.53-8.6M12,13.24L2.47,21.85M1.75,6.07l11.71,8.2c.95.66,1.42,1,1.94,1.12.46.11.93.11,1.39,0,.52-.13.99-.46,1.94-1.12l11.71-8.2M8.4,24.46h14.91c2.41,0,3.61,0,4.53-.47.81-.41,1.47-1.07,1.88-1.88.47-.92.47-2.12.47-4.53v-9.18c0-2.41,0-3.61-.47-4.53-.41-.81-1.07-1.47-1.88-1.88-.92-.47-2.12-.47-4.53-.47h-14.91c-2.41,0-3.61,0-4.53.47-.81.41-1.47,1.07-1.88,1.88-.47.92-.47,2.12-.47,4.53v9.18c0,2.41,0,3.61.47,4.53.41.81,1.07,1.47,1.88,1.88.92.47,2.12.47,4.53.47Z"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        />
                    </svg>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        maxlength="50"
                        class="form-input"
                        placeholder="your@email.com"
                    >
                </div>
            </div>

            <!-- Phone Number -->
            <div class="form-group">
                <label for="phone_no" class="form-label">Phone Number</label>
                <input type="tel" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" required maxlength="15" class="form-input" placeholder="+1234567890">
            </div>

            <!-- Date of Birth -->
            <div class="form-group">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="{{ old('dob') }}" required class="form-input">
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" required minlength="6" class="form-input" placeholder="••••••••">
                <p class="form-helper-text">Minimum 6 characters</p>
            </div>

            <!-- Password Confirmation -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6" class="form-input" placeholder="••••••••">
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
