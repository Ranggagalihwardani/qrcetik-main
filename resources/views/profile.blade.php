@extends('layout')

@section('content')
  <section class="max-w-3xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Profil Saya</h1>

    @if(session('ok'))
      <div class="mb-4 p-3 rounded-lg bg-emerald-500/20 border border-emerald-400/50 text-emerald-100">
        {{ session('ok') }}
      </div>
    @endif

    <div class="bg-white/5 border border-white/10 rounded-xl p-6 space-y-6">
      <div class="flex items-center gap-4">
        @if(Auth::user()->avatar)
          <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-20 h-20 rounded-full object-cover border-2 border-indigo-500">
        @else
          <div class="w-20 h-20 rounded-full bg-indigo-600 flex items-center justify-center text-2xl font-bold text-white">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
          </div>
        @endif

        <div>
          <h2 class="text-xl font-semibold">{{ Auth::user()->name }}</h2>
          <p class="text-white/60">{{ Auth::user()->email }}</p>
        </div>
      </div>

      <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
          <label class="block text-sm mb-1">Ganti Foto Profil</label>
          <input type="file" name="avatar" accept="image/*" class="block w-full text-sm text-white border border-white/20 rounded-lg cursor-pointer bg-white/10 focus:outline-none">
          @error('avatar')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <button type="submit" class="px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 font-semibold">
          Simpan Foto
        </button>
      </form>
    </div>
  </section>
@endsection
