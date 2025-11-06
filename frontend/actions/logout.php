<?php
// Gunakan nama session khusus pelanggan
session_name("session_user");
session_start();

// Hapus semua data session pelanggan
$_SESSION = [];
session_unset();
session_destroy();

// Redirect ke halaman login pelanggan
echo "<script>
        alert('Anda telah keluar!');
        window.location.href='../sections/login.php';
    </script>";
exit();
?>
