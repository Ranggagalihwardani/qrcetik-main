@extends('layout')
@section('content')
  <div class="overflow-hidden rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xl shadow-lg p-10 max-w-3xl min-h-[400px] mx-auto flex flex-col justify-center">
    <h2 class="text-xl font-bold mb-6 text-center">Verifikasi Dokumen</h2>

    <form method="GET" action="{{ route('verify.index') }}" class="space-y-6">
      <div>
        <label class="block text-sm font-semibold mb-2">Masukkan UUID</label>
        <input name="uuid" type="text" required
               class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 placeholder:text-white/60 text-white focus:outline-none focus:ring-2 focus:ring-white/40"
               placeholder="contoh: 7208...5f691">
      </div>

      <div class="flex justify-end">
        <button class="px-5 py-3 rounded-lg bg-gradient-to-tr from-indigo-500 to-violet-500 border border-white/20 font-semibold hover:opacity-90">
          Cek Keaslian
        </button>
      </div>
    </form>
  </div>
@endsection
