@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4">

    <div class="bg-gray-800 rounded-xl shadow-lg p-6">

        {{-- HEADER --}}
        <h1 class="text-2xl font-semibold text-white mb-1">
            Tambah Karyawan
        </h1>
        <p class="text-sm text-gray-400 mb-6">
            {{ $company->name }}
        </p>

        <form method="POST"
              action="{{ route('owner.employees.store', $company) }}">
            @csrf

            {{-- UID --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-300 mb-1">
                    UID (RFID / Kode Unik)
                </label>
                <input type="text"
                       name="uid"
                       class="w-full rounded-md bg-gray-900 border border-gray-600
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
                       required
                       class="w-full rounded-md bg-gray-900 border border-gray-600
                              text-gray-200 px-3 py-2
                              focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- EMAIL --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-300 mb-1">
                    Email
                </label>
                <input type="email"
                       name="email"
                       required
                       class="w-full rounded-md bg-gray-900 border border-gray-600
                              text-gray-200 px-3 py-2
                              focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- PASSWORD --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-300 mb-1">
                    Password
                </label>
                <input type="password"
                       name="password"
                       required
                       class="w-full rounded-md bg-gray-900 border border-gray-600
                              text-gray-200 px-3 py-2
                              focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- ROLE --}}
            <div class="mb-6">
                <label class="block text-sm text-gray-300 mb-1">
                    Role
                </label>
                <select name="role"
                        class="w-full rounded-md bg-gray-900 border border-gray-600
                               text-gray-200 px-3 py-2
                               focus:ring-indigo-500">
                    <option value="employee">Employee</option>
                    <option value="admin">Admin</option>
                </select>
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
                    Simpan Karyawan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

<script>
    setInterval(async () => {
        try {
            const res = await fetch('/api/last-uid');
            const data = await res.json();

            if (data.uid) {
                const input = document.querySelector('input[name="uid"]');
                if (input && input.value !== data.uid) {
                    input.value = data.uid;
                }
            }
        } catch (e) {
            console.log('Menunggu UID...');
        }
    }, 1500);
</script>
