@extends('layout')

@section('content')
<div class="max-w-xl mx-auto space-y-4">
  <h1 class="text-2xl font-bold">Masukkan Judul</h1>

  {{-- Form upload + generate QR (tanpa embed ke PDF) --}}
  <form method="post"
        action="{{ route('qr.pdf.store') }}"
        enctype="multipart/form-data"
        class="space-y-4">
    @csrf

    <input type="text" name="title"
           class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white"
           placeholder="Misal: Surat Keterangan" value="{{ old('title') }}">
    @error('title')
      <div class="text-sm text-red-200">{{ $message }}</div>
    @enderror

    <label class="block font-semibold">Pilih PDF</label>
    <input type="file" name="pdf" accept="application/pdf" required
           class="w-full text-white">
    @error('pdf')
      <div class="text-sm text-red-200">{{ $message }}</div>
    @enderror

    {{-- ===== Payload ===== --}}
    <div>
      <label class="block font-semibold mb-2">Payload (opsional)</label>
      <textarea name="payload"
                rows="5"
                class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white placeholder:text-white/60"
                placeholder='Contoh (bebas teks/JSON):
{
  "nik": "3372xxxxxxxxxxxx",
  "nama": "Budi Santoso",
  "keterangan": "Surat keterangan aktif"
}'>{{ old('payload') }}</textarea>
      

    

      {{-- Tombol kedua: upload + embed QR ke dalam PDF + tulis payload di bawah --}}
      <button type="submit"
              formaction="{{ route('qr.store.embed') }}"
              class="px-4 py-2 rounded-lg bg-violet-500 hover:bg-violet-600 font-semibold">
        Upload & Generate + Embed ke PDF
      </button>
    </div>
  </form>
</div>
@endsection
