@extends('layouts.app')

@section('title', __('Log in') . ' - ' . __('Municipality Management System'))

@section('content')
<div class="max-w-md mx-auto bg-white border border-slate-200 rounded-lg shadow-sm p-6">
    <h1 class="text-xl font-bold text-slate-900 mb-6 text-start">{{ __('Log in') }}</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
            @error('email')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required
                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
            @error('password')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2">
            <input id="remember" type="checkbox" name="remember" class="rounded border-slate-300">
            <label for="remember" class="text-sm text-slate-700">{{ __('Remember me') }}</label>
        </div>

        <button type="submit" class="w-full py-2 px-4 rounded-md bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 cursor-pointer">
            {{ __('Log in') }}
        </button>
    </form>

    <p class="mt-4 text-sm text-slate-600 text-center">
        {{ __("Don't have an account?") }}
        <a href="{{ route('register') }}" class="text-slate-900 font-medium underline">{{ __('Register') }}</a>
    </p>
</div>
@endsection
