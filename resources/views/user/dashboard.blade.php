<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard User</title>
  <style>
    body{font-family:system-ui,Segoe UI,Roboto,Arial;background:#0f172a;color:#e2e8f0;margin:0}
    header{display:flex;justify-content:space-between;align-items:center;padding:16px 24px;border-bottom:1px solid #23304a}
    .wrap{max-width:960px;margin:24px auto;padding:0 16px}
    .btn{background:#22c55e;color:#052e1a;padding:10px 14px;border-radius:10px;border:0;font-weight:700;cursor:pointer}
  </style>
</head>
<body>
  <header>
    <strong>Dashboard User</strong>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn" type="submit">Logout</button>
    </form>
  </header>

  <div class="wrap">
    <p>Halo, {{ $user->name }} (role: {{ $user->role }})</p>
    <ul>
      <li><a href="{{ url('/documents') }}">Akses modul Dokumen</a></li>
      {{-- Tambahkan menu khusus user di sini --}}
    </ul>
  </div>
</body>
</html>
