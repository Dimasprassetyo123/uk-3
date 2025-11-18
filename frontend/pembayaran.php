<?php
session_start();
include 'partials/header.php';
include '../config/connection.php';

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil keyword pencarian (nama jamaah)
$keyword = isset($_GET['search']) ? trim($_GET['search']) : '';

// Query ambil data pembayaran user
$sql = "
  SELECT 
    r.id AS registration_id,
    j.nama AS nama_jamaah,
    p.nama AS nama_paket,
    p.harga AS paket_harga,
    pay.method,
    pay.amount,
    pay.status,
    pay.payment_date
  FROM registrations r
  INNER JOIN jamaah j ON j.id = r.jamaah_id
  INNER JOIN paket p ON p.id = r.paket_id
  LEFT JOIN payments pay ON pay.registration_id = r.id
  WHERE j.user_id = '$user_id'
";

if ($keyword !== '') {
    $sql .= " AND j.nama LIKE '%$keyword%'";
}

$sql .= " ORDER BY pay.payment_date DESC";

$q = mysqli_query($conn, $sql);
?>

<body class="pembayaran-page">
<?php include 'partials/navbar.php'; ?>

<main class="main">
  <div class="container mt-5 mb-5">
    <div class="card shadow-lg p-4 border-0">
      <h3 class="text-center text-gold mb-4">Riwayat Pembayaran Anda</h3>

      <!-- 🔍 Form pencarian -->
      <form method="GET" class="mb-4 text-center">
        <div class="input-group" style="max-width:400px; margin:auto;">
          <input type="text" name="search" value="<?= htmlspecialchars($keyword) ?>" class="form-control" placeholder="Cari nama jamaah...">
          <button type="submit" class="btn btn-warning">Cari</button>
        </div>
      </form>

      <?php if (mysqli_num_rows($q) > 0): ?>
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
          <thead class="table-warning">
            <tr>
              <th>No</th>
              <th>Nama Jamaah</th>
              <th>Paket</th>
              <th>Metode</th>
              <th>Tanggal Bayar</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($q)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_jamaah']) ?></td>
                <td><?= htmlspecialchars($row['nama_paket']) ?> (Rp <?= number_format($row['paket_harga'],0,',','.') ?>)</td>
                <td><?= strtoupper(htmlspecialchars($row['method'] ?? '-')) ?></td>

                <td><?= $row['payment_date'] ? date("d-m-Y H:i", strtotime($row['payment_date'])) : '-' ?></td>
                <td>
                  <?php
                    $status = $row['status'] ?? 'pending';
                    if($status == 'confirmed') echo "<span class='badge bg-success'>Dikonfirmasi</span>";
                    elseif($status == 'pending') echo "<span class='badge bg-warning text-dark'>Menunggu</span>";
                    elseif($status == 'rejected') echo "<span class='badge bg-danger'>Ditolak</span>";
                    elseif($status == 'canceled') echo "<span class='badge bg-secondary'>Dibatalkan</span>";
                    else echo "<span class='badge bg-secondary'>Tidak Diketahui</span>";
                  ?>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
      <?php else: ?>
        <div class="alert alert-info text-center">
          Tidak ada data pembayaran ditemukan.
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php include 'partials/footer.php'; ?>

<style>
body.pembayaran-page {
  font-family: 'Poppins', sans-serif;
  background-color: #f9f9f9;
  padding-top: 100px;
}
.text-gold {
  background: linear-gradient(90deg, #c19a33, #e4c36f);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.table th {
  background-color: #f7e6a1;
}
.badge {
  font-size: 0.9em;
  padding: 6px 10px;
  border-radius: 8px;
}
.input-group input {
  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}
.input-group button {
  border-top-right-radius: 30px;
  border-bottom-right-radius: 30px;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
