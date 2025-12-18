@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-12 px-4">

    <div class="bg-gray-800 rounded-xl shadow p-6">

        <h1 class="text-xl font-semibold text-white mb-1">
            Absensi Manual
        </h1>
        <p class="text-sm text-gray-400 mb-6">
            Masukkan UID karyawan untuk absen
        </p>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="mb-4 bg-emerald-500/20 text-emerald-300 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-500/20 text-red-300 px-4 py-2 rounded">
                {{ session('error') }}
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('admin.absence.uid.store') }}">
            @csrf

            <input type="text"
                   name="uid"
                   autofocus
                   placeholder="Contoh: UID123456"
                   class="w-full mb-4 rounded bg-gray-700 text-white
                          border border-gray-600 p-3 focus:ring-indigo-500">

            <button
                class="w-full py-3 rounded-lg bg-indigo-600
                       hover:bg-indigo-700 text-white font-semibold">
                Absen Sekarang
            </button>
        </form>

    </div>
</div>
@endsection
