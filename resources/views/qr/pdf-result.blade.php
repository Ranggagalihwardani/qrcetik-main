@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white/10 backdrop-blur p-8 rounded-2xl shadow text-center">
    <h1 class="text-2xl font-bold mb-6">{{ $title }}</h1>

    <div class="text-left text-white/80 bg-white/5 border border-white/10 rounded-xl p-6 mb-6">
      <div><span class="text-white/60">UUID:</span> <span class="font-mono">{{ $upload->uuid }}</span></div>
      @if($upload->title)
        <div><span class="text-white/60">Judul:</span> {{ $upload->title }}</div>
      @endif
      <div><span class="text-white/60">Nama File:</span> {{ $upload->original_name }}</div>
      <div><span class="text-white/60">Hash:</span> <span class="font-mono break-all">{{ $upload->pdf_sha256 }}</span></div>
    </div>

    <p class="mb-6">Scan QR ini untuk membuka PDF:</p>

    <div class="bg-white p-6 rounded-lg inline-block">
        <img src="{{ $qr }}" alt="QR Code" class="w-72 h-72 mx-auto">
    </div>

    <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
        <a href="{{ $url }}" target="_blank"
           class="px-6 py-3 rounded-lg bg-indigo-500 text-white font-semibold hover:bg-indigo-600 transition text-center">
            Lihat PDF
        </a>

        <a href="{{ route('qr.download.qr', $upload->uuid) }}"
           class="px-6 py-3 rounded-lg bg-green-500 text-white font-semibold hover:bg-green-600 transition text-center">
            Download QR
        </a>

        <a href="{{ route('qr.download.pdf', $upload->uuid) }}"
           class="px-6 py-3 rounded-lg bg-white/10 border border-white/20 hover:bg-white/20 font-semibold transition text-center">
            Download PDF
        </a>
    </div>
</div>
@endsection
