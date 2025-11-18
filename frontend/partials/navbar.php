<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<header id="header" class="header fixed-top d-flex align-items-center">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@500;700&display=swap');

    body {
      padding-top: 90px;
      font-family: 'Nunito', sans-serif;
      background-color: #f9f9f9;
      margin: 0;
    }

    /* === HEADER === */
    .header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: linear-gradient(90deg, #ffffff 0%, #f8f4e3 100%);
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
      transition: all 0.4s ease;
      z-index: 1000;
    }

    .header .container-xl {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 1200px;
      margin: auto;
      padding: 12px 20px;
    }

    /* === LOGO === */
    .logo {
      display: flex;
      align-items: center;
      text-decoration: none;
      gap: 10px;
    }

    .logo img {
      height: 70px;
      width: auto;
      transition: transform 0.3s ease;
    }

    .sitename {
      font-size: 26px;
      font-weight: 700;
      background: linear-gradient(90deg, #c19a33, #d4b451);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .logo:hover img {
      transform: scale(1.08);
    }

    /* === NAVIGATION === */
    .navmenu ul {
      list-style: none;
      display: flex;
      align-items: center;
      gap: 30px;
      margin: 0;
      padding: 0;
    }

    .navmenu a {
      text-decoration: none;
      font-weight: 600;
      font-size: 16px;
      color: #333;
      position: relative;
      transition: all 0.3s ease;
    }

    .navmenu a::after {
      content: '';
      position: absolute;
      bottom: -6px;
      left: 0;
      width: 0%;
      height: 2px;
      background-color: #c19a33;
      transition: width 0.3s ease;
    }

    .navmenu a:hover::after,
    .navmenu a.active::after {
      width: 100%;
    }

    .navmenu a:hover {
      color: #c19a33;
    }

    /* === BUTTONS === */
    .auth-btn {
      background: linear-gradient(90deg, #c19a33, #e4c36f);
      color: #fff !important;
      padding: 8px 20px;
      border-radius: 50px;
      font-weight: 700;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(193, 154, 51, 0.3);
    }

    .auth-btn:hover {
      background: linear-gradient(90deg, #e4c36f, #c19a33);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(193, 154, 51, 0.4);
    }

    /* === MOBILE RESPONSIVE === */
    .mobile-nav-toggle {
      display: none;
      font-size: 30px;
      color: #c19a33;
      cursor: pointer;
    }

    @media (max-width: 991.98px) {
      .navmenu ul {
        display: none;
        flex-direction: column;
        align-items: flex-start;
        background: #ffffff;
        position: absolute;
        top: 90px;
        right: 20px;
        width: 240px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }

      .navmenu ul.active {
        display: flex;
      }

      .mobile-nav-toggle {
        display: block;
      }

      .logo img {
        height: 60px;
      }

      .sitename {
        font-size: 20px;
      }
    }

    /* === SCROLL EFFECT === */
    .header.scrolled {
      background: linear-gradient(90deg, #fffdf6 0%, #f6f2e0 100%);
      padding: 6px 0;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
  </style>

  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
      <img src="../storages/vecteezy_mecca-travel-logo-vector-design_18735143.svg" alt="Logo Trevela">
      <h1 class="sitename">Trevela Haji & Umroh</h1>
    </a>

    <nav id="navmenu" class="navmenu">
  <ul>
    <li><a href="index.php" class="active">Home</a></li>
    <li><a href="#about">Tentang Kami</a></li>
    <li><a href="#services">Layanan</a></li>

    <?php if (!empty($_SESSION['username'])): ?>
      <!-- Dropdown Data -->
      <li class="dropdown">
        <a href="#"><span>Data</span> <i class="bi bi-chevron-down"></i></a>
        <ul class="dropdown-menu">
          <li><a href="index2.php">Data Jamaah</a></li>
          <li><a href="pembayaran.php">Data Pembayaran</a></li>
          <li><a href="pemberangkatan.php">Data Pemberangkatan</a></li>
        </ul>
      </li>

      <!-- Tombol logout -->
      <li><a href="../frontend/actions/logout.php" class="auth-btn">Logout</a></li>
    <?php else: ?>
      <!-- Jika belum login -->
      <li><a href="../frontend/sections/login.php" class="auth-btn">Login</a></li>
      <li><a href="../frontend/sections/register.php" class="auth-btn">Register</a></li>
    <?php endif; ?>
  </ul>
  <i class="mobile-nav-toggle bi bi-list"></i>
</nav>
  </div>

  <script>
    // Toggle mobile nav
    const toggle = document.querySelector('.mobile-nav-toggle');
    const nav = document.querySelector('.navmenu ul');
    toggle.addEventListener('click', () => {
      nav.classList.toggle('active');
      toggle.classList.toggle('bi-x');
    });

    // Scroll effect
    window.addEventListener('scroll', function() {
      const header = document.querySelector('.header');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });
  </script>
</header>
