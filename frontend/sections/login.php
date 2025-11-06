<?php
session_start();
include '../../config/connection.php'; // pastikan path sesuai

// cek koneksi
if (!$conn) {
    die("Koneksi database gagal!");
}

if (isset($_POST['login'])) {
    // amankan input user
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // ambil user berdasarkan username dan aktif
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND is_active=1");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password_hash'])) {
        // simpan session
        $_SESSION['username'] = $user['username'];
        $_SESSION['role_id'] = $user['role_id'];

        echo "<script>alert('Selamat datang di sistem Haji & Umroh!'); window.location='../index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Jamaah - Haji & Umroh</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom right, #f0fff0, #d9fdd3);
        display: flex; justify-content: center; align-items: center; height: 100vh;
    }
    .card {
        background: white; padding: 30px; width: 350px;
        border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-align: center;
    }
    .icon { font-size: 40px; color: #FFD700; margin-bottom: 10px; }
    h2 { color: #006400; margin-bottom: 10px; }
    p { color: #555; font-size: 14px; margin-bottom: 20px; }
    input {
        width: 100%; padding: 10px; margin: 8px 0;
        border-radius: 8px; border: 1px solid #ccc; font-size: 14px;
    }
    button {
        width: 100%; background: #007E33; color: white; border: none;
        padding: 10px; border-radius: 8px; font-size: 16px; cursor: pointer;
    }
    button:hover { background: #006400; }
    a { color: #007E33; text-decoration: none; font-weight: bold; }
    a:hover { text-decoration: underline; }
</style>
</head>
<body>
<div class="card">
    <div class="icon">🕋</div>
    <h2>Login Jamaah</h2>
    <p>Masuk ke akun Anda untuk mengelola perjalanan Haji & Umroh</p>
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Nama pengguna" required>
        <input type="password" name="password" placeholder="Kata sandi" required>
        <button type="submit" name="login">Masuk</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
</div>
</body>
</html>
