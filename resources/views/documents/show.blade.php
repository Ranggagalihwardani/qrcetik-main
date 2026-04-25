@extends('layout')
@section('content')
<div class="overflow-hidden rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xl shadow-lg">
  <!-- Header -->
  <div class="px-6 py-5 border-b border-white/10 flex items-start justify-between gap-4">
    <div>
      <h2 class="text-xl font-bold text-white">{{ $doc->title }}</h2>
      <div class="mt-2 flex flex-wrap items-center gap-3 text-sm">
        {{-- Badge status --}}
        @php
          $status = strtolower($doc->status ?? '');
          $badge = match($status) {
            'generated' => 'bg-emerald-400/10 text-emerald-200 border-emerald-300/30',
            'draft'     => 'bg-yellow-400/10 text-yellow-200 border-yellow-300/30',
            default     => 'bg-slate-400/10 text-slate-200 border-slate-300/30',
          };
        @endphp
        <span class="inline-flex items-center rounded-full border px-3 py-1 font-semibold {{ $badge }}">
          {{ ucfirst($doc->status) }}
        </span>

        {{-- UUID + tombol salin --}}
        <div class="flex items-center gap-2 text-white/80">
          <span class="text-white/60">UUID:</span>
          <span id="uuidText" class="font-mono truncate max-w-[28rem]">{{ $doc->uuid }}</span>
          <button type="button" onclick="copyText('#uuidText')" class="px-2 py-1 rounded-md bg-white/10 border border-white/20 hover:bg-white/20 text-xs">
            Salin
          </button>
        </div>
      </div>
    </div>

    {{-- Aksi utama di kanan --}}
    <div class="flex flex-wrap items-center gap-2">
      @if($doc->pdf_path)
        <a
          href="{{ route('documents.download', $doc->uuid) }}"
          class="px-4 py-2 rounded-lg bg-white/10 border border-white/20 hover:bg-white/20 font-semibold">
          Download PDF
        </a>

        <a
          href="{{ route('verify.show', $doc->uuid) }}"
          class="px-4 py-2 rounded-lg bg-white/10 border border-white/20 hover:bg-white/20 font-semibold" target="_blank">
          Halaman Verifikasi
        </a>
      @endif
    </div>
  </div>

  <!-- Body -->
  <div class="px-6 py-6 space-y-6">
    {{-- Info waktu --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
      <div class="rounded-xl bg-white/5 border border-white/10 p-4">
        <div class="text-white/60">Dibuat</div>
        <div class="font-medium">{{ optional($doc->created_at)->format('d M Y H:i') }}</div>
      </div>
      <div class="rounded-xl bg-white/5 border border-white/10 p-4">
        <div class="text-white/60">Diperbarui</div>
        <div class="font-medium">{{ optional($doc->updated_at)->format('d M Y H:i') }}</div>
      </div>
      <div class="rounded-xl bg-white/5 border border-white/10 p-4">
        <div class="text-white/60">Hash (SHA256)</div>
        <div class="font-mono text-sm break-all">{{ $doc->sha256 ?? '—' }}</div>
      </div>
    </div>

    {{-- Tombol Generate --}}
    {{-- Tombol Generate --}}

<div class="flex flex-wrap items-center gap-3">
  {{-- Generate PDF + QR --}}
  <form method="post" action="{{ url('/documents/'.$doc->getKey().'/render') }}">
    @csrf
    <button class="px-4 py-2.5 rounded-lg bg-gradient-to-tr from-indigo-500 to-violet-500 border border-white/20 hover:opacity-90 font-semibold shadow">
      Generate PDF + QR
    </button>
  </form>

  {{-- Generate & Download QR (.JPG) --}}
  <form method="post" action="{{ url('/documents/'.$doc->getKey().'/render-download-qr') }}">
    @csrf
    <button class="px-4 py-2.5 rounded-lg bg-white/10 border border-white/20 hover:bg-white/20 font-semibold">
      Download QR (.JPG)
    </button>
  </form>
</div>







    @if(!$doc->pdf_path)
      <p class="text-white/60 text-sm">
        PDF belum dihasilkan. Klik <b>Generate PDF + QR</b> untuk membuat PDF & menyematkan QR.
      </p>
    @else
      <p class="text-white/60 text-sm">
        File QR juga tersedia di: <code class="font-mono">/storage/qr/{{ $doc->uuid }}.jpg</code>
      </p>
    @endif

    {{-- (Opsional) Preview PDF bila ada --}}
    @if($doc->pdf_path)
      <div class="rounded-xl overflow-hidden border border-white/10 bg-white/5">
        <iframe
          src="{{ url('/storage/'.$doc->pdf_path) }}"
          class="w-full h-[70vh]"
          title="Preview PDF"></iframe>
      </div>
    @endif
  </div>
</div>

<script>
  function copyText(selector) {
    const el = document.querySelector(selector);
    if (!el) return;
    const text = el.textContent.trim();
    navigator.clipboard.writeText(text).then(() => {
      const toast = document.createElement('div');
      toast.textContent = 'Tersalin! ✨';
      toast.className =
        'fixed top-5 right-5 z-50 px-4 py-2 rounded-lg bg-white/20 border border-white/30 backdrop-blur text-sm font-semibold';
      document.body.appendChild(toast);
      setTimeout(() => toast.remove(), 1600);
    });
  }
</script>
@endsection
