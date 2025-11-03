<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP BANK - Welcome Back</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#212121] text-white min-h-screen flex items-center justify-center">
    <div class="text-center max-w-2xl px-8">
        <img src="{{ asset('images/php-bank-logo.svg') }}" alt="PHP BANK" class="w-36 mx-auto mb-16">

        <h1 class="text-5xl md:text-6xl font-light mb-12 tracking-tight">Welcome Back</h1>

        <div class="flex flex-col sm:flex-row gap-6 justify-center mt-12">
            @if(Route::has('login'))
                <a href="{{ route('login') }}" class="bg-[#e87f0c] hover:bg-[#ff8f1c] text-white px-12 py-4 rounded-full font-medium transition-all">
                    Sign In
                </a>
            @else
                <a href="/login" class="bg-[#e87f0c] hover:bg-[#ff8f1c] text-white px-12 py-4 rounded-full font-medium transition-all">
                    Sign In
                </a>
            @endif

            @if(Route::has('register'))
                <a href="{{ route('register') }}" class="bg-transparent hover:border-[#666] border-2 border-[#424242] text-white px-12 py-4 rounded-full font-medium transition-all">
                    Log In
                </a>
            @else
                <a href="/register" class="bg-transparent hover:border-[#666] border-2 border-[#424242] text-white px-12 py-4 rounded-full font-medium transition-all">
                    Log In
                </a>
            @endif
        </div>
    </div>
</body>
</html>
