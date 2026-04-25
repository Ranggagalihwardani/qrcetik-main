<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>User Management</title>
<style>
body{font-family:system-ui;background:#0f172a;color:#e2e8f0;margin:0}
.wrap{max-width:1000px;margin:30px auto;padding:0 16px}
.card{background:#111827;border:1px solid #23304a;border-radius:12px;padding:16px}
table{width:100%;border-collapse:collapse;margin-top:10px}
th,td{padding:10px;border-bottom:1px solid #23304a;text-align:left}
.btn{padding:6px 10px;border-radius:8px;border:0;cursor:pointer}
.btn-save{background:#22c55e;color:#052e1a}
.btn-del{background:#ef4444;color:white}
input,select{padding:6px;border-radius:6px;border:1px solid #334155;background:#0b1220;color:white}
</style>
</head>
<body>

<div class="wrap">

<h2>User Management</h2>

<!-- SEARCH -->
<form method="GET">
  <input type="text" name="q" value="{{ $q }}" placeholder="Cari user...">
  <button class="btn">Search</button>
</form>

@if(session('success'))
  <p style="color:#22c55e">{{ session('success') }}</p>
@endif

@if($errors->any())
  <p style="color:#ef4444">{{ $errors->first() }}</p>
@endif

<div class="card">

<table>
<thead>
<tr>
<th>Nama</th>
<th>Email</th>
<th>Role</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
@foreach($users as $user)
<tr>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>

<td>
<form method="POST" action="{{ route('admin.users.role',$user) }}">
@csrf
<select name="role">
  <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
  <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
</select>
<button class="btn btn-save">Save</button>
</form>
</td>

<td>
<form method="POST" action="{{ route('admin.users.delete',$user) }}">
@csrf
@method('DELETE')
<button class="btn btn-del" onclick="return confirm('Hapus user?')">Hapus</button>
</form>
</td>

</tr>
@endforeach
</tbody>

</table>

<br>
{{ $users->links() }}

</div>

</div>

</body>
</html>