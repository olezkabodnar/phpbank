<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PHP BANK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#212121] text-white min-h-screen">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-56 bg-[#1a1a1a] border-r border-[#2d2d2d] flex flex-col">
            <div class="p-6">
                <h2 class="text-lg font-semibold mb-6">Account Options</h2>

                <nav class="space-y-2">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-[#2d2d2d] text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-[#2d2d2d] hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span>Manage 2FA</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-[#2d2d2d] hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Change email</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-[#2d2d2d] hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        <span>Change password</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-[#2d2d2d] hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Sign Off</span>
                    </a>
                </nav>
            </div>

            <div class="mt-auto p-6 border-t border-[#2d2d2d] space-y-4">
                <a href="#" class="flex items-center gap-2 text-sm text-gray-400 hover:text-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Forgot password?</span>
                </a>

                <a href="#" class="flex items-center gap-2 text-sm text-gray-400 hover:text-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    <span>Create new account</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Top User Info -->
            <div class="flex justify-end items-center gap-2 mb-8">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-sm">{{ $account->first_name }} {{ $account->last_name }}</span>
            </div>

            <!-- Account Balance Card -->
            <div class="bg-[#2d2d2d] rounded-2xl p-8 mb-8 max-w-2xl">
                <h2 class="text-xl font-semibold mb-6">Account Balance</h2>

                <div class="bg-[#1a1a1a] rounded-xl p-6 mb-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Current Balance:</p>
                            <p class="text-3xl font-bold">${{ number_format($account->balance, 0, '', ' ') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400 mb-1">Last Transaction:</p>
                            <p class="text-3xl font-bold">-$200</p>
                            <p class="text-xs text-gray-400 mt-1">(funds transfer)</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button class="flex items-center gap-2 px-6 py-3 bg-[#e87f0c] hover:bg-[#ff8f1c] rounded-full font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        <span>Top up</span>
                    </button>

                    <button class="flex items-center gap-2 px-6 py-3 bg-[#e87f0c] hover:bg-[#ff8f1c] rounded-full font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                        <span>Transfer</span>
                    </button>

                    <button class="flex items-center gap-2 px-6 py-3 bg-[#e87f0c] hover:bg-[#ff8f1c] rounded-full font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Transactions</span>
                    </button>
                </div>
            </div>

            <!-- Account Details Card -->
            <div class="bg-[#2d2d2d] rounded-2xl p-8 max-w-2xl">
                <h2 class="text-xl font-semibold mb-6">Account Details</h2>

                <div class="grid grid-cols-2 gap-8">
                    <!-- User Email Section -->
                    <div class="bg-[#1a1a1a] rounded-xl p-6">
                        <p class="text-xs text-gray-400 mb-4">User Email</p>
                        <p class="font-medium mb-6 underline">{{ $account->email }}</p>

                        <div class="flex items-center gap-3 text-sm">
                            <span>password: ********</span>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Account Security Section -->
                    <div class="bg-[#1a1a1a] rounded-xl p-6">
                        <p class="text-xs text-gray-400 mb-4">Account Security</p>
                        <div class="mb-2">
                            <p class="text-xs text-gray-400">Last Login:</p>
                            <p class="font-medium">{{ $account->updated_at->format('d M Y') }}</p>
                        </div>

                        <div class="flex items-center gap-3 text-sm mt-6">
                            <span>2FA Status: <span class="text-green-400 font-semibold">Active</span></span>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
