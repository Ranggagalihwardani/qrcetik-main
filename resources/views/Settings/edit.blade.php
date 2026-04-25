@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white/10 backdrop-blur p-6 rounded-2xl shadow">
  <h1 class="text-xl font-bold mb-6">Pengaturan Aplikasi</h1>

  @if(session('ok'))
    <div class="mb-4 rounded bg-emerald-500/20 text-emerald-200 px-4 py-2">
      {{ session('ok') }}
    </div>
  @endif

  <form method="POST" action="{{ route('settings.update') }}" class="space-y-5">
    @csrf

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="block font-semibold mb-1">Nama Aplikasi</label>
        <input type="text" name="site_name" value="{{ $settings['site_name'] }}"
               class="w-full px-3 py-2 rounded bg-white/10 border border-white/20 text-white">
        @error('site_name')<div class="text-red-200 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="block font-semibold mb-1">Tagline</label>
        <input type="text" name="tagline" value="{{ $settings['tagline'] }}"
               class="w-full px-3 py-2 rounded bg-white/10 border border-white/20 text-white">
        @error('tagline')<div class="text-red-200 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      <div class="sm:col-span-2">
        <label class="block font-semibold mb-1">Footer</label>
        <input type="text" name="footer_text" value="{{ $settings['footer_text'] }}"
               class="w-full px-3 py-2 rounded bg-white/10 border border-white/20 text-white">
        @error('footer_text')<div class="text-red-200 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="block font-semibold mb-1">Email Kontak</label>
        <input type="email" name="contact_email" value="{{ $settings['contact_email'] }}"
               class="w-full px-3 py-2 rounded bg-white/10 border border-white/20 text-white">
        @error('contact_email')<div class="text-red-200 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="block font-semibold mb-1">Nama Perusahaan</label>
        <input type="text" name="company_name" value="{{ $settings['company_name'] }}"
               class="w-full px-3 py-2 rounded bg-white/10 border border-white/20 text-white">
        @error('company_name')<div class="text-red-200 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      <div class="sm:col-span-2">
        <label class="block font-semibold mb-1">Alamat Perusahaan</label>
        <textarea name="company_addr" rows="3"
                  class="w-full px-3 py-2 rounded bg-white/10 border border-white/20 text-white">{{ $settings['company_addr'] }}</textarea>
        @error('company_addr')<div class="text-red-200 text-sm mt-1">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="pt-2">
      <button type="submit"
              class="px-4 py-2 rounded bg-indigo-500 hover:bg-indigo-600 font-semibold text-white">
        Simpan
      </button>
    </div>
  </form>
</div>
@endsection
