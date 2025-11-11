<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP BANK - Welcome Back</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <div class="text-center max-w-2xl px-8 -mt-20">
        <img src="{{ asset('images\Design Images\Logo\PHP BANK Logo.svg') }}" alt="PHP BANK" class="w-36 mx-auto mb-5">
        <h1 class="text-5xl lg:text-6xl font-bold mb-12 tracking-tight">Welcome Back</h1>


        <div class="flex flex-col sm:flex-row gap-6 justify-center mt-12">
            <a href="{{ route('login') }}" class="btn-primary">Log In</a>
            <a href="{{ route('register') }}" class="btn-secondary">Create Account</a>
        </div>
    </div>
</body>
</html>
