@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4">

    <div class="bg-white shadow rounded-lg p-6">

        <h1 class="text-xl font-semibold mb-2">
            Ajukan Izin
        </h1>

        <p class="text-sm text-gray-600 mb-6">
            {{ $employee->name }} — {{ $employee->company->name }}
        </p>

        <form method="POST"
              action="{{ route('employee.permission.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="text-sm font-medium">Keterangan</label>
                <textarea name="note"
                          class="border p-2 w-full rounded"
                          rows="3"
                          placeholder="Contoh: sakit, urusan keluarga"></textarea>
            </div>

            <div class="mb-4">
                <label class="text-sm font-medium">
                    Upload Bukti (PDF / JPG / PNG)
                </label>
                <input type="file"
                       name="proof"
                       required
                       class="border p-2 w-full rounded">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('employee.dashboard') }}"
                   class="text-sm text-gray-600">
                    ← Kembali
                </a>

                <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Kirim Izin
                </button>
            </div>
        </form>

    </div>

</div>
@endsection
