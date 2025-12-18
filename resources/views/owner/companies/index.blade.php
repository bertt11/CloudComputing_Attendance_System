@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-white">
            Perusahaan Saya
        </h1>

        <a href="{{ route('owner.companies.create') }}"
           class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm">
            + Tambah Perusahaan
        </a>
    </div>

    <div class="bg-gray-900/70 rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-800 text-gray-300">
                <tr>
                    <th class="p-4 text-left">Nama Perusahaan</th>
                    <th class="p-4 text-left">Alamat / Deskripsi</th>
                    <th class="p-4 text-left">Dibuat</th>
                    <th class="p-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr class="border-t border-gray-700 hover:bg-gray-800 transition">
                        <td class="p-4 font-medium text-indigo-400">
                            <a href="{{ route('owner.employees.index', ['company' => $company->id]) }}"
                               class="hover:underline">
                                {{ $company->name }}
                            </a>
                        </td>
                        <td class="p-4 text-gray-300">
                            {{ $company->address ?? '-' }}
                        </td>
                        <td class="p-4 text-gray-400">
                            {{ $company->created_at->format('d M Y') }}
                        </td>
                        <td class="p-4 text-right space-x-3">
                            <a href="{{ route('owner.companies.edit', $company) }}"
                               class="text-blue-400 hover:underline text-sm">
                                Edit
                            </a>

                            <form action="{{ route('owner.companies.destroy', $company) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus perusahaan ini? Semua data karyawan akan ikut terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-400 hover:underline text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-400">
                            Belum ada perusahaan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
