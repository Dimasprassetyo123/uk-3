<?php
include '../../../config/connection.php';

// Pastikan ada ID
if (!isset($_GET['id'])) {
    echo "<script>
        alert('ID jamaah tidak ditemukan!');
        window.location='../../pages/data jamaah/index.php';
    </script>";
    exit;
}

$id = intval($_GET['id']);

// Pastikan ID valid
if ($id <= 0) {
    echo "<script>
        alert('ID tidak valid!');
        window.location='../../pages/data jamaah/index.php';
    </script>";
    exit;
}

// Cek apakah jamaah masih dipakai di tabel registrations
$check = mysqli_query($conn, "SELECT id FROM registrations WHERE jamaah_id = $id LIMIT 1");

if (mysqli_num_rows($check) > 0) {
    echo "<script>
        alert('Tidak bisa menghapus! Jamaah ini masih memiliki data pendaftaran.');
        window.location='../../pages/data jamaah/index.php';
    </script>";
    exit;
}

// Jika aman → hapus
$query = "DELETE FROM jamaah WHERE id = $id";
if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('Data jamaah berhasil dihapus!');
        window.location='../../pages/data jamaah/index.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus data! Error: " . mysqli_error($conn) . "');
        window.location='../../pages/data jamaah/index.php';
    </script>";
}
