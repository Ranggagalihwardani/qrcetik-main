<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin.php');
    exit();
}
$host = "localhost";
$user = "root";
$password = "301100";
$db = "cctv_web";
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $youtube = $_POST['youtube'];

    if (strpos($youtube, 'youtu.be/') !== false) {
        $video_id = explode('youtu.be/', $youtube)[1];
        $youtube = "https://www.youtube.com/embed/" . $video_id;
    }
    if (strpos($youtube, 'watch?v=') !== false) {
        $video_id = explode('watch?v=', $youtube)[1];
        $youtube = "https://www.youtube.com/embed/" . $video_id;
    }

    if ($id > 0) {
        $stmt = $conn->prepare("UPDATE cctvs SET name=?, address=?, youtube=?, lat=?, lng=? WHERE id=?");
        $stmt->bind_param("sssddi", $_POST['name'], $_POST['address'], $youtube, $_POST['lat'], $_POST['lng'], $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO cctvs (name, address, youtube, lat, lng) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdd", $_POST['name'], $_POST['address'], $youtube, $_POST['lat'], $_POST['lng']);
    }
    $stmt->execute();
    header('Location: dashboard.php');
    exit();
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM cctvs WHERE id = $id");
    header('Location: dashboard.php');
    exit();
}

$data = $conn->query("SELECT * FROM cctvs")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <style>#map { height: 300px; }</style>
</head>
<body class="bg-gray-100">
  <div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold">Dashboard Admin</h2>
      <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded">Logout</a>
    </div>

    <form method="POST" id="cameraForm" class="grid grid-cols-1 gap-4 mb-6">
      <input type="hidden" name="id" id="camera-id" />
      <input name="name" id="camera-name" placeholder="Nama Lokasi" class="border p-2 rounded" required>
      <input name="address" id="camera-address" placeholder="Alamat" class="border p-2 rounded" required>
      <input name="youtube" id="camera-youtube" placeholder="Link YouTube" class="border p-2 rounded" required>
      <input type="number" step="any" name="lat" id="camera-lat" placeholder="Latitude" class="border p-2 rounded" required>
      <input type="number" step="any" name="lng" id="camera-lng" placeholder="Longitude" class="border p-2 rounded" required>
      <button type="submit" class="bg-blue-600 text-white py-2 rounded">Simpan Kamera</button>
    </form>

    <h3 class="text-xl font-semibold mb-3">Pilih Lokasi pada Peta</h3>
    <div id="map" class="w-full rounded border mb-6"></div>

    <h3 class="text-xl font-semibold mb-4">Daftar Kamera CCTV</h3>
    <div class="overflow-x-auto">
      <table id="cctvTable" class="display w-full">
        <thead>
          <tr>
            <th>Lokasi</th>
            <th>Alamat</th>
            <th>Video</th>
            <th>Koordinat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $cctv): ?>
          <tr data-id="<?= $cctv['id'] ?>"
              data-name="<?= htmlspecialchars($cctv['name']) ?>"
              data-address="<?= htmlspecialchars($cctv['address']) ?>"
              data-youtube="<?= htmlspecialchars($cctv['youtube']) ?>"
              data-lat="<?= $cctv['lat'] ?>"
              data-lng="<?= $cctv['lng'] ?>">
            <td><?= htmlspecialchars($cctv['name']) ?></td>
            <td><?= htmlspecialchars($cctv['address']) ?></td>
            <td><iframe width="200" height="150" src="<?= htmlspecialchars($cctv['youtube']) ?>" allowfullscreen></iframe></td>
            <td><?= $cctv['lat'] ?>, <?= $cctv['lng'] ?></td>
            <td>
              <button class="edit-btn text-blue-600">Edit</button> |
              <a href="?delete=<?= $cctv['id'] ?>" class="text-red-600">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- JS Libraries -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

  <script>
    $(document).ready(function () {
      $('#cctvTable').DataTable();

      $('.edit-btn').click(function () {
        const row = $(this).closest('tr');
        $('#camera-id').val(row.data('id'));
        $('#camera-name').val(row.data('name'));
        $('#camera-address').val(row.data('address'));
        $('#camera-youtube').val(row.data('youtube'));
        $('#camera-lat').val(row.data('lat'));
        $('#camera-lng').val(row.data('lng'));
        formMarker.setLatLng([row.data('lat'), row.data('lng')]);
        map.setView([row.data('lat'), row.data('lng')], 15);
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });

      const map = L.map('map').setView([-7.556, 110.825], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
      }).addTo(map);

      // Marker untuk form input
      let formMarker = L.marker([-7.556, 110.825], {draggable: true}).addTo(map);
      formMarker.on('dragend', function (e) {
        const {lat, lng} = e.target.getLatLng();
        $('#camera-lat').val(lat.toFixed(6));
        $('#camera-lng').val(lng.toFixed(6));
      });

      map.on('click', function (e) {
        formMarker.setLatLng(e.latlng);
        $('#camera-lat').val(e.latlng.lat.toFixed(6));
        $('#camera-lng').val(e.latlng.lng.toFixed(6));
      });

      // Geocoder (pencarian lokasi)
      L.Control.geocoder({
        defaultMarkGeocode: false
      }).on('markgeocode', function(e) {
        const latlng = e.geocode.center;
        formMarker.setLatLng(latlng).addTo(map);
        map.setView(latlng, 16);
        $('#camera-lat').val(latlng.lat.toFixed(6));
        $('#camera-lng').val(latlng.lng.toFixed(6));
      }).addTo(map);

      // Marker semua kamera
      <?php foreach ($data as $cctv): ?>
        L.marker([<?= $cctv['lat'] ?>, <?= $cctv['lng'] ?>])
          .addTo(map)
          .bindPopup(`<strong><?= htmlspecialchars($cctv['name']) ?></strong><br><?= htmlspecialchars($cctv['address']) ?>`);
      <?php endforeach; ?>
    });
  </script>
</body>
</html>

