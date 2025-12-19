@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-12 px-4">

    <div class="bg-gray-800 rounded-xl shadow p-6">

        <h1 class="text-xl font-semibold text-white mb-1">
            Absensi
        </h1>
        <div class="mb-4">
                <label class="block text-sm text-gray-300 mb-1">
                   MASUKAN UID (RFID / Kode Unik)
                </label>
                <input type="text"
                       name="uid"
                       class="w-full rounded-md bg-gray-900 border border-gray-600
                              text-gray-200 px-3 py-2
                              focus:ring-indigo-500 focus:border-indigo-500">
            </div>

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

            <input type="text"
        name="uid"
        id="uidInput"
        value="{{ $lastAttendance?->employee?->user?->uid }}"
        readonly
        class="w-full mb-4 rounded bg-gray-700 text-white
                border border-gray-600 p-3">


            <button
                class="w-full py-3 rounded-lg bg-indigo-600
                       hover:bg-indigo-700 text-white font-semibold">
                Absen Sekarang
            </button>
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
