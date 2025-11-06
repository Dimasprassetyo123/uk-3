<?php
include 'partials/header.php';
?>

<style>
/* Minimal Custom Enhancements - Bootstrap First */
.hero.section {
  min-height: 90vh;
}

.hero h1 {
  font-size: clamp(2.5rem, 5vw, 3.5rem);
  text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
}

.hero-img img {
  filter: drop-shadow(0 10px 30px rgba(0,0,0,0.15));
  animation: float 6s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

.btn-get-started, .btn-watch-video {
  transition: all 0.3s ease;
}

.btn-get-started:hover {
  transform: translateY(-3px);
}

.about-img-wrapper:hover,
.features-item:hover,
.service-item:hover,
.card-item:hover {
  transform: translateY(-5px);
}

.pulsating-play-btn {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0%, 100% { transform: translate(-50%, -50%) scale(1); }
  50% { transform: translate(-50%, -50%) scale(1.1); }
}
</style>

<body class="index-page">

<?php
include 'partials/navbar.php';
?>

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
            <div class="d-flex flex-wrap gap-3">
              <a href="index1.php" class="btn btn-primary btn-lg rounded-pill px-4 shadow btn-get-started">Lihat Paket Kami</a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn btn-outline-light btn-lg rounded-pill px-4 btn-watch-video d-flex align-items-center gap-2">
                <i class="bi bi-play-circle fs-4"></i><span>Tonton Video</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section py-5">
      <div class="container py-5">
        <div class="row gy-5 align-items-center">
          <div class="col-lg-6 order-lg-last" data-aos="fade-up" data-aos-delay="200">
            <div class="position-relative about-img-wrapper rounded shadow-lg overflow-hidden transition">
              <img src="../storages/gambar2-removebg-preview.png" class="img-fluid rounded" alt="Tentang Travel Kami" style="max-height: 500px; width: 100%; object-fit: cover;">
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn position-absolute top-50 start-50 translate-middle bg-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 80px; height: 80px;">
                <i class="bi bi-play-fill text-primary" style="font-size: 2rem;"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="display-5 fw-bold mb-4">Tentang Kami</h3>
            <p class="lead mb-4">
              Kami adalah biro perjalanan resmi yang telah berpengalaman dalam memberangkatkan jamaah Haji & Umroh ke Tanah Suci.
              Dengan pelayanan profesional, pembimbing berilmu, serta fasilitas nyaman, kami siap mendampingi ibadah Anda menjadi
              lebih tenang dan bermakna.
            </p>
            
            <div class="d-flex gap-3 mb-4 p-4 bg-light rounded-3 border-start border-primary border-5 shadow-sm transition">
              <i class="bi bi-diagram-3 text-primary" style="font-size: 2.5rem;"></i>
              <div>
                <h5 class="fw-bold">Berizin Resmi & Terpercaya</h5>
                <p class="mb-0 text-muted">Kami memiliki izin resmi dari Kementerian Agama dan telah memberangkatkan ribuan jamaah.</p>
              </div>
            </div>

            <div class="d-flex gap-3 mb-4 p-4 bg-light rounded-3 border-start border-success border-5 shadow-sm transition">
              <i class="bi bi-stars text-success" style="font-size: 2.5rem;"></i>
              <div>
                <h5 class="fw-bold">Fasilitas Nyaman</h5>
                <p class="mb-0 text-muted">Hotel berbintang, transportasi modern, serta makanan halal khas Indonesia selama di tanah suci.</p>
              </div>
            </div>

            <div class="d-flex gap-3 p-4 bg-light rounded-3 border-start border-info border-5 shadow-sm transition">
              <i class="bi bi-people text-info" style="font-size: 2.5rem;"></i>
              <div>
                <h5 class="fw-bold">Pembimbing Profesional</h5>
                <p class="mb-0 text-muted">Dibimbing oleh ustadz dan pembimbing berpengalaman untuk memastikan ibadah berjalan lancar dan khusyuk.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /About Section -->

    <!-- Features Section -->
    <section id="features" class="features section bg-light">
      <div class="container py-5">
        
        <div class="row gy-5 align-items-center mb-5 p-5 bg-white rounded-4 shadow features-item transition" data-aos="fade-up">
          <div class="col-md-6 text-center" data-aos="zoom-out" data-aos-delay="100">
            <img src="../storages/vecteezy_mecca-travel-logo-vector-design_18735143.svg" class="img-fluid" alt="Paket Umroh" style="max-height: 400px;">
          </div>
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="display-6 fw-bold mb-3">Paket Umroh Lengkap & Terjangkau</h3>
            <p class="fst-italic lead text-muted mb-4">
              Nikmati perjalanan ibadah yang tenang dan aman dengan fasilitas lengkap serta harga bersahabat.
            </p>
            <ul class="list-unstyled">
              <li class="d-flex align-items-center gap-3 mb-3">
                <i class="bi bi-check-circle-fill text-success fs-3"></i>
                <span class="fs-5">Hotel bintang 4–5 dekat Masjidil Haram & Nabawi.</span>
              </li>
              <li class="d-flex align-items-center gap-3 mb-3">
                <i class="bi bi-check-circle-fill text-success fs-3"></i>
                <span class="fs-5">Pembimbing ibadah yang ramah dan berpengalaman.</span>
              </li>
              <li class="d-flex align-items-center gap-3">
                <i class="bi bi-check-circle-fill text-success fs-3"></i>
                <span class="fs-5">Paket umroh reguler, VIP, dan keluarga tersedia.</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="row gy-5 align-items-center p-5 bg-white rounded-4 shadow features-item transition" data-aos="fade-up">
          <div class="col-md-6 order-md-last text-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="../storages/People at hajj pilgrimage-Photoroom.png" class="img-fluid" alt="Haji Plus" style="max-height: 400px;">
          </div>
          <div class="col-md-6 order-md-first" data-aos="fade-up" data-aos-delay="200">
            <h3 class="display-6 fw-bold mb-3">Paket Haji Plus & Furoda</h3>
            <p class="fst-italic lead text-muted mb-3">
              Berangkat lebih cepat tanpa antre panjang, dengan fasilitas premium dan layanan eksklusif.
            </p>
            <p class="fs-5 text-muted">
              Dapatkan pengalaman spiritual tak terlupakan bersama bimbingan ibadah yang sesuai sunnah, akomodasi mewah,
              serta pelayanan profesional dari keberangkatan hingga kembali ke tanah air.
            </p>
          </div>
        </div>

      </div>
    </section><!-- /Features Section -->

    <!-- Services Section -->
    <section id="services" class="services section">
      <div class="container py-5">
        
        <div class="text-center mb-5" data-aos="fade-up">
          <h2 class="display-4 fw-bold mb-3">Layanan Kami</h2>
          <p class="lead text-muted">Kami hadir untuk memberikan pelayanan terbaik dalam setiap perjalanan ibadah Anda.</p>
        </div>

        <div class="row g-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item card h-100 border-0 shadow rounded-4 p-4 transition">
              <div class="text-center mb-3">
                <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                  <i class="bi bi-airplane text-info" style="font-size: 2.5rem;"></i>
                </div>
              </div>
              <h3 class="h4 fw-bold text-center mb-3">Paket Umroh Reguler</h3>
              <p class="text-muted text-center">Paket ekonomis dengan fasilitas lengkap, nyaman, dan pembimbing profesional.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item card h-100 border-0 shadow rounded-4 p-4 transition">
              <div class="text-center mb-3">
                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                  <i class="bi bi-stars text-warning" style="font-size: 2.5rem;"></i>
                </div>
              </div>
              <h3 class="h4 fw-bold text-center mb-3">Paket Haji Plus</h3>
              <p class="text-muted text-center">Berangkat lebih cepat dengan fasilitas hotel premium dan bimbingan ustadz ahli.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item card h-100 border-0 shadow rounded-4 p-4 transition">
              <div class="text-center mb-3">
                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                  <i class="bi bi-people text-success" style="font-size: 2.5rem;"></i>
                </div>
              </div>
              <h3 class="h4 fw-bold text-center mb-3">Umroh Keluarga & Private</h3>
              <p class="text-muted text-center">Perjalanan ibadah khusus keluarga dengan jadwal fleksibel dan layanan eksklusif.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item card h-100 border-0 shadow rounded-4 p-4 transition">
              <div class="text-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                  <i class="bi bi-book-half text-danger" style="font-size: 2.5rem;"></i>
                </div>
              </div>
              <h3 class="h4 fw-bold text-center mb-3">Bimbingan Manasik</h3>
              <p class="text-muted text-center">Pembekalan ibadah haji & umroh sesuai sunnah oleh pembimbing bersertifikat.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item card h-100 border-0 shadow rounded-4 p-4 transition">
              <div class="text-center mb-3">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                  <i class="bi bi-globe text-primary" style="font-size: 2.5rem;"></i>
                </div>
              </div>
              <h3 class="h4 fw-bold text-center mb-3">Wisata Halal Internasional</h3>
              <p class="text-muted text-center">Tour halal ke destinasi muslim dunia seperti Turki, Mesir, dan Dubai.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item card h-100 border-0 shadow rounded-4 p-4 transition">
              <div class="text-center mb-3">
                <div class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                  <i class="bi bi-clock text-secondary" style="font-size: 2.5rem;"></i>
                </div>
              </div>
              <h3 class="h4 fw-bold text-center mb-3">Layanan 24 Jam</h3>
              <p class="text-muted text-center">Kami siap membantu Anda kapan pun dengan layanan pelanggan 24 jam.</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- /Services Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section dark-background">
      <div class="container py-5">
        
        <div class="text-center mb-5" data-aos="fade-up">
          <h2 class="display-4 fw-bold mb-3">Mengapa Memilih Kami</h2>
          <p class="lead">Kepercayaan dan kenyamanan jamaah adalah prioritas utama kami.</p>
        </div>

        <div class="row g-4">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card-item card h-100 bg-white bg-opacity-10 border-0 backdrop-blur p-5 rounded-4 transition">
              <span class="display-1 fw-bold text-white opacity-25 mb-3 d-block">01</span>
              <h4 class="h3 fw-bold mb-3"><a href="#" class="text-white text-decoration-none stretched-link">Legal & Aman</a></h4>
              <p class="text-white-50 fs-5">Terdaftar resmi di Kemenag RI dan memiliki izin operasional lengkap.</p>
            </div>
          </div>
          
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card-item card h-100 bg-white bg-opacity-10 border-0 backdrop-blur p-5 rounded-4 transition">
              <span class="display-1 fw-bold text-white opacity-25 mb-3 d-block">02</span>
              <h4 class="h3 fw-bold mb-3"><a href="#" class="text-white text-decoration-none stretched-link">Fasilitas Premium</a></h4>
              <p class="text-white-50 fs-5">Hotel dekat Masjidil Haram & Nabawi, transportasi nyaman, dan menu makanan berkualitas.</p>
            </div>
          </div>
          
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card-item card h-100 bg-white bg-opacity-10 border-0 backdrop-blur p-5 rounded-4 transition">
              <span class="display-1 fw-bold text-white opacity-25 mb-3 d-block">03</span>
              <h4 class="h3 fw-bold mb-3"><a href="#" class="text-white text-decoration-none stretched-link">Pembimbing Berpengalaman</a></h4>
              <p class="text-white-50 fs-5">Dibimbing oleh ustadz profesional yang berpengalaman mendampingi jamaah di tanah suci.</p>
            </div>
          </div>
        </div>
        
      </div>
    </section><!-- /Why Us Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section dark-background" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
      <div class="container py-5" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item card bg-white bg-opacity-10 border-0 backdrop-blur p-4 rounded-4 text-center transition">
              <i class="bi bi-emoji-smile display-3 text-white mb-3"></i>
              <span class="display-4 fw-bold text-white d-block mb-2" data-purecounter-start="0" data-purecounter-end="4500" data-purecounter-duration="1"></span>
              <p class="text-white mb-0"><strong>Jamaah Puas</strong></p>
              <p class="text-white-50 small">dalam 5 tahun terakhir</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="stats-item card bg-white bg-opacity-10 border-0 backdrop-blur p-4 rounded-4 text-center transition">
              <i class="bi bi-airplane-engines display-3 text-white mb-3"></i>
              <span class="display-4 fw-bold text-white d-block mb-2" data-purecounter-start="0" data-purecounter-end="120" data-purecounter-duration="1"></span>
              <p class="text-white mb-0"><strong>Penerbangan</strong></p>
              <p class="text-white-50 small">ke Tanah Suci setiap tahun</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="stats-item card bg-white bg-opacity-10 border-0 backdrop-blur p-4 rounded-4 text-center transition">
              <i class="bi bi-headset display-3 text-white mb-3"></i>
              <span class="display-4 fw-bold text-white d-block mb-2" data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1"></span>
              <p class="text-white mb-0"><strong>Layanan 24 Jam</strong></p>
              <p class="text-white-50 small">siap membantu jamaah</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="stats-item card bg-white bg-opacity-10 border-0 backdrop-blur p-4 rounded-4 text-center transition">
              <i class="bi bi-people display-3 text-white mb-3"></i>
              <span class="display-4 fw-bold text-white d-block mb-2" data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1"></span>
              <p class="text-white mb-0"><strong>Tim Profesional</strong></p>
              <p class="text-white-50 small">siap melayani Anda</p>
            </div>
          </div>

        </div>
      </div>
    </section><!-- /Stats Section -->

  </main>

<?php
include 'partials/footer.php';
?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  <div id="preloader"></div>

<?php
include 'partials/script.php';
?>
</body>
</html>