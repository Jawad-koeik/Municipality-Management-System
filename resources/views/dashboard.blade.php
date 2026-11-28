@extends('layouts.app')

@section('title', __('Dashboard') . ' - ' . __('Municipality Management System'))

@section('content')
<div class="space-y-6">
    <div class="bg-white border border-slate-200 rounded-lg p-6 shadow-sm">
        <h1 class="text-2xl font-bold text-slate-900 mb-2">
            {{ __('Welcome') }}, {{ $user->name }}
        </h1>
        <div class="flex flex-wrap gap-4 text-sm text-slate-600">
            <span>
                <strong class="text-slate-800">{{ __('Role') }}:</strong>
                {{ $user->role?->name ?? __('N/A') }}
            </span>
            @if ($user->department)
                <span>
                    <strong class="text-slate-800">{{ __('Department') }}:</strong>
                    {{ $user->department->name }}
                </span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @if ($user->hasRole(['admin', 'clerk', 'citizen']))
            <div class="bg-white border border-slate-200 rounded-lg p-5">
                <h2 class="font-semibold text-slate-900 mb-1">{{ __('Citizen Services') }}</h2>
                <p class="text-sm text-slate-600">{{ __('Certificates, service requests, and complaints.') }}</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-lg p-5">
                <h2 class="font-semibold text-slate-900 mb-1">{{ __('Permits & Licensing') }}</h2>
                <p class="text-sm text-slate-600">{{ __('Business, construction, vehicle, and event permits.') }}</p>
            </div>
        @endif

        @if ($user->hasRole(['admin', 'finance_officer', 'citizen']))
            <div class="bg-white border border-slate-200 rounded-lg p-5">
                <h2 class="font-semibold text-slate-900 mb-1">{{ __('Finance & Billing') }}</h2>
                <p class="text-sm text-slate-600">{{ __('Property taxes, utility bills, and payment receipts.') }}</p>
            </div>
        @endif

        @if ($user->hasRole(['admin', 'urban_planner']))
            <div class="bg-white border border-slate-200 rounded-lg p-5">
                <h2 class="font-semibold text-slate-900 mb-1">{{ __('Urban Planning & Projects') }}</h2>
                <p class="text-sm text-slate-600">{{ __('Municipal infrastructure projects, tasks, and budgets.') }}</p>
            </div>
        @endif

        @if ($user->hasRole(['admin', 'hr_manager']))
            <div class="bg-white border border-slate-200 rounded-lg p-5">
                <h2 class="font-semibold text-slate-900 mb-1">{{ __('HR & Staff Management') }}</h2>
                <p class="text-sm text-slate-600">{{ __('Employees, attendance tracking, and payroll.') }}</p>
            </div>
        @endif

        <div class="bg-white border border-slate-200 rounded-lg p-5">
            <h2 class="font-semibold text-slate-900 mb-1">{{ __('Events & Public Notices') }}</h2>
            <p class="text-sm text-slate-600">{{ __('Municipal announcements and community calendar.') }}</p>
        </div>
    </div>
</div>
@endsection
