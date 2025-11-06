<?php
session_start();
include 'partials/header.php'; // Header + meta + fonts + bootstrap
include '../config/connection.php';

// Ambil semua paket dari database
$q = mysqli_query($conn, "SELECT * FROM paket ORDER BY created_at DESC");
?>

<body class="index-page">

<?php include 'partials/navbar.php'; ?>

<main class="main">

  <!-- Hero Section -->
  <section id="hero" class="hero section dark-background">
    <div class="container py-5">
      <div class="row gy-5 align-items-center">
        <div class="col-lg-6 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
          <img src="../storages/gambar1-removebg-preview.png" class="img-fluid mx-auto d-block" alt="Haji Umroh Travel" style="max-height: 500px;">
        </div>
        <div class="col-lg-6" data-aos="fade-in">
          <h1 class="display-3 fw-bold mb-4">Perjalanan Suci Bersama Kami</h1>
          <p class="lead mb-4 fs-5">Kami melayani paket Haji & Umroh terpercaya dengan fasilitas terbaik dan pembimbing berpengalaman.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Paket Perjalanan Section -->
  <section id="paket" class="section py-5">
    <div class="container">
      <h2 class="display-4 fw-bold mb-5 text-center">Paket Perjalanan</h2>
      <div class="row g-4">
        <?php if(mysqli_num_rows($q) > 0): ?>
          <?php while($paket = mysqli_fetch_assoc($q)): ?>
            <div class="col-lg-4 col-md-6">
              <div class="package-card card shadow rounded-4 h-100">
                <div class="package-header card-header text-white text-center py-3">
                  <h5 class="fw-bold mb-1"><?= htmlspecialchars($paket['nama']) ?></h5>
                  <small><?= htmlspecialchars($paket['jenis']) ?></small>
                </div>
                <div class="package-body card-body d-flex flex-column">
                  <p class="mb-1"><strong>Kode:</strong> <?= htmlspecialchars($paket['kode']) ?></p>
                  <p class="mb-1"><strong>Durasi:</strong> <?= $paket['durasi_days'] ?> Hari</p>
                  <p class="mb-3"><strong>Harga:</strong> Rp<?= number_format($paket['harga'], 0, ',', '.') ?></p>
                  <a href="detaileindex1.php?id=<?= $paket['id'] ?>" class="btn btn-primary mt-auto rounded-pill">Lihat Detail</a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="text-center text-muted fs-5">Belum ada paket perjalanan yang tersedia.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

</main>

<?php include 'partials/footer.php'; ?>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>

<?php include 'partials/script.php'; ?>

<!-- CSS Internal -->
<style>
body.index-page {
  font-family: 'Poppins', sans-serif;
  background: #f9f9f9;
  margin: 0;
  padding-top: 90px; /* space for fixed header */
}

/* Hero Section */
.hero {
  min-height: 70vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.hero h1 {
  font-size: clamp(2.5rem, 5vw, 3.5rem);
  color: #f3f3f3ff;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
}

.hero p {
  font-size: 1.1rem;
  color: #f3f3f3ff;
}

/* Paket Perjalanan */
.package-card {
  background: #fff;
  border-radius: 20px;
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.package-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.package-header {
  background: linear-gradient(135deg, #c19a33, #e4c36f);
}

.package-header h5,
.package-header small {
  margin: 0;
  color: #fff;
}

.package-body {
  padding: 20px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.package-body p {
  margin: 5px 0;
  font-size: 14.5px;
  color: #333;
}

/* Tombol Lihat Detail */
.package-body .btn {
  transition: all 0.3s ease;
}

.package-body .btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(193,154,51,0.4);
}

/* Scroll Top */
#scroll-top {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background: #008000;
  color: #fff;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  font-size: 24px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  transition: all 0.3s;
}

#scroll-top:hover {
  background: #006400;
  transform: translateY(-2px);
}
</style>

<!-- Scroll Top JS -->
<script>
const scrollTopBtn = document.getElementById('scroll-top');
window.addEventListener('scroll', () => {
  if(window.scrollY > 200){
    scrollTopBtn.style.display = 'flex';
  } else {
    scrollTopBtn.style.display = 'none';
  }
});
scrollTopBtn.addEventListener('click', (e) => {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
