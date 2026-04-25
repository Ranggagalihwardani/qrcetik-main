<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Register — QR Genie</title>

  <style>
    :root{
      --bg1:#0b1023; --bg2:#141a36;
      --card:#0f142b99; --stroke:#33415580;
      --text:#e5e7eb; --muted:#9ca3af;
      --primary:#7c3aed; --focus:#a78bfa;
    }

    body{
      margin:0;
      font-family:ui-sans-serif,system-ui,Segoe UI,Roboto,Arial;
      color:var(--text);
      background:linear-gradient(160deg,var(--bg1),var(--bg2));
      display:grid;
      place-items:center;
      height:100vh;
    }

    .card{
      background:#0b1023cc;
      padding:30px;
      border-radius:20px;
      width:100%;
      max-width:420px;
      border:1px solid var(--stroke);
    }

    .field{margin:15px 0;}

    input{
      width:100%;
      padding:12px;
      border-radius:10px;
      border:1px solid #1f2a44;
      background:#0b1220;
      color:white;
    }

    button{
      width:100%;
      padding:14px;
      border:none;
      border-radius:12px;
      background:linear-gradient(90deg,#7c3aed,#3b82f6);
      color:white;
      font-weight:bold;
      cursor:pointer;
    }

    .muted{
      text-align:center;
      margin-top:15px;
      color:#9ca3af;
    }

    a{color:#93c5fd;}

    /* TAMBAHAN STYLE ERROR */
    .error-box{
      background:#7f1d1d33;
      border:1px solid #7f1d1d66;
      color:#fecaca;
      padding:10px;
      border-radius:10px;
      margin-bottom:15px;
      font-size:14px;
    }
  </style>
</head>

<body>

<form class="card" method="POST" action="{{ route('register') }}">
  @csrf

  <h2>Daftar Akun</h2>

  <!-- 🔥 TAMBAHAN ERROR DISPLAY -->
  @if ($errors->any())
    <div class="error-box">
      @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
    </div>
  @endif

  <div class="field">
    <input type="text" name="name" placeholder="Nama" required>
  </div>

  <div class="field">
    <input type="email" name="email" placeholder="Email" required>
  </div>

  <div class="field">
    <input type="password" name="password" placeholder="Password" required>
  </div>

  <div class="field">
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
  </div>

  <button type="submit">Daftar</button>

  <div class="muted">
    Sudah punya akun?
    <a href="{{ route('login') }}">Login</a>
  </div>

</form>

</body>
</html>