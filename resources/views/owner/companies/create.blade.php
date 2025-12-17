@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">

        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
            Buat Perusahaan
        </h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
            Lengkapi data perusahaan Anda untuk mulai menggunakan sistem.
        </p>

        <div class="my-6 border-t border-gray-200 dark:border-gray-700"></div>

        <form method="POST" action="{{ route('owner.companies.store') }}">
            @csrf

            {{-- Nama Perusahaan --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Nama Perusahaan
                </label>
                <input type="text"
                       name="name"
                       required
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Deskripsi (opsional) --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Deskripsi (opsional)
                </label>
                <textarea name="description"
                          rows="3"
                          class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>

            {{-- ACTION --}}
            <div class="flex justify-end gap-2">
                <a href="{{ route('owner.dashboard') }}"
                   class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md text-sm">
                    Batal
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium">
                    Simpan Perusahaan
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
