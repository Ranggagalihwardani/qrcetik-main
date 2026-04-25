<!doctype html>
<html>
<head>
    <title>Login Admin</title>
    <style>
        body {
            font-family: Arial;
            background: #0f172a;
            color: white;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }
        .box {
            background:#111827;
            padding:30px;
            border-radius:12px;
            width:300px;
        }
        input {
            width:100%;
            padding:10px;
            margin:10px 0;
            border-radius:8px;
            border:none;
        }
        button {
            width:100%;
            padding:10px;
            background:#22c55e;
            border:none;
            border-radius:8px;
            font-weight:bold;
        }
        .error {
            color:red;
            margin-bottom:10px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Login Admin</h2>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ url('/admin/login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>