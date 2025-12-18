@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4">

    <div class="bg-gray-800 rounded-xl shadow-lg p-6">

        <h1 class="text-2xl font-semibold text-white mb-1">
            Edit Karyawan
        </h1>
        <p class="text-sm text-gray-400 mb-6">
            {{ $employee->company->name }}
        </p>

        <form method="POST"
              action="{{ route('owner.employees.update', $employee) }}">
            @csrf
            @method('PATCH')

            {{-- UID --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-300 mb-1">
                    UID (RFID / Kode)
                </label>
                <input type="text"
                       name="uid"
                       value="{{ $employee->user->uid }}"
                       class="w-full bg-gray-900 border border-gray-600 rounded-md
                              text-gray-200 px-3 py-2
                              focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- NAMA --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-300 mb-1">
                    Nama
                </label>
                <input type="text"
                       name="name"
                       value="{{ $employee->name }}"
                       required
                       class="w-full bg-gray-900 border border-gray-600 rounded-md
                              text-gray-200 px-3 py-2
                              focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- EMAIL --}}
            <div class="mb-6">
                <label class="block text-sm text-gray-300 mb-1">
                    Email
                </label>
                <input type="email"
                       name="email"
                       value="{{ $employee->user->email }}"
                       required
                       class="w-full bg-gray-900 border border-gray-600 rounded-md
                              text-gray-200 px-3 py-2
                              focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- ACTION --}}
            <div class="flex justify-between items-center">
                <a href="{{ route('owner.employees.index') }}"
                   class="text-sm text-gray-400 hover:text-white">
                    ← Kembali
                </a>

                <button type="submit"
                        class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700
                               text-white rounded-md text-sm font-medium">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
