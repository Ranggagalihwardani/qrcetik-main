<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    *{box-sizing:border-box}
    body{font-family:system-ui,Segoe UI,Roboto,Arial;background:#0f172a;color:#e2e8f0;margin:0}
    header{display:flex;justify-content:space-between;align-items:center;padding:16px 24px;border-bottom:1px solid #23304a}
    .wrap{max-width:960px;margin:24px auto;padding:0 16px}
    .btn{background:#22c55e;color:#052e1a;padding:10px 14px;border-radius:10px;border:0;font-weight:700;cursor:pointer}
    a{color:#93c5fd;text-decoration:none}
    .muted{color:#9ca3af}
    .grid-3{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:16px}
    .grid-chart{display:grid;grid-template-columns:2fr 1fr;gap:12px;margin-bottom:12px}
    .card{background:#111827;border:1px solid #23304a;border-radius:14px;padding:16px}
    .stat-label{color:#9ca3af;font-size:12px;margin-bottom:6px}
    .stat-num{font-size:28px;font-weight:800}
    .stat-sub{font-size:11px;color:#22c55e;margin-top:4px}
    .card-title{font-size:13px;font-weight:600;color:#cbd5e1;margin-bottom:14px}
    .legend{display:flex;align-items:center;gap:8px;font-size:12px;color:#9ca3af;margin-top:6px}
    .dot{width:10px;height:10px;border-radius:2px;display:inline-block}
    .quick-links{list-style:none;padding:0;display:flex;gap:12px;flex-wrap:wrap}
    .quick-links li a{font-size:13px}
    @media(max-width:640px){.grid-chart{grid-template-columns:1fr}}
  </style>
</head>

<body>

@php
  $stats = $stats ?? [
    'total_users' => 0,
    'admin_users' => 0,
    'regular_users' => 0,
    'new_this_month' => 0,
    'monthly_labels' => [],
    'monthly_registrations' => []
  ];
@endphp

<header>
  <strong>Admin Dashboard</strong>
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn" type="submit">Logout</button>
  </form>
</header>

<div class="wrap">

  <p class="muted">
    Halo, {{ auth()->user()->name ?? 'Guest' }} 
    (role: {{ auth()->user()->role ?? '-' }})
  </p>

  <div class="grid-3">

    <div class="card">
      <div class="stat-label">Total Users</div>
      <div class="stat-num">{{ $stats['total_users'] }}</div>
      <div class="stat-sub">+{{ $stats['new_this_month'] ?? 0 }} bulan ini</div>
    </div>

    <div class="card">
      <div class="stat-label">Admin</div>
      <div class="stat-num">{{ $stats['admin_users'] }}</div>
      <div class="stat-sub" style="color:#9ca3af">dari total user</div>
    </div>

    <div class="card">
      <div class="stat-label">User Biasa</div>
      <div class="stat-num">{{ $stats['regular_users'] }}</div>
      <div class="stat-sub">aktif minggu ini</div>
    </div>

  </div>

  <div class="grid-chart">

    <div class="card">
      <div class="card-title">Pendaftaran User — 6 Bulan Terakhir</div>
      <canvas id="lineChart" height="120"></canvas>
    </div>

    <div class="card">
      <div class="card-title">Komposisi Role</div>
      <canvas id="donutChart" height="120"></canvas>

      <div class="legend" style="margin-top:12px">
        <span class="dot" style="background:#22c55e"></span>
        User Biasa — {{ $stats['regular_users'] }}
      </div>

      <div class="legend">
        <span class="dot" style="background:#3b82f6"></span>
        Admin — {{ $stats['admin_users'] }}
      </div>
    </div>

  </div>

  <!-- 🔥 MENU CEPAT (SUDAH DIPERBAIKI) -->
  <div class="card">
    <div class="card-title">Menu Cepat</div>
    <ul class="quick-links">
      <li><a href="{{ url('/documents') }}">Kelola Dokumen</a></li>
      <li><a href="{{ route('admin.users') }}">Manajemen User</a></li>
    </ul>
  </div>

</div>

<!-- SAFE JSON DATA -->
<script id="stats-data" type="application/json">
  @json($stats)
</script>

<script>
const stats = JSON.parse(document.getElementById('stats-data').textContent);

const monthLabels = stats.monthly_labels || [];
const monthData   = stats.monthly_registrations || [];

new Chart(document.getElementById('lineChart'), {
  type: 'line',
  data: {
    labels: monthLabels,
    datasets: [{
      data: monthData,
      borderColor: '#22c55e',
      backgroundColor: 'rgba(34,197,94,0.08)',
      tension: 0.4,
      fill: true,
      pointBackgroundColor: '#22c55e',
      pointRadius: 4,
      borderWidth: 2
    }]
  },
  options: {
    plugins: { legend: { display: false } },
    responsive: true
  }
});

new Chart(document.getElementById('donutChart'), {
  type: 'doughnut',
  data: {
    labels: ['User Biasa', 'Admin'],
    datasets: [{
      data: [stats.regular_users || 0, stats.admin_users || 0],
      backgroundColor: ['#22c55e', '#3b82f6'],
      borderWidth: 0,
      hoverOffset: 4
    }]
  },
  options: {
    responsive: true,
    cutout: '68%',
    plugins: { legend: { display: false } }
  }
});
</script>

</body>
</html>