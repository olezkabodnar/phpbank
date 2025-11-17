<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PHP BANK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dashboard-page">

    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title">Account Options</h2>

                <nav class="sidebar-nav">
                    <a href="{{ route('account.index') }}" class="sidebar-link {{ request()->routeIs('account.index') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('account.twoFA') }}" class="sidebar-link {{ request()->routeIs('account.twoFA') ? 'active' : '' }}">
                        <svg class="w-5 h-5" viewBox="0 0 21.79 25.14">
                            <path d="M17.47,8.57h-.34v-2.33h0c0-3.44-2.79-6.24-6.24-6.24s-6.24,2.79-6.24,6.24v2.33h-.34c-2.38,0-4.32,1.93-4.32,4.32v7.94c0,2.38,1.93,4.32,4.32,4.32h13.15c2.38,0,4.32-1.93,4.32-4.32v-7.94c0-2.38-1.93-4.32-4.32-4.32ZM6.91,8.57v-2.33h0c0-2.2,1.79-3.99,3.99-3.99s3.99,1.79,3.99,3.99h0v2.33h-7.98Z"
                                fill="currentColor"/>
                        </svg>
                        <span>Manage 2FA</span>
                    </a>

                    <a href="{{ route('account.changeEmail') }}" class="sidebar-link {{ request()->routeIs('account.changeEmail') ? 'active' : '' }}">
                        <svg class="w-5 h-5" viewBox="0 0 31.95 25.98">
                            <path d="M29.72,21.85l-9.53-8.6M12,13.24L2.47,21.85M1.75,6.07l11.71,8.2c.95.66,1.42,1,1.94,1.12.46.11.93.11,1.39,0,.52-.13.99-.46,1.94-1.12l11.71-8.2M8.4,24.46h14.91c2.41,0,3.61,0,4.53-.47.81-.41,1.47-1.07,1.88-1.88.47-.92.47-2.12.47-4.53v-9.18c0-2.41,0-3.61-.47-4.53-.41-.81-1.07-1.47-1.88-1.88-.92-.47-2.12-.47-4.53-.47h-14.91c-2.41,0-3.61,0-4.53.47-.81.41-1.47,1.07-1.88,1.88-.47.92-.47,2.12-.47,4.53v9.18c0,2.41,0,3.61.47,4.53.41.81,1.07,1.47,1.88,1.88.92.47,2.12.47,4.53.47Z"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                        </svg>
                        <span>Change email</span>
                    </a>

                    <a href="{{ route('account.changePassword') }}" class="sidebar-link {{ request()->routeIs('account.changePassword') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        <span>Change password</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="sidebar-button-form">
                        @csrf
                        <button type="submit" class="sidebar-button">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Sign Off</span>
                        </button>
                    </form>
                </nav>
            </div>

            <div class="sidebar-footer">
                <a href="{{ route('password.recovery') }}" class="sidebar-footer-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Forgot password?</span>
                </a>

                <a href="{{ route('register') }}" class="sidebar-footer-link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    <span>Create new account</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

</body>
</html>
