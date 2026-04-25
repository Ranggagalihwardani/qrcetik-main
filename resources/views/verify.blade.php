@extends('layout')
@section('content')
  <div class="overflow-hidden rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xl shadow-lg p-6 max-w-5xl mx-auto">
    <h2 class="text-lg font-bold mb-4">Verifikasi Dokumen</h2>

    <div class="space-y-2 text-sm">
      <p>Judul: <b>{{ $public['title'] }}</b></p>
      <p>UUID: <span class="font-mono">{{ $public['uuid'] }}</span></p>
      <p>Status: <b>{{ strtoupper($public['status']) }}</b></p>
      <p>Dibuat: {{ $public['created'] }} | Diperbarui: {{ $public['updated'] }}</p>
      <p>Hash (SHA256): <code>{{ $public['sha256'] }}</code></p>
    </div>

    <div class="mt-4">
      @if(!empty($public['download_url']))
        <a class="px-4 py-2 rounded-lg bg-gradient-to-tr from-indigo-500 to-violet-500 border border-white/20 hover:opacity-95 font-semibold inline-block"
           href="{{ $public['download_url'] }}" target="_blank">Download PDF Asli</a>
      @else
        <p class="text-white/60">PDF belum digenerate.</p>
      @endif
    </div>

    <hr class="my-6 border-white/20">
    <p class="text-white/60 text-sm">Scan QR pada dokumen fisik akan membuka halaman ini untuk cek keaslian.</p>
  </div>
@endsection
