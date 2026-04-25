<div>
  @if(session('ok'))
    <div style="background:#e6ffed;padding:10px;border:1px solid #b7f5c4">{{ session('ok') }}</div>
  @endif
  {{ $slot }}
</div>
