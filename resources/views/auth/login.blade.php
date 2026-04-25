<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login — QR Genie</title>
  <style>
    :root{
      --bg1:#0b1023; --bg2:#141a36;
      --card:#0f142b99; --stroke:#33415580;
      --text:#e5e7eb; --muted:#9ca3af;
      --primary:#7c3aed; --focus:#a78bfa;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:ui-sans-serif,system-ui,Segoe UI,Roboto,Arial;
      color:var(--text); background:linear-gradient(160deg,var(--bg1),var(--bg2));
      display:grid; place-items:center; overflow:hidden;
    }
    /* background blobs */
    .blob{position:fixed; inset:-20% -20% auto auto; width:60vmax; height:60vmax;
      filter:blur(60px); opacity:.25; pointer-events:none; mix-blend:screen;
      animation:float 16s ease-in-out infinite alternate}
    .blob.two{left:-15%; top:60%; background:radial-gradient(circle at 30% 30%, #22c55e 0%, transparent 60%); animation-delay:4s}
    .blob.one{right:-15%; top:-10%; background:radial-gradient(circle at 60% 40%, #8b5cf6 0%, transparent 55%)}
    @keyframes float{to{transform:translateY(-30px) translateX(20px) scale(1.05)}}

    .card{
      backdrop-filter:saturate(140%) blur(14px);
      background:linear-gradient(180deg, #0b102380, #0b1023cc);
      border:1px solid var(--stroke);
      border-radius:20px; padding:32px 28px; width:100%; max-width:420px;
      box-shadow:0 20px 60px #0007;
    }

    /* brand header */
    .brand{display:flex; flex-direction:column; align-items:center; gap:8px; margin-bottom:18px}
    .logo-img{width:90px; height:90px; object-fit:contain}
    h1{font-size:28px; margin:10px 0 2px}
    .sub{color:var(--muted); margin:0 0 6px; font-size:14px; text-align:center}

    .err{color:#fecaca; background:#7f1d1d33; border:1px solid #7f1d1d66; padding:10px 12px; border-radius:12px; margin-bottom:12px}

    .field{position:relative; margin:20px 0}
    .input{
      width:100%; background:#0b1220; border:1px solid #1f2a44; color:var(--text);
      border-radius:14px; padding:14px 44px 14px 14px; outline:0; transition:.2s border, .2s box-shadow;
    }
    .input:focus{border-color:var(--focus); box-shadow:0 0 0 4px #a78bfa26}
    .label{
      position:absolute; left:14px; top:50%; transform:translateY(-50%);
      color:#8a93a7; pointer-events:none; transition:.18s; background:transparent; padding:0 .25rem;
    }
    .input:focus + .label, .input:not(:placeholder-shown) + .label{
      top:-8px; font-size:12px; color:#c7c9d3; background:linear-gradient(180deg, transparent 45%, #0b1220 46%);
    }

    .toggle-pass{
      position:absolute; right:10px; top:50%; transform:translateY(-50%);
      background:transparent; border:0; color:#cbd5e1; width:34px; height:34px;
      border-radius:8px; cursor:pointer;
    }
    .toggle-pass:hover{background:#ffffff12}

    .row{display:flex; justify-content:space-between; align-items:center; margin:8px 0 18px}
    .remember{display:flex; gap:8px; align-items:center; color:var(--muted); font-size:14px}
    .btn{
      width:100%; padding:14px 16px; border:0; border-radius:14px; cursor:pointer;
      background:linear-gradient(90deg, var(--primary), #3b82f6); color:white; font-weight:700;
      box-shadow:0 10px 20px #7c3aed33; transition:transform .06s ease, box-shadow .2s ease;
    }
    .btn:hover{box-shadow:0 14px 28px #7c3aed40}
    .btn:active{transform:translateY(1px)}

    .muted{color:var(--muted); font-size:13px; text-align:center; margin-top:16px}
    .muted a{color:#93c5fd; text-decoration:none}
    .muted a:hover{text-decoration:underline}
  </style>
</head>
<body>
  <div class="blob one"></div>
  <div class="blob two"></div>

  <form class="card" method="POST" action="{{ route('login') }}">
    <div class="brand">
      <img src="{{ asset('geni.png') }}" alt="QR Genie Logo" class="logo-img">
      <h1>QrGenie</h1>
      <div class="sub">Generate. Connect.</div>
    </div>

    @csrf
    @error('email') <div class="err">{{ $message }}</div> @enderror

    <div class="field">
      <input id="email" class="input" name="email" type="email" value="{{ old('email') }}" required
             placeholder=" " autocomplete="username" autofocus>
      <label class="label" for="email">Email</label>
    </div>

    <div class="field">
      <input id="password" class="input" name="password" type="password" required
             placeholder=" " autocomplete="current-password">
      <label class="label" for="password">Password</label>
      <button type="button" class="toggle-pass" onclick="togglePass()" aria-label="Lihat Password">
        <!-- icon mata -->
        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" width="20" height="20">
          <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"/>
          <circle cx="12" cy="12" r="3"/>
        </svg>
      </button>
    </div>

    <div class="row">
      <label class="remember">
        <input id="remember" name="remember" type="checkbox" style="width:16px;height:16px;accent-color:#7c3aed">
        Ingat saya
      </label>
      <a href="{{ url('/forgot-password') }}" style="color:#c7d2fe; font-size:14px; text-decoration:none">Lupa password?</a>
    </div>

    <!-- Button Login -->
    <button class="btn" type="submit">Masuk ke Dashboard</button>

    <div class="muted">
  Belum punya akun?
  <a href="{{ route('register') }}">Daftar di sini</a>
</div>

    
  </form>

  <script>
    function togglePass(){
      const input = document.getElementById("password");
      const icon = document.getElementById("eyeIcon");
      if(input.type === "password"){
        input.type = "text";
        icon.innerHTML = '<path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"/><circle cx="12" cy="12" r="3" fill="currentColor"/>';
      }else{
        input.type = "password";
        icon.innerHTML = '<path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"/><circle cx="12" cy="12" r="3"/>';
      }
    }
  </script>
</body>
</html>
