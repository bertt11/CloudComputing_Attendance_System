@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-12 px-4">
    <div class="bg-gray-800 rounded-xl shadow p-6">

        <h1 class="text-xl font-semibold text-white mb-4">
            Absensi
        </h1>

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

            {{-- UID (AUTO DARI SCAN) --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-300 mb-1">
                    UID (RFID / Kode Unik)
                </label>
                <input type="text"
                       name="uid"
                       readonly
                       placeholder="Silakan scan kartu RFID"
                       class="w-full rounded-md bg-gray-900 border border-gray-600
                              text-gray-200 px-3 py-2 ">
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                class="w-full py-3 rounded-lg bg-indigo-600
                       hover:bg-indigo-700 text-white font-semibold">
                Absen Sekarang
            </button>
        </form>

    </div>
</div>
@endsection

{{-- AUTO AMBIL UID DARI IOT --}}
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
