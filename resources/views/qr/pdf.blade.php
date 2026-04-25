@extends('layout')
@section('content')
  <div class="rounded-2xl bg-white/10 border border-white/20 p-6">
    <h2 class="text-xl font-bold mb-6">Buat QR untuk PDF</h2>

    <form method="post" action="{{ route('qr.pdf.store') }}" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <input type="file" name="pdf" accept="application/pdf" required
             class="block w-full text-sm text-white bg-white/10 border border-white/20 rounded-lg p-2">
      <button type="submit"
              class="px-5 py-2.5 rounded-lg bg-gradient-to-tr from-indigo-500 to-violet-500 font-semibold">
        Upload & Generate QR
      </button>
    </form>

    @if(session('ok'))
  <div class="mt-4 text-green-400">{{ session('ok') }}</div>
  <div class="mt-2">
    <p><strong>PDF:</strong> <a href="{{ session('pdfPath') }}" target="_blank" class="underline">Lihat PDF</a></p>
    <img src="{{ asset(session('qrPath')) }}" alt="QR Code" class="mt-2 w-48">
  </div>
@endif

  </div>
@endsection
