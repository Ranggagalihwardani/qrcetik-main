@extends('layout')

@section('content')
  <section class="max-w-7xl mx-auto">
    {{-- Title --}}
    <div class="text-center mb-10">
      <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Buat Kode QR dalam 3 langkah</h1>
      <p class="mt-2 text-white/70">Cepat, mudah, dan bisa disesuaikan.</p>
    </div>

    {{-- Steps --}}
    <div class="grid gap-6 md:grid-cols-3">
      {{-- Step 1 --}}
      <div class="rounded-2xl bg-white/5 border border-white/10 p-6 hover:bg-white/[0.07] transition shadow">
        <div class="aspect-[4/3] mb-6 rounded-xl bg-gradient-to-tr from-fuchsia-500/15 via-violet-500/10 to-indigo-500/15
                    border border-white/10 flex items-center justify-center">
          {{-- simple illustration --}}
          <svg viewBox="0 0 200 120" class="w-5/6 h-auto" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="16" y="18" width="168" height="84" rx="8" class="text-white/20" />
            <rect x="30" y="38" width="52" height="18" rx="6" class="text-white/40" />
            <rect x="88" y="38" width="52" height="18" rx="6" class="text-fuchsia-400/70" />
            <rect x="146" y="38" width="24" height="18" rx="6" class="text-white/30" />
            <rect x="30" y="66" width="36" height="16" rx="5" class="text-white/30" />
            <rect x="70" y="66" width="28" height="16" rx="5" class="text-white/20" />
            <rect x="102" y="66" width="32" height="16" rx="5" class="text-white/20" />
          </svg>
        </div>

        <span class="inline-block mb-3 px-3 py-1 rounded-full text-xs font-bold bg-fuchsia-400/20 text-fuchsia-200 border border-fuchsia-300/30">
          Melangkah 1
        </span>
        <h3 class="text-xl font-bold mb-1">Buat Kode QR Dalam 3 Langkah</h3>
        <p class="text-white/70 text-sm mb-4">Pilih tipe konten: Link, Teks, PDF, Gambar, atau lainnya.</p>

        
      </div>

      {{-- Step 2 --}}
      <div class="rounded-2xl bg-white/5 border border-white/10 p-6 hover:bg-white/[0.07] transition shadow">
        <div class="aspect-[4/3] mb-6 rounded-xl bg-gradient-to-tr from-violet-500/15 via-indigo-500/10 to-sky-500/15
                    border border-white/10 flex items-center justify-center">
          <svg viewBox="0 0 200 120" class="w-5/6 h-auto" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="28" y="26" width="144" height="68" rx="8" class="text-white/20" />
            <rect x="44" y="48" width="112" height="16" rx="6" class="text-white/35" />
            <rect x="64" y="72" width="72" height="18" rx="8" class="text-violet-300/80" />
          </svg>
        </div>

        <span class="inline-block mb-3 px-3 py-1 rounded-full text-xs font-bold bg-violet-400/20 text-violet-200 border border-violet-300/30">
          Melangkah 2
        </span>
        <h3 class="text-xl font-bold mb-1">Hasilkan Kode QR</h3>
        <p class="text-white/70 text-sm mb-4">Masukkan URL atau konten lain, lalu generate QR secara instan.</p>

        
      </div>

      {{-- Step 3 --}}
      <div class="rounded-2xl bg-white/5 border border-white/10 p-6 hover:bg-white/[0.07] transition shadow">
        <div class="aspect-[4/3] mb-6 rounded-xl bg-gradient-to-tr from-purple-500/15 via-fuchsia-500/10 to-pink-500/15
                    border border-white/10 flex items-center justify-center">
          {{-- QR mock --}}
          <div class="w-28 h-28 rounded-2xl bg-white/90 p-2 text-slate-800 shadow-inner">
            <div class="grid grid-cols-5 gap-1 w-full h-full">
              @for($i=0;$i<25;$i++)
                <div class="{{ in_array($i,[0,2,4,6,7,9,12,14,16,18,20,22,24]) ? 'bg-slate-800' : 'bg-slate-300' }}"></div>
              @endfor
            </div>
          </div>
        </div>

        <span class="inline-block mb-3 px-3 py-1 rounded-full text-xs font-bold bg-purple-400/20 text-purple-200 border border-purple-300/30">
          Melangkah 3
        </span>
        <h3 class="text-xl font-bold mb-1">Sesuaikan & Unduh</h3>
        <p class="text-white/70 text-sm mb-4">Ganti warna, tambahkan label, lalu unduh PNG/SVG/PDF.</p>

        
      </div>
    </div>

    {{-- Tips --}}
    <div class="mt-8 text-sm text-white/60">
      <span class="mr-2">💡</span>Ingin langsung coba? Buka <a class="underline hover:no-underline" href="{{ route('qr.index') }}">QR Generator</a>.
    </div>

    
  </section>
@endsection
