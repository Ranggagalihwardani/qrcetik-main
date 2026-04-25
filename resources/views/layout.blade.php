<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'CetakCetik' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    ::-webkit-scrollbar { width: 8px; height: 8px; }
    ::-webkit-scrollbar-thumb { background: rgba(255,255,255,.15); border-radius: 8px; }
    ::-webkit-scrollbar-track { background: transparent; }
  </style>
</head>
<body class="bg-gradient-to-tr from-slate-800 via-indigo-900 to-purple-900 font-sans text-white">

  <!-- ===== Sidebar: fixed, tidak ikut scroll halaman ===== -->
  <aside id="sidebar"
         class="fixed left-0 top-0 w-64 h-screen bg-white/5 backdrop-blur-xl border-r border-white/10 flex flex-col">
    <div class="px-6 py-5 border-b border-white/10">
      <h1 class="text-xl font-extrabold text-white">QRHasanNet</h1>
      <p class="text-sm text-white/60">cetak PDF, cetik QR!</p>
    </div>

    <!-- Konten sidebar bisa scroll sendiri jika tinggi konten melebihi layar -->
    <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
      <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
        <span>🏠</span><span>Dashboard</span>
      </a>
      <a href="{{ route('documents.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
        <span>📝</span><span>Buat Dokumen</span>
      </a>
      <a href="{{ route('documents.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
        <span>📄</span><span>Dokumen</span>
      </a>
      <a href="{{ route('verify.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
        <span>✅</span><span>Verifikasi</span>
      </a>

      <a href="{{ route('qr.pdf.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
        <span>📤</span><span>Upload PDF</span>
      </a>
      <!-- ====== PDF → QR ====== -->
      <a href="{{ route('qr.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
        <span>📚</span><span>Daftar Upload</span>
      </a>
      <!--
        Catatan:
        - Jika di project-mu nama rute masih 'qr.pdf.index' dan 'qr.pdf.create',
          ganti route('qr.index') → route('qr.pdf.index')
          dan  route('qr.create') → route('qr.pdf.create')
      -->

      <div class="border-t border-white/10 mt-4 pt-4">
        <a href="/settings" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
          <span>⚙️</span><span>Settings</span>
        </a>
      </div>
    </nav>

    <div class="px-6 py-4 border-t border-white/10 text-xs text-white/50">
  {{ config('app.footer') }}
</div>

  </aside>

  <!-- ===== Main: digeser ke kanan pakai margin-left agar tidak ketutup sidebar ===== -->
  <div class="ml-64 h-screen flex flex-col overflow-hidden">
    <!-- Header tetap sticky di area main (bagian kanan) -->
    <header class="flex-none sticky top-0 bg-white/5 backdrop-blur-md border-b border-white/10 z-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
        <div>
          <h2 class="text-lg font-bold text-white">{{ $title ?? 'CetakCetik' }}</h2>
          <p class="text-sm text-white/60">Kelola dokumen bertanda tangan & verifikasi QR dengan mudah</p>
        </div>

        <div class="flex items-center gap-3">
          @auth
            <div class="relative" x-data="{ open:false }">
              <button @click="open = !open"
                      class="flex items-center gap-2 bg-white/10 hover:bg-white/20 transition px-3 py-2 rounded-full focus:outline-none">
                @php($user = Auth::user())
                @if(!empty($user->avatar))
                  <img src="{{ asset('storage/'.$user->avatar) }}"
                       class="w-8 h-8 rounded-full object-cover border border-white/20" alt="avatar">
                @else
                  <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center text-sm font-bold">
                    {{ strtoupper(substr($user->name ?? 'U',0,2)) }}
                  </div>
                @endif
                <span class="hidden sm:inline text-sm font-medium">{{ $user->name }}</span>
                <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>

              <div x-show="open" @click.outside="open=false" x-transition
                   class="absolute right-0 mt-2 w-44 bg-slate-800 border border-white/10 rounded-lg shadow-lg py-2 z-20">
                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm hover:bg-white/10">👤 Profil Saya</a>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-white/10">🚪 Keluar</button>
                </form>
              </div>
            </div>
          @endauth

          @guest
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-sm font-semibold">
              Masuk
            </a>
          @endguest
        </div>
      </div>
    </header>

    <!-- Konten utama: area yang scroll -->
    <main class="flex-1 overflow-y-auto">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        @if(session('ok'))
          <div class="mb-6 rounded-2xl bg-emerald-400/20 border border-emerald-300/40 text-emerald-100 px-4 py-3 backdrop-blur">
            <div class="flex items-center gap-2 font-semibold">✨ {{ session('ok') }}</div>
          </div>
        @endif

        @yield('content')
      </div>
    </main>
  </div>

</body>
</html>
