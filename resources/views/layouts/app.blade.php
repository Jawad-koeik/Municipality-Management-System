<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', __('Municipality Management System'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=cairo:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-50 text-slate-900 antialiased min-h-screen font-sans">
        <div class="min-h-screen flex flex-col">
            <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                <a href="{{ url('/') }}" class="text-lg font-bold text-slate-900">
                    {{ __('Municipality Management System') }}
                </a>

                <nav class="flex items-center gap-4 text-sm">
                    @if (app()->getLocale() === 'ar')
                        <a href="{{ route('locale.switch', 'en') }}" class="px-2.5 py-1 rounded border border-slate-300 text-slate-700 hover:bg-slate-100">
                            English
                        </a>
                    @else
                        <a href="{{ route('locale.switch', 'ar') }}" class="px-2.5 py-1 rounded border border-slate-300 text-slate-700 hover:bg-slate-100">
                            العربية
                        </a>
                    @endif

                    @auth
                        <a href="{{ route('dashboard') }}" class="text-slate-700 hover:text-slate-900 font-medium">
                            {{ __('Dashboard') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 rounded bg-slate-200 text-slate-800 hover:bg-slate-300 cursor-pointer">
                                {{ __('Log out') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-700 hover:text-slate-900">
                            {{ __('Log in') }}
                        </a>
                        <a href="{{ route('register') }}" class="px-3 py-1.5 rounded bg-slate-900 text-white hover:bg-slate-800">
                            {{ __('Register') }}
                        </a>
                    @endauth
                </nav>
            </header>

            <main class="flex-1 container mx-auto px-6 py-8">
                @yield('content')
            </main>
        </div>
    </body>
</html>
