<?php
session_start();
include 'partials/header.php';
include '../config/connection.php';

// Ambil keyword pencarian (berdasarkan NIK)
$keyword = isset($_GET['search']) ? trim($_GET['search']) : '';

// Query ambil data jamaah
if ($keyword !== '') {
  $stmt = $conn->prepare("SELECT * FROM jamaah WHERE nik LIKE ? ORDER BY created_at DESC");
  $like = "%$keyword%";
  $stmt->bind_param("s", $like);
  $stmt->execute();
  $q = $stmt->get_result();
} else {
  $q = mysqli_query($conn, "SELECT * FROM jamaah ORDER BY created_at DESC");
}
?>

<body class="jamaah-page">

<?php include 'partials/navbar.php'; ?>

<main class="main">

  <!-- ✅ Hero Section (disamakan dengan index1.php) -->
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

  <!-- Data Jamaah Section -->
  <section id="data-jamaah" class="section py-5">
    <div class="container">
      <h1 class="display-5 fw-bold text-center mb-5 text-gold">Data Jamaah</h1>

      <!-- 🔍 Form Pencarian -->
      <form method="GET" action="" class="mb-4">
        <div class="input-group input-group-lg shadow-sm">
          <input 
            type="text" 
            name="search" 
            class="form-control" 
            placeholder="Cari Jamaah berdasarkan NIK..."
            value="<?= htmlspecialchars($keyword) ?>">
          <button type="submit" class="btn btn-gold px-4">Cari</button>
        </div>
      </form>

      <!-- 🧾 List Data Jamaah -->
      <div class="row g-4">
        <?php if (mysqli_num_rows($q) > 0): ?>
          <?php while ($d = mysqli_fetch_assoc($q)): ?>
            <div class="col-lg-4 col-md-6">
              <div class="jamaah-card card shadow border-0 rounded-4 h-100">
                <div class="card-body p-4">
                  <h5 class="fw-bold text-gold mb-2"><?= htmlspecialchars($d['nama']) ?></h5>
                  <p class="mb-1"><strong>NIK:</strong> <?= htmlspecialchars($d['nik']) ?></p>
                  <p class="mb-1"><strong>Telepon:</strong> <?= htmlspecialchars($d['phone']) ?></p>
                  <p class="mb-2"><strong>Alamat:</strong> <?= htmlspecialchars($d['alamat']) ?></p>
                  <a href="detail-jamaah.php?id=<?= $d['id'] ?>" class="btn btn-outline-secondary rounded-pill mt-3">
                    <i class="bi bi-eye"></i> Lihat Detail
                  </a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="col-12 text-center py-5">
            <p class="text-muted fs-5"><i class="bi bi-info-circle me-2"></i> Tidak ada data jamaah ditemukan.</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

</main>

<?php include 'partials/footer.php'; ?>

<!-- CSS -->
<style>
body.jamaah-page {
  font-family: 'Poppins', sans-serif;
  background: #f9f9f9;
  margin: 0;
  padding-top: 90px;
}

/* ✅ Hero section disamakan dengan index1.php */
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

/* Tombol dan kartu tetap seperti sebelumnya */
.text-gold {
  background: linear-gradient(90deg, #c19a33, #e4c36f);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.btn-gold {
  background: linear-gradient(90deg, #c19a33, #e4c36f);
  color: #fff;
  font-weight: 600;
  border: none;
  transition: all 0.3s ease;
}

.btn-gold:hover {
  background: linear-gradient(90deg, #e4c36f, #c19a33);
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(193,154,51,0.3);
}

.jamaah-card {
  background: #fff;
  transition: all 0.3s ease;
}

.jamaah-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.jamaah-card .card-body p {
  font-size: 15px;
  color: #444;
}
</style>
</body>
</html>
