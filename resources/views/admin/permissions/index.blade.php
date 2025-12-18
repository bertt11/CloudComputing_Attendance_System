@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">

    <h1 class="text-2xl font-semibold mb-6">
        Persetujuan Izin Karyawan
    </h1>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Perusahaan</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Catatan</th>
                    <th class="p-3 text-left">Bukti</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permissions as $item)
                    <tr class="border-t">
                        <td class="p-3">
                            {{ $item->employee->user->name }}
                        </td>
                        <td class="p-3">
                            {{ $item->company->name }}
                        </td>
                        <td class="p-3">
                            {{ $item->date->format('d M Y') }}
                        </td>
                        <td class="p-3">
                            {{ $item->note ?? '-' }}
                        </td>
                        <td class="p-3">
                            @if($item->proof_file)
                                <a href="{{ $item->proof_file }}"
                                   target="_blank"
                                   class="text-indigo-600 underline">
                                    Lihat Bukti
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-3 flex gap-2">
                            <form method="POST"
                                  action="{{ route('admin.permissions.approve', $item) }}">
                                @csrf
                                <button class="bg-green-600 text-white px-3 py-1 rounded">
                                    Approve
                                </button>
                            </form>

                            <form method="POST"
                                  action="{{ route('admin.permissions.reject', $item) }}">
                                @csrf
                                <button class="bg-red-600 text-white px-3 py-1 rounded">
                                    Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                            Tidak ada izin pending.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
