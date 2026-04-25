@extends('layout')
@section('content')
  <div class="overflow-hidden rounded-2xl bg-white/10 border border-white/20 backdrop-blur-xl shadow-lg p-6">
    <h2 class="text-xl font-bold mb-6">Edit Dokumen</h2>

    <form id="docForm" method="post" action="{{ route('documents.update', $doc) }}" class="space-y-6">
      @csrf
      @method('PUT')

      {{-- Judul --}}
      <div>
        <label class="block text-sm font-semibold mb-2">Judul</label>
        <input type="text" name="title" required
               class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 placeholder:text-white/60 text-white focus:outline-none focus:ring-2 focus:ring-white/40"
               value="{{ old('title', $doc->title) }}">
        @error('title') <p class="text-red-300 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Isi dokumen --}}
      <div>
        <div class="flex items-center justify-between mb-2">
          <label class="block text-sm font-semibold">Isi Dokumen</label>
          <button type="button" id="btnInsertQr" class="text-xs underline opacity-80 hover:opacity-100">
            Sisipkan placeholder QR
          </button>
        </div>
        <textarea id="editor" name="html_template">{{ old('html_template', $default ?? $doc->html_template) }}</textarea>
        @error('html_template') <p class="text-red-300 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Payload (opsional) --}}
      <div>
        <label class="block text-sm font-semibold mb-2">Payload (opsional)</label>
        <textarea name="payload" rows="4"
          class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 placeholder:text-white/60 text-white focus:outline-none focus:ring-2 focus:ring-white/40">{{ old('payload', $doc->payload) }}</textarea>
        @error('payload') <p class="text-red-300 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Tombol --}}
      <div class="flex justify-end">
        <button type="submit"
                class="px-5 py-2.5 rounded-lg bg-gradient-to-tr from-indigo-500 to-violet-500 border border-white/20 hover:opacity-90 font-semibold shadow">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>

  {{-- TinyMCE --}}
  <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#editor',
      height: 500,
      menubar: 'file edit view insert format table tools help',
      plugins: 'lists table link pagebreak charmap image hr wordcount code paste',
      toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | table link pagebreak | code',

      paste_data_images: true,
      paste_as_text: false,
      paste_webkit_styles: "all",
      paste_retain_style_properties: "all",

      valid_elements: '*[*]',
      extended_valid_elements: '*[*]',
      content_style: '',
      branding: false,

      setup(editor) {
        document.getElementById('btnInsertQr')?.addEventListener('click', () => {
          editor.insertContent('<div id="blok-qr"></div>');
        });
      }
    });

    document.getElementById('docForm').addEventListener('submit', function() {
      tinymce.triggerSave();
    });
  </script>
@endsection
