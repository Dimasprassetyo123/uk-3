<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'partials/header.php';
include '../config/connection.php';

// Pastikan ada parameter id
if (!isset($_GET['id'])) {
  header("Location: index1.php");
  exit;
}

$id = intval($_GET['id']);

// Ambil data paket + jadwal keberangkatan
$q = mysqli_query($conn, "
  SELECT p.*, k.departure_date, k.return_date
  FROM paket p
  LEFT JOIN keberangkatan k ON k.paket_id = p.id
  WHERE p.id = $id
  LIMIT 1
");

if (!$q) {
  die("Query gagal: " . mysqli_error($conn));
}

$paket = mysqli_fetch_assoc($q);

if (!$paket) {
  die("Data paket tidak ditemukan.");
}
?>

<body class="detail-page">

  <?php include 'partials/navbar.php'; ?>

  <main class="main">

    <div class="container mt-5 mb-5">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card detail-card shadow-lg border-0 p-4">

            <div class="text-center mb-4">
              <h2 class="fw-bold text-gold"><?= htmlspecialchars($paket['nama']) ?></h2>
              <p class="text-muted mb-0">Kode Paket: <?= htmlspecialchars($paket['kode']) ?></p>
            </div>

            <div class="card-body">

              <!-- JENIS -->
              <div class="info-box">
                <span class="icon">👳‍♀️</span>
                <strong>Jenis:</strong> <?= htmlspecialchars(ucfirst($paket['jenis'])) ?>
              </div>

              <!-- DURASI -->
              <div class="info-box">
                <span class="icon">⏳</span>
                <strong>Durasi:</strong> <?= htmlspecialchars($paket['durasi_days']) ?> Hari
              </div>

              <!-- KEBERANGKATAN -->
              <div class="info-box">
                <span class="icon">✈️</span>
                <strong>Keberangkatan:</strong>
                <?= !empty($paket['departure_date']) ? date('d M Y', strtotime($paket['departure_date'])) : '-' ?>
              </div>

              <!-- KEPULANGAN -->
              <div class="info-box">
                <span class="icon">🏁</span>
                <strong>Kepulangan:</strong>
                <?= !empty($paket['return_date']) ? date('d M Y', strtotime($paket['return_date'])) : '-' ?>
              </div>

              <!-- HARGA -->
              <div class="info-box">
                <span class="icon">💰</span>
                <strong>Harga:</strong> Rp<?= number_format($paket['harga'], 0, ',', '.') ?>
              </div>

              <!-- DESKRIPSI -->
              <div class="mt-4">
                <h5><strong>Deskripsi:</strong></h5>
                <p class="text-muted"><?= nl2br(htmlspecialchars($paket['deskripsi'])) ?></p>
              </div>

            </div>

            <div class="text-center mt-4 d-flex justify-content-center gap-3">
              <a href="index1.php" class="btn btn-outline-secondary px-4 py-2">Kembali</a>
              <a href="belipaket.php?id=<?= $paket['id'] ?>" class="btn btn-warning px-4 py-2">Beli Sekarang</a>
            </div>

          </div>
        </div>
      </div>
    </div>

  </main>

  <?php include 'partials/footer.php'; ?>

  <style>
    body.detail-page {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
      padding-top: 100px;
    }

    .text-gold {
      background: linear-gradient(90deg, #c19a33, #e4c36f);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .detail-card {
      background: #fff;
      border-radius: 20px;
      padding: 30px 40px;
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
    }

    .info-box {
      background: #fdf8ee;
      border-left: 6px solid #e6d398;
      padding: 14px 18px;
      border-radius: 12px;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      font-size: 15px;
    }

    .info-box .icon {
      font-size: 20px;
      margin-right: 10px;
    }

    .btn-outline-secondary {
      border: 2px solid #bbb;
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
      background-color: #f0f0f0;
      transform: translateY(-2px);
    }

    .btn-warning {
      background-color: #c19a33;
      color: #fff;
      border-radius: 10px;
      font-weight: 600;
      border: none;
      transition: 0.3s;
    }

    .btn-warning:hover {
      background-color: #b18829;
      transform: translateY(-2px);
    }
  </style>

</body>
</html>
