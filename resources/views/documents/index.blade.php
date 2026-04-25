@extends('layout')

@section('content')
  <div class="mb-5 flex items-center justify-between">
    <h2 class="text-white font-semibold text-lg">Daftar Dokumen</h2>

    {{-- Toolbar: Search --}}
    <div class="flex items-center gap-3">
      <form method="GET" action="{{ route('documents.index') }}" class="relative">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari dokumen..."
               class="w-64 px-4 py-2 rounded-lg bg-white/10 border border-white/20 placeholder:text-white/60 focus:outline-none focus:ring-2 focus:ring-white/40">
        <button type="submit" class="sr-only">Cari</button>
        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-white/70">🔍</span>
      </form>
    </div>
  </div>

  {{-- Flash success --}}
  @if(session('success'))
    <div class="mb-4 rounded-lg border border-emerald-300/30 bg-emerald-400/10 px-4 py-3 text-emerald-100">
      {{ session('success') }}
    </div>
  @endif

  <div class="overflow-hidden rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xl shadow-lg">
    <div class="px-5 py-4 border-b border-white/10 flex items-center justify-between text-sm text-white/80">
      <div>
        Menampilkan
        <strong>{{ $documents->firstItem() ?? 0 }}</strong>–<strong>{{ $documents->lastItem() ?? 0 }}</strong>
        dari <strong>{{ $documents->total() }}</strong>
        @if(request('search'))
          <span class="ml-2 text-white/60">• Filter: “{{ request('search') }}”</span>
        @endif
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm">
        <thead class="bg-white/10 text-white/80">
          <tr>
            <th class="px-5 py-3">Judul</th>
            <th class="px-5 py-3">Status</th>
            <th class="px-5 py-3">UUID</th>
            <th class="px-5 py-3 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
          @forelse($documents as $d)
            <tr class="hover:bg-white/5 transition">
              <td class="px-5 py-4 font-medium text-white">{{ $d->title }}</td>
              <td class="px-5 py-4">
                @if($d->status === 'generated')
                  <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-300/30 bg-emerald-400/10 px-2.5 py-1 text-xs font-semibold text-emerald-200">
                    • Generated
                  </span>
                @elseif($d->status === 'draft')
                  <span class="inline-flex items-center gap-1.5 rounded-full border border-yellow-300/30 bg-yellow-400/10 px-2.5 py-1 text-xs font-semibold text-yellow-200">
                    • Draft
                  </span>
                @else
                  <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-300/30 bg-slate-400/10 px-2.5 py-1 text-xs font-semibold text-slate-200">
                    • {{ ucfirst($d->status) }}
                  </span>
                @endif
              </td>
              <td class="px-5 py-4 text-white/70 max-w-xs">
                <div class="flex items-center gap-2">
                  <span class="truncate block font-mono" title="{{ $d->uuid }}">{{ $d->uuid }}</span>
                  <button type="button"
                          onclick="navigator.clipboard.writeText('{{ $d->uuid }}'); alert('UUID disalin!')"
                          class="px-2 py-1 rounded-md bg-white/10 border border-white/20 text-white/70 hover:bg-white/20">
                    Salin
                  </button>
                </div>
              </td>
              <td class="px-5 py-4 text-right">
                <div class="flex gap-2 justify-end">
                  {{-- Lihat --}}
                  <a href="{{ route('documents.show', $d) }}"
                     class="px-3 py-1.5 rounded-lg bg-indigo-500/20 border border-indigo-300/30 hover:bg-indigo-500/30 text-indigo-100">
                    Lihat
                  </a>

                  {{-- Edit --}}
                  <a href="{{ route('documents.edit', $d) }}"
                     class="px-3 py-1.5 rounded-lg bg-yellow-500/20 border border-yellow-300/30 hover:bg-yellow-500/30 text-yellow-100">
                    Edit
                  </a>

                  {{-- Hapus --}}
                  <form action="{{ route('documents.destroy', $d) }}" method="POST"
                        onsubmit="return confirm('Yakin mau hapus dokumen ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-3 py-1.5 rounded-lg bg-red-500/20 border border-red-300/30 hover:bg-red-500/30 text-red-100">
                      Hapus
                    </button>
                  </form>

                  {{-- Render --}}
                  <form action="{{ route('documents.render', $d) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="px-3 py-1.5 rounded-lg bg-fuchsia-500/20 border border-fuchsia-300/40 hover:bg-fuchsia-500/30 text-fuchsia-100">
                      Render
                    </button>
                  </form>

                  {{-- (Opsional) Download PDF --}}
                  @if($d->status === 'generated')
                    <a href="{{ route('documents.download', $d) }}"
                       class="px-3 py-1.5 rounded-lg bg-emerald-500/20 border border-emerald-300/40 hover:bg-emerald-500/30 text-emerald-100">
                      Download
                    </a>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-5 py-10 text-center text-white/70">
                @if(request('search'))
                  Tidak ada dokumen yang cocok untuk kata kunci
                  <span class="font-semibold text-white">“{{ request('search') }}”</span>.
                  <a href="{{ route('documents.index') }}" class="underline hover:no-underline">Reset filter</a>
                  atau <a class="underline hover:no-underline" href="{{ route('documents.create') }}">Buat sekarang</a>.
                @else
                  Tidak ada dokumen. <a class="underline hover:no-underline" href="{{ route('documents.create') }}">Buat sekarang</a>.
                @endif
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="px-5 py-4 border-t border-white/10">
      {{-- Pastikan controller pakai ->withQueryString() agar search ikut ke pagination --}}
      {{ $documents->links() }}
    </div>
  </div>
@endsection
