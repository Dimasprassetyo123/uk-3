<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'partials/header.php';
include '../config/connection.php';

// Pastikan parameter id ada
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header("Location: index.php");
  exit;
}

$id = intval($_GET['id']);

// Gunakan prepared statement agar lebih aman
$stmt = $conn->prepare("SELECT * FROM paket WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die("<div style='padding:40px;text-align:center;color:red;'>⚠️ Data tidak ditemukan untuk ID $id</div>");
}

$paket = $result->fetch_assoc();
?>

<body class="detail-page">
  <?php include 'partials/navbar.php'; ?>

  <main class="main py-5">
    <div class="container py-5">
      <div class="row align-items-center g-5">

        <!-- Gambar Paket -->
        <div class="col-lg-6" data-aos="fade-right">
          <div class="detail-image shadow rounded-4 overflow-hidden">
            <img 
              src="../storages/gambar1-removebg-preview.png" 
              alt="<?= htmlspecialchars($paket['nama'] ?? 'Paket') ?>" 
              class="img-fluid w-100">
          </div>
        </div>

        <!-- Detail Paket -->
        <div class="col-lg-6" data-aos="fade-left">
          <div class="detail-card card shadow rounded-4 border-0 p-4">
            <div class="card-body">
              <h1 class="fw-bold text-gold mb-3">
                <?= htmlspecialchars($paket['nama']) ?>
              </h1>

              <p class="text-muted mb-4">
                <?= htmlspecialchars(ucfirst($paket['jenis'] ?? 'Tidak diketahui')) ?>
              </p>

              <ul class="list-unstyled mb-4">
                <li><strong>Kode Paket:</strong> <?= htmlspecialchars($paket['kode']) ?></li>
                <li><strong>Durasi:</strong> <?= (int)$paket['durasi_days'] ?> Hari</li>
                <li><strong>Harga:</strong> 
                  <span class="text-gold fw-bold">
                    Rp<?= number_format($paket['harga'], 0, ',', '.') ?>
                  </span>
                </li>
                <li><strong>Deskripsi:</strong><br> 
                  <?= nl2br(htmlspecialchars($paket['deskripsi'] ?: 'Belum ada deskripsi.')) ?>
                </li>
              </ul>

              <div class="d-flex gap-3">
                <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4">
                  <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <a href="pembelian.php?id=<?= $paket['id'] ?>" class="btn btn-buy rounded-pill px-4">
                  <i class="bi bi-cart"></i> Beli Sekarang
                </a>
              </div>
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
    padding-top: 90px;
  }

  .text-gold {
    background: linear-gradient(90deg, #c19a33, #e4c36f);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .detail-image img {
    object-fit: cover;
    border-radius: 20px;
    transition: transform 0.4s ease;
  }

  .detail-image img:hover {
    transform: scale(1.03);
  }

  .detail-card {
    background: #fff;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    border-radius: 20px;
  }

  .btn-buy {
    background: linear-gradient(90deg, #c19a33, #e4c36f);
    color: #fff;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(193,154,51,0.3);
  }

  .btn-buy:hover {
    background: linear-gradient(90deg, #e4c36f, #c19a33);
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(193,154,51,0.4);
  }

  .btn-outline-secondary {
    border: 2px solid #ccc;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .btn-outline-secondary:hover {
    background-color: #f0f0f0;
    transform: translateY(-2px);
  }
  </style>
</body>
</html>
