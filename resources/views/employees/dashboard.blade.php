@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
  <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h1 class="text-xl text-white font-semibold">Dashboard Karyawan</h1>
    <p class="text-sm text-white dark:text-gray-300 mt-1">Perusahaan: {{ $company->name ?? '-' }}</p>

    <div class="mt-4 text-white ">
      <h3 class="font-medium ">Informasi</h3>
      <ul class="mt-2 space-y-2 text-sm">
        <li>Anda dapat melihat jadwal & mengajukan ijin.</li>
        <li>Untuk mengajukan ijin, klik tombol di bawah dan upload berkas.</li>
      </ul>

      <div class="mt-4">
        <form action="{{ route('employee.request.leave', [$company->id ?? 0]) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
          @csrf
          <div>
            <label class="text-sm ">Alasan</label>
            <input name="reason" class="w-full mt-1 text-black px-3 py-2 border rounded-md">
          </div>
          <div>
            <label class="text-sm">Berkas (jpg, png, pdf)</label>
            <input name="file" type="file" class="w-full mt-1">
          </div>
          <div>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-md">Ajukan Ijin</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
