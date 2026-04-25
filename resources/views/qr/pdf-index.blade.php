@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto bg-white/10 backdrop-blur p-6 rounded-2xl shadow-lg">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-white">{{ $title ?? 'Daftar Dokumen PDF' }}</h1>
    
  </div>

  @if(session('ok'))
    <div class="mb-4 rounded-lg bg-emerald-400/20 border border-emerald-400/30 text-emerald-100 px-4 py-3">
      {{ session('ok') }}
    </div>
  @endif

  @if($uploads->isEmpty())
    <div class="text-center text-white/70 py-12">Belum ada dokumen yang diupload.</div>
  @else
    <div class="overflow-x-auto">
      <table class="w-full border-collapse rounded-xl overflow-hidden">
        <thead>
          <tr class="bg-white/20 text-white text-left text-sm uppercase tracking-wider">
            <th class="px-4 py-3">UUID</th>
            <th class="px-4 py-3">Judul</th>
            <th class="px-4 py-3">Nama File</th>
            <th class="px-4 py-3">Ukuran</th>
            <th class="px-4 py-3">Tanggal</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white/5 divide-y divide-white/10">
          @foreach($uploads as $u)
            <tr class="hover:bg-white/10 transition">
              <td class="px-4 py-3 font-mono text-xs text-white/80">{{ $u->uuid }}</td>
              <td class="px-4 py-3 text-white">{{ $u->title ?? '—' }}</td>
              <td class="px-4 py-3 text-white/90">{{ $u->original_name }}</td>
              <td class="px-4 py-3 text-white/70">
                @php
                  $kb = $u->size / 1024;
                  $human = $kb > 1024 ? number_format($kb/1024,2).' MB' : number_format($kb,0).' KB';
                @endphp
                {{ $human }}
              </td>
              <td class="px-4 py-3 text-white/70">{{ optional($u->created_at)->format('d M Y H:i') }}</td>
              <td class="px-4 py-3">
                @php
                  $status = strtolower($u->status ?? 'generated');
                  $badge = match($status) {
                    'generated' => 'bg-emerald-500/20 text-emerald-300 border border-emerald-400/30',
                    'draft'     => 'bg-yellow-500/20 text-yellow-300 border border-yellow-400/30',
                    default     => 'bg-slate-500/20 text-slate-300 border border-slate-400/30',
                  };
                @endphp
                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badge }}">
                  {{ ucfirst($status) }}
                </span>
              </td>
              <td class="px-4 py-3">
                <div class="flex gap-2 justify-center">
                  <a href="{{ route('qr.download.pdf', $u->uuid) }}"
                     class="px-3 py-1 rounded-lg bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-semibold">
                     PDF
                  </a>
                  <a href="{{ route('qr.download.qr', $u->uuid) }}"
                     class="px-3 py-1 rounded-lg bg-green-500 hover:bg-green-600 text-white text-xs font-semibold">
                     QR
                  </a>
                  <a href="{{ url('/verify/'.$u->uuid) }}" target="_blank"
                     class="px-3 py-1 rounded-lg bg-white/10 border border-white/20 hover:bg-white/20 text-white text-xs font-semibold">
                     Verifikasi
                  </a>

                  {{-- ===== Tombol Hapus ===== --}}
                  <form action="{{ route('qr.delete', $u->uuid) }}" method="POST"
      onsubmit="return confirm('Yakin hapus dokumen ini? Tindakan tidak dapat dibatalkan.');">
  @csrf
  @method('DELETE')
  <button type="submit"
          class="px-3 py-1 rounded-lg bg-red-500 hover:bg-red-600 text-white text-xs font-semibold">
    Hapus
  </button>
</form>

                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
      {{ $uploads->withQueryString()->links() }}
    </div>
  @endif
</div>
@endsection
