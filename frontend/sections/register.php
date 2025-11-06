<?php
session_start();
include '../../config/connection.php'; // pastikan path sesuai

// cek koneksi
if (!$conn) {
    die("Koneksi database gagal!");
}

if (isset($_POST['register'])) {
    // amankan input user
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // cek apakah username sudah digunakan
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Username sudah digunakan!');</script>";
    } else {
        // insert user baru
        $query = mysqli_query($conn, "
            INSERT INTO users (username, email, password_hash, role_id, is_active, created_at)
            VALUES ('$username', '$email', '$password', 2, 1, NOW())
        ");

        if ($query) {
            echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal mendaftar!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Jamaah - Haji & Umroh</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #f9f9f9, #e8f5e9);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #fff;
            padding: 30px;
            width: 350px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #006400;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            width: 100%;
            background: #008000;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #006400;
        }

        a {
            color: #008000;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .icon {
            font-size: 40px;
            color: #FFD700;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="icon">🕋</div>
        <h2>Daftar Jamaah</h2>
        <p>Silakan isi data Anda untuk bergabung dengan sistem Haji & Umroh</p>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Nama pengguna" required>
            <input type="email" name="email" placeholder="Alamat email" required>
            <input type="password" name="password" placeholder="Kata sandi" required>
            <button type="submit" name="register">Daftar Sekarang</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
    </div>
</body>

</html>
