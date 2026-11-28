@extends('layouts.app')

@section('title', __('Register') . ' - ' . __('Municipality Management System'))

@section('content')
<div class="max-w-lg mx-auto bg-white border border-slate-200 rounded-lg shadow-sm p-6">
    <h1 class="text-xl font-bold text-slate-900 mb-6 text-start">{{ __('Citizen Registration') }}</h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Full Name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
            @error('name')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="national_id" class="block text-sm font-medium text-slate-700 mb-1">{{ __('National ID') }}</label>
                <input id="national_id" type="text" name="national_id" value="{{ old('national_id') }}" required
                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                @error('national_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="contact" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Phone / Contact') }}</label>
                <input id="contact" type="text" name="contact" value="{{ old('contact') }}" required
                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                @error('contact')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Date of Birth') }}</label>
                <input id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required
                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                @error('date_of_birth')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Address') }}</label>
            <input id="address" type="text" name="address" value="{{ old('address') }}" required
                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
            @error('address')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required
                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
            </div>
        </div>

        <button type="submit" class="w-full py-2 px-4 rounded-md bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 cursor-pointer">
            {{ __('Create Account') }}
        </button>
    </form>

    <p class="mt-4 text-sm text-slate-600 text-center">
        {{ __('Already have an account?') }}
        <a href="{{ route('login') }}" class="text-slate-900 font-medium underline">{{ __('Log in') }}</a>
    </p>
</div>
@endsection
