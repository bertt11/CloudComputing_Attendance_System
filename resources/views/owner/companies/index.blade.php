@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Perusahaan Saya
            </h1>

            <a href="{{ route('owner.companies.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                + Tambah Perusahaan
            </a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b text-gray-600 dark:text-gray-300">
                        <th class="text-left py-2">Nama Perusahaan</th>
                        <th class="text-left py-2">Deskripsi</th>
                        <th class="text-left py-2">Dibuat</th>
                        <th class="text-left py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                        <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="py-2 font-medium text-indigo-600">
                                
                                <a href="{{ route('owner.companies.show', $company) }}"
                                   class="hover:underline">
                                    {{ $company->name }}
                                </a>
                            </td>
                            <td class="py-2 text-gray-600 dark:text-gray-300">
                                {{ $company->description ?? '-' }}
                            </td>
                            <td class="py-2 text-gray-500">
                                {{ $company->created_at->format('d M Y') }}
                            </td>
                            <td class="py-2">
                                <a href="{{ route('owner.companies.show', $company) }}"
                                   class="text-sm text-indigo-600 hover:underline">
                                    Lihat Detail →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">
                                Belum ada perusahaan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
