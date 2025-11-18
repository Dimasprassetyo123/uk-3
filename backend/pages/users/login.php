<?php
session_start();

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['user_id'])) {
  header("Location: ../../pages/dashbord/index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Travel Haji & Umroh</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #0d6efd;
      --primary-dark: #0b5ed7;
      --gold-color: #d4af37;
      --light-color: #ffffff;
      --dark-color: #333333;
      --overlay-color: rgba(0, 0, 0, 0.6);
      --card-bg: rgba(255, 255, 255, 0.15);
      --card-border: rgba(255, 255, 255, 0.3);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background:
        linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(212, 175, 55, 0.1) 100%),
        url('https://images.unsplash.com/photo-1547996160-81dfd9c4b1cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') no-repeat center center/cover;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      padding: 20px;
    }

    /* Overlay dengan gradien yang lebih menarik */
    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg,
          rgba(13, 110, 253, 0.3) 0%,
          rgba(0, 0, 0, 0.7) 50%,
          rgba(212, 175, 55, 0.3) 100%);
      backdrop-filter: blur(2px);
      z-index: 1;
    }

    .login-container {
      position: relative;
      z-index: 2;
      width: 100%;
      max-width: 420px;
    }

    .login-card {
      position: relative;
      width: 100%;
      padding: 35px 30px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.25);
      box-shadow:
        0 15px 35px rgba(0, 0, 0, 0.4),
        0 0 0 1px rgba(255, 255, 255, 0.1) inset;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-card:hover {
      transform: translateY(-5px);
      box-shadow:
        0 20px 40px rgba(0, 0, 0, 0.5),
        0 0 0 1px rgba(255, 255, 255, 0.15) inset;
    }

    .login-card::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--primary-color), var(--gold-color));
      box-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
    }

    .logo-container {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo-icon {
      font-size: 3.5rem;
      color: var(--gold-color);
      margin-bottom: 10px;
      display: inline-block;
      padding: 15px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.15);
      box-shadow:
        0 5px 15px rgba(0, 0, 0, 0.2),
        0 0 0 1px rgba(255, 255, 255, 0.1) inset;
      transition: transform 0.3s ease;
    }

    .logo-icon:hover {
      transform: scale(1.05) rotate(5deg);
    }

    .login-title {
      font-weight: 700;
      text-align: center;
      color: white;
      font-size: 28px;
      margin-bottom: 25px;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
      position: relative;
    }

    .login-title::after {
      content: "";
      position: absolute;
      bottom: -8px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: linear-gradient(90deg, var(--primary-color), var(--gold-color));
      border-radius: 2px;
    }

    .form-label {
      color: var(--light-color);
      font-weight: 500;
      margin-bottom: 8px;
      display: block;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .form-control {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 12px;
      border: none;
      padding: 12px 45px 12px 15px;
      font-size: 15px;
      transition: all 0.3s;
      box-shadow:
        0 3px 10px rgba(0, 0, 0, 0.15),
        0 0 0 1px rgba(255, 255, 255, 0.1) inset;
      color: var(--dark-color);
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 1);
      box-shadow:
        0 0 0 3px rgba(13, 110, 253, 0.3),
        0 5px 15px rgba(0, 0, 0, 0.2);
      transform: translateY(-2px);
    }

    .form-control::placeholder {
      color: #6c757d;
    }

    .input-icon {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
      font-size: 18px;
    }

    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #6c757d;
      cursor: pointer;
      font-size: 18px;
      transition: color 0.3s;
      z-index: 3;
    }

    .password-toggle:hover {
      color: var(--primary-color);
    }

    .btn-login {
      width: 100%;
      background: linear-gradient(135deg, var(--primary-color), #0a58ca);
      border: none;
      padding: 14px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 16px;
      transition: all 0.3s;
      margin-top: 10px;
      box-shadow:
        0 4px 15px rgba(13, 110, 253, 0.4),
        0 2px 4px rgba(0, 0, 0, 0.1);
      position: relative;
      overflow: hidden;
    }

    .btn-login::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }

    .btn-login:hover {
      background: linear-gradient(135deg, var(--primary-dark), #084298);
      transform: translateY(-3px);
      box-shadow:
        0 8px 25px rgba(13, 110, 253, 0.5),
        0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-login:hover::before {
      left: 100%;
    }

    .btn-login:active {
      transform: translateY(-1px);
    }

    .alert {
      border-radius: 12px;
      border: none;
      margin-bottom: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .footer-text {
      text-align: center;
      color: rgba(255, 255, 255, 0.7);
      margin-top: 25px;
      font-size: 14px;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }

    /* Animasi untuk form */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .login-card {
      animation: fadeIn 0.8s ease-out;
    }

    /* Efek partikel background */
    .bg-particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }

    .particle {
      position: absolute;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      animation: float 15s infinite linear;
    }

    @keyframes float {
      0% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
      }

      10% {
        opacity: 0.7;
      }

      90% {
        opacity: 0.7;
      }

      100% {
        transform: translateY(-100px) rotate(360deg);
        opacity: 0;
      }
    }

    /* Responsif untuk mobile */
    @media (max-width: 480px) {
      .login-card {
        padding: 25px 20px;
      }

      .login-title {
        font-size: 24px;
      }

      .logo-icon {
        font-size: 3rem;
      }

      body {
        background:
          linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(212, 175, 55, 0.1) 100%),
          url('https://images.unsplash.com/photo-1547996160-81dfd9c4b1cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80') no-repeat center center/cover;
      }
    }
  </style>
</head>

<body>

  <!-- Efek partikel background -->
  <div class="bg-particles" id="particles"></div>

  <div class="login-container">
    <div class="login-card">
      <div class="logo-container">
        <i class="bi bi-airplane-engines logo-icon"></i>
      </div>

      <h3 class="login-title">Login Travel Haji & Umroh</h3>

      <?php if (isset($_SESSION['login_error'])): ?>
        <div class="alert alert-danger text-center">
          <?= $_SESSION['login_error'];
          unset($_SESSION['login_error']); ?>
        </div>
      <?php endif; ?>

      <form action="../../actions/auth/login_proses.php" method="POST">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <div class="input-group">
            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            <i class="bi bi-person-fill input-icon"></i>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <div class="input-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            <button type="button" class="password-toggle" id="togglePassword">
              <i class="bi bi-eye-fill"></i>
            </button>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-login">
          <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </button>
      </form>

      <div class="footer-text">
        &copy; 2023 Travel Haji & Umroh. All rights reserved.
      </div>
    </div>
  </div>

  <script>
    // Toggle show/hide password
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      const icon = this.querySelector('i');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye-fill');
        icon.classList.add('bi-eye-slash-fill');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye-slash-fill');
        icon.classList.add('bi-eye-fill');
      }
    });

    // Efek partikel background
    function createParticles() {
      const particlesContainer = document.getElementById('particles');
      const particleCount = 15;

      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');

        // Ukuran acak
        const size = Math.random() * 6 + 2;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;

        // Posisi acak
        particle.style.left = `${Math.random() * 100}vw`;

        // Animasi dengan delay acak
        particle.style.animationDelay = `${Math.random() * 15}s`;
        particle.style.animationDuration = `${15 + Math.random() * 10}s`;

        particlesContainer.appendChild(particle);
      }
    }

    // Jalankan efek partikel setelah halaman dimuat
    window.addEventListener('load', createParticles);
  </script>

</body>

</html>