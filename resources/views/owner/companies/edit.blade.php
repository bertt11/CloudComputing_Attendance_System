@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <div class="bg-gray-900/80 shadow rounded-xl p-6">

        <h1 class="text-2xl font-semibold text-white">
            Edit Perusahaan
        </h1>
        <p class="mt-1 text-sm text-gray-400">
            Perbarui informasi perusahaan Anda.
        </p>

        <div class="my-6 border-t border-gray-700"></div>

        <form method="POST" action="{{ route('owner.companies.update', $company) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm text-gray-300">Nama Perusahaan</label>
                <input type="text" name="name"
                       value="{{ old('name', $company->name) }}"
                       class="mt-1 w-full rounded bg-gray-800 text-white border-gray-700">
            </div>

            <div class="mb-6">
                <label class="block text-sm text-gray-300">Alamat / Deskripsi</label>
                <textarea name="address" rows="3"
                          class="mt-1 w-full rounded bg-gray-800 text-white border-gray-700">{{ old('address', $company->address) }}</textarea>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('owner.companies.index') }}"
                   class="px-4 py-2 bg-gray-700 text-white rounded">
                    Batal
                </a>

                <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
