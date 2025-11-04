<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - PHP BANK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page py-8">
    <div class="auth-container">
        <!-- Header -->
        <div class="auth-header">
            <img src="{{ asset('images/php-bank-logo.svg') }}" alt="PHP BANK" class="auth-logo">
            <h1 class="auth-title">Create Account</h1>
            <p class="auth-subtitle">Join PHP BANK today</p>
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
                <input type="email" id="email" name="email" value="{{ old('email') }}" required maxlength="50" class="form-input" placeholder="your@email.com">
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

        <!-- Divider -->
        <div class="divider-section">
            <div class="divider-line">
                <div class="divider-border"></div>
            </div>
            <div class="divider-text">
                <span class="divider-label">Already have an account?</span>
            </div>
        </div>

        <!-- Sign In Link -->
        <a href="{{ route('login') }}" class="btn-secondary">
            Sign In Instead
        </a>
    </div>
</body>
</html>
