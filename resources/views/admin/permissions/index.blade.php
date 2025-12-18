@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">

    {{-- HEADER --}}
    <h1 class="text-3xl font-semibold text-white mb-8">
        Persetujuan Izin Karyawan
    </h1>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mb-6 bg-emerald-500/20 text-emerald-300 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-gray-800 rounded-xl shadow overflow-x-auto">

        <table class="w-full text-sm text-gray-200">
            <thead class="bg-gray-700 text-gray-300">
                <tr>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Tanggal</th>
                    <th class="p-4 text-left">Catatan</th>
                    <th class="p-4 text-left">Bukti</th>
                    <th class="p-4 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($permissions as $item)
                <tr class="border-t border-gray-700 hover:bg-gray-700/40 transition">

                    {{-- NAMA --}}
                    <td class="p-4 font-medium text-white">
                        {{ $item->employee->user->name }}
                    </td>

                    {{-- EMAIL --}}
                    <td class="p-4 text-gray-300">
                        {{ $item->employee->user->email }}
                    </td>

                    {{-- TANGGAL --}}
                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                    </td>

                    {{-- CATATAN --}}
                    <td class="p-4 text-gray-300">
                        {{ $item->note ?? '-' }}
                    </td>

                    {{-- BUKTI --}}
                    <td class="p-4">
                        @if($item->proof_file)
                            <a href="{{ $item->proof_file }}"
                               target="_blank"
                               class="text-indigo-400 hover:underline text-sm">
                                Lihat Bukti
                            </a>
                        @else
                            -
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td class="p-4 flex gap-2">

                        {{-- APPROVE --}}
                        <form method="POST"
                              action="{{ route('admin.permissions.approve', $item) }}"
                              onsubmit="return confirm('Setujui izin ini?')">
                            @csrf
                            <button class="px-3 py-1.5 rounded-lg text-xs font-semibold
                                           bg-emerald-500/20 text-emerald-300
                                           hover:bg-emerald-500/30">
                                Approve
                            </button>
                        </form>

                        {{-- REJECT --}}
                        <button
                            type="button"
                            data-id="{{ $item->id }}"
                            onclick="openRejectModal(this)"
                            class="px-3 py-1.5 rounded-lg text-xs font-semibold
                                   bg-red-500/20 text-red-300
                                   hover:bg-red-500/30">
                            Reject
                        </button>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6"
                        class="p-6 text-center text-gray-400 italic">
                        Tidak ada izin pending
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>
    </div>
</div>

{{-- MODAL REJECT --}}
<div id="rejectModal"
     class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

    <div class="bg-gray-800 rounded-xl p-6 w-full max-w-md">
        <h2 class="text-lg font-semibold text-white mb-4">
            Alasan Penolakan
        </h2>

        <form method="POST" id="rejectForm">
            @csrf

            <textarea name="reject_reason"
                      required
                      rows="3"
                      class="w-full rounded bg-gray-700 text-white
                             border border-gray-600 p-3 mb-4"
                      placeholder="Masukkan alasan penolakan"></textarea>

            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="closeRejectModal()"
                        class="px-4 py-2 text-sm bg-gray-600 rounded hover:bg-gray-500">
                    Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 text-sm bg-red-600 rounded hover:bg-red-700 text-white">
                    Tolak Izin
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
function openRejectModal(button) {
    const id = button.getAttribute('data-id');

    const modal = document.getElementById('rejectModal');
    const form  = document.getElementById('rejectForm');

    // SET ACTION DENGAN STRING BIASA (AMAN)
    form.action = '/admin/permissions/' + id + '/reject';

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeRejectModal() {
    const modal = document.getElementById('rejectModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

@endsection
