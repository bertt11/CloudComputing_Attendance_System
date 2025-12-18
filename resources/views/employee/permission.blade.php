@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-12 px-4">

    <div class="bg-gray-800 shadow-lg rounded-xl p-6">

        {{-- HEADER --}}
        <h1 class="text-2xl font-semibold text-white mb-1">
            Ajukan Izin
        </h1>

        <p class="text-sm text-gray-400 mb-8">
            {{ $employee->name }} — {{ $employee->company->name }}
        </p>

        <form method="POST"
              action="{{ route('employee.permission.store') }}"
              enctype="multipart/form-data">
            @csrf

            {{-- KETERANGAN --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Keterangan
                </label>

                <textarea name="note"
                          rows="3"
                          placeholder="Contoh: sakit, urusan keluarga"
                          class="w-full rounded-lg bg-gray-900 border border-gray-700
                                 text-gray-100 placeholder-gray-500
                                 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>

            {{-- FILE BUKTI --}}
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Upload Bukti
                    <span class="text-xs text-gray-500">(PDF / JPG / PNG)</span>
                </label>

                <input type="file"
                       name="proof"
                       required
                       class="block w-full text-sm text-gray-300
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-lg file:border-0
                              file:bg-indigo-600 file:text-white
                              hover:file:bg-indigo-700
                              cursor-pointer bg-gray-900 border border-gray-700 rounded-lg">
            </div>

            {{-- ACTION --}}
            <div class="flex justify-between items-center">
                <a href="{{ route('employee.dashboard') }}"
                   class="text-sm text-gray-400 hover:text-white transition">
                    ← Kembali
                </a>

                <button type="submit"
                        class="px-5 py-2.5 rounded-lg
                               bg-indigo-600 hover:bg-indigo-700
                               text-white text-sm font-medium
                               transition shadow">
                    Kirim Izin
                </button>
            </div>
        </form>

    </div>

</div>
@endsection
