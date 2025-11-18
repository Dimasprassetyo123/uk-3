<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'partials/header.php';
include '../config/connection.php';

// pastikan login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ambil data registrasi jamaah (paket + pembayaran + jadwal)
$q = mysqli_query($conn, "
  SELECT r.*, p.nama AS paket_nama, p.harga, 
         k.departure_date, k.return_date,
         j.nama AS jamaah_nama, j.nik,
         pay.status AS payment_status
  FROM registrations r
  LEFT JOIN paket p ON r.paket_id = p.id
  LEFT JOIN jamaah j ON r.jamaah_id = j.id
  LEFT JOIN keberangkatan k ON p.id = k.paket_id
  LEFT JOIN payments pay ON pay.registration_id = r.id
  WHERE j.user_id = '$user_id'
  ORDER BY r.id DESC
");

?>

<body class="pemberangkatan-page">

<?php include 'partials/navbar.php'; ?>

<main class="main">
<div class="container mt-5 mb-5">
    <h2 class="fw-bold text-center text-gold mb-4">Status Pemberangkatan Jamaah</h2>

    <?php if (mysqli_num_rows($q) == 0): ?>
        <div class="alert alert-warning text-center">Belum ada pemberangkatan.</div>
    <?php else: ?>

    <?php while ($row = mysqli_fetch_assoc($q)): ?>

    <div class="card shadow-lg border-0 p-4 mb-4 pemberangkatan-card">

        <!-- Header -->
        <h4 class="mb-1 text-gold"><?= $row['jamaah_nama'] ?></h4>
        <p class="text-muted mb-3">NIK: <?= $row['nik'] ?></p>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="info-line"><strong>Paket:</strong> <?= $row['paket_nama'] ?></div>
                <div class="info-line"><strong>Harga:</strong> Rp<?= number_format($row['harga'], 0, ',', '.') ?></div>
            </div>

            <div class="col-md-6">
                <div class="info-line"><strong>Keberangkatan:</strong> 
                  <?= $row['departure_date'] ? date('d M Y', strtotime($row['departure_date'])) : '-' ?>
                </div>

                <div class="info-line"><strong>Kepulangan:</strong> 
                  <?= $row['return_date'] ? date('d M Y', strtotime($row['return_date'])) : '-' ?>
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="status-box">
            <span>Status Pembayaran:</span>
            <strong class="status <?= $row['payment_status'] ?>">
                <?= ucfirst($row['payment_status']) ?>
            </strong>
        </div>

        <!-- Progress Stepper -->
        <div class="progress-container mt-4">
            <?php
                // Tentukan stage berdasarkan status
                $stage = 1; // default

                if ($row['payment_status'] == "pending") $stage = 1;
                if ($row['payment_status'] == "success") $stage = 2;
                if ($row['departure_date'] && strtotime($row['departure_date']) <= time()) $stage = 3;
                if ($row['return_date'] && strtotime($row['return_date']) <= time()) $stage = 4;
            ?>

            <div class="step <?= $stage >= 1 ? 'active' : '' ?>">Pendaftaran</div>
            <div class="step <?= $stage >= 2 ? 'active' : '' ?>">Verifikasi Pembayaran</div>
            <div class="step <?= $stage >= 3 ? 'active' : '' ?>">Berangkat</div>
            <div class="step <?= $stage >= 4 ? 'active' : '' ?>">Selesai</div>
        </div>

    </div>

    <?php endwhile; ?>
    <?php endif; ?>

</div>
</main>

<style>
body.pemberangkatan-page {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
    padding-top: 100px;
}

.text-gold {
    background: linear-gradient(90deg,#c19a33,#e4c36f);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.pemberangkatan-card {
    border-radius: 20px;
    background: #fff;
}

.info-line {
    margin-bottom: 6px;
    font-size: 15px;
}

.status-box {
    background: #fdf5e6;
    padding: 12px 15px;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.status {
    font-weight: bold;
    padding: 4px 10px;
    border-radius: 6px;
}

.status.pending { color: #b36b00; }
.status.success { color: green; }
.status.failed { color: red; }

.progress-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.step {
    width: 23%;
    padding: 12px;
    text-align: center;
    border-radius: 10px;
    background: #eee;
    font-size: 14px;
    font-weight: 600;
}

.step.active {
    background: linear-gradient(90deg,#c19a33,#e4c36f);
    color: white;
}
</style>

</body>
</html>
