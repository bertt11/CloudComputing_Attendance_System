@extends('layouts.app')
@section('content')
@php
    use Illuminate\Support\Facades\Auth;
    // cari company id yang relevan: prioritas session -> user.company_id -> first company -> 1
    $companyId = session('company_id') ?? Auth::user()->company_id ?? (\App\Models\Company::first()?->id ?? 1);
@endphp

<div class="max-w-7xl mx-auto py-8 px-4">
  <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Dashboard</h2>
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Selamat datang, {{ $user->name }} — role: <span class="font-medium">{{ $user->role }}</span></p>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
      <div class="p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg">
        <div class="text-sm text-indigo-700 dark:text-indigo-200">Perusahaan</div>
        <div class="mt-2 text-2xl font-bold text-indigo-900 dark:text-indigo-100">
          {{ \App\Models\Company::count() }}
        </div>
      </div>

      <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
        <div class="text-sm text-green-700 dark:text-green-200">Karyawan</div>
        <div class="mt-2 text-2xl font-bold text-green-900 dark:text-green-100">
          {{ \App\Models\Employee::count() }}
        </div>
      </div>

      <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
        <div class="text-sm text-yellow-700 dark:text-yellow-200">Absensi (Hari ini)</div>
        <div class="mt-2 text-2xl font-bold text-yellow-900 dark:text-yellow-100">
          {{ \App\Models\Attendance::whereDate('time', now())->count() }}
        </div>
      </div>
    </div>

    <div class="mt-6">
      @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.attendances.index', ['company' => $companyId]) }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md">Lihat Absensi</a>
      @elseif(auth()->user()->role === 'owner')
        <a href="{{ route('owner.companies.index') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md">Kelola Perusahaan</a>
      @elseif(auth()->user()->role === 'employee')
        <a href="{{ route('employee.dashboard') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md">Lihat Dashboard Saya</a>
      @else
        <!-- fallback: link ke homepage -->
        <a href="{{ route('home') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded-md">Home</a>
      @endif
    </div>
  </div>
</div>
@endsection
