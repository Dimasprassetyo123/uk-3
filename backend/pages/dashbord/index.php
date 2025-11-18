<?php
session_start();
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

// Hitung total data
$totalJamaah = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM jamaah"))['total'];
$totalPendaftaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrations"))['total'];
$totalPembayaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM payments"))['total'];
$totalPaket = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM paket"))['total'];
$totalKeberangkatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM keberangkatan"))['total'];

// Hitung statistik tambahan
$pembayaranSukses = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM payments WHERE status = 'confirmed'"))['total'];
$pembayaranPending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM payments WHERE status = 'pending'"))['total'];

// Ambil 5 aktivitas log terbaru hanya untuk admin
if ($_SESSION['role_name'] === 'admin') {
    $qLogs = mysqli_query($conn, "
        SELECT a.*, u.full_name 
        FROM audit_logs a
        LEFT JOIN users u ON u.id = a.user_id
        ORDER BY a.created_at DESC
        LIMIT 5
    ");
}
?>

<!-- Main Content -->
<main class="main-content">
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 pt-3">
            <div>
                <h2 class="mb-1 fw-bold"><i class="fas fa-tachometer-alt me-2 text-primary"></i>Dashboard <?= ucfirst($_SESSION['role_name']) ?></h2>
                <p class="text-muted mb-0"><i class="fas fa-user me-1"></i> Selamat datang, <?= $_SESSION['full_name'] ?>!</p>
            </div>
            <div class="text-end">
                <span class="badge bg-primary-subtle text-primary p-2">
                    <i class="fas fa-calendar-day me-1"></i><?= date('l, d F Y') ?>
                </span>
            </div>
        </div>

        <!-- Statistik Utama -->
        <div class="row mb-4">
            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-title text-muted mb-1"><i class="fas fa-users me-1 text-primary"></i> Total Jamaah</p>
                                <h2 class="mb-0 fw-bold"><?= $totalJamaah ?></h2>
                            </div>
                        </div>
                        <small class="text-muted"><i class="fas fa-circle text-success me-1" style="font-size: 8px;"></i> Data terupdate</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-title text-muted mb-1"><i class="fas fa-file-signature me-1 text-success"></i> Pendaftaran</p>
                                <h2 class="mb-0 fw-bold"><?= $totalPendaftaran ?></h2>
                            </div>
                        </div>
                        <small class="text-muted"><i class="fas fa-user-plus me-1"></i> Total pendaftar</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-title text-muted mb-1"><i class="fas fa-credit-card me-1 text-info"></i> Pembayaran</p>
                                <h2 class="mb-0 fw-bold"><?= $totalPembayaran ?></h2>
                            </div>
                        </div>
                        <small class="text-muted"><i class="fas fa-exchange-alt me-1"></i> Total transaksi</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-title text-muted mb-1"><i class="fas fa-box me-1 text-warning"></i> Paket Umrah</p>
                                <h2 class="mb-0 fw-bold"><?= $totalPaket ?></h2>
                            </div>
                        </div>
                        <small class="text-muted"><i class="fas fa-cube me-1"></i> Paket tersedia</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-title text-muted mb-1"><i class="fas fa-plane-departure me-1 text-danger"></i> Keberangkatan</p>
                                <h2 class="mb-0 fw-bold"><?= $totalKeberangkatan ?></h2>
                            </div>
                        </div>
                        <small class="text-muted"><i class="fas fa-calendar-check me-1"></i> Jadwal berangkat</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-title text-muted mb-1"><i class="fas fa-check-circle me-1 text-secondary"></i> Sukses</p>
                                <h2 class="mb-0 fw-bold"><?= $pembayaranSukses ?></h2>
                            </div>
                        </div>
                        <small class="text-muted"><i class="fas fa-thumbs-up me-1"></i> Pembayaran sukses</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php if ($_SESSION['role_name'] === 'admin'): ?>
                <!-- Aktivitas Terbaru - Hanya untuk Admin -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-history me-2 text-primary"></i>Aktivitas Terbaru</h5>
                            <a href="../user_activity/index.php" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt me-1"></i>Selengkapnya
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="50" class="border-top-0"><i class="fas fa-hashtag"></i></th>
                                            <th class="border-top-0"><i class="fas fa-user me-1"></i> User</th>
                                            <th class="border-top-0"><i class="fas fa-cog me-1"></i> Aksi</th>
                                            <th class="border-top-0"><i class="fas fa-cube me-1"></i> Objek</th>
                                            <th class="border-top-0"><i class="fas fa-comment me-1"></i> Pesan</th>
                                            <th class="border-top-0"><i class="fas fa-clock me-1"></i> Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($qLogs) > 0): ?>
                                            <?php $no = 1;
                                            while ($log = mysqli_fetch_assoc($qLogs)) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++ ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                                <span class="text-white fw-bold" style="font-size: 12px;">
                                                                    <?= strtoupper(substr($log['full_name'] ?? 'U', 0, 1)) ?>
                                                                </span>
                                                            </div>
                                                            <span class="fw-medium"><?= htmlspecialchars($log['full_name'] ?? '-') ?></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge 
                                                            <?= $log['action'] == 'CREATE' ? 'bg-success' : '' ?>
                                                            <?= $log['action'] == 'UPDATE' ? 'bg-warning' : '' ?>
                                                            <?= $log['action'] == 'DELETE' ? 'bg-danger' : '' ?>
                                                            <?= !in_array($log['action'], ['CREATE', 'UPDATE', 'DELETE']) ? 'bg-primary' : '' ?>
                                                        ">
                                                            <i class="fas 
                                                                <?= $log['action'] == 'CREATE' ? 'fa-plus-circle' : '' ?>
                                                                <?= $log['action'] == 'UPDATE' ? 'fa-edit' : '' ?>
                                                                <?= $log['action'] == 'DELETE' ? 'fa-trash-alt' : '' ?>
                                                                <?= !in_array($log['action'], ['CREATE', 'UPDATE', 'DELETE']) ? 'fa-cog' : '' ?>
                                                            me-1"></i>
                                                            <?= $log['action'] ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <small class="text-muted">
                                                            <strong class="d-block"><?= $log['object_type'] ?></strong>
                                                            <i class="fas fa-id-card me-1"></i>ID: <?= $log['object_id'] ?>
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <span class="log-message text-truncate d-inline-block" style="max-width: 150px;" title="<?= htmlspecialchars($log['message']) ?>">
                                                            <i class="fas fa-comment-dots me-1 text-muted"></i>
                                                            <?= htmlspecialchars($log['message']) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <small class="text-muted">
                                                            <i class="fas fa-calendar me-1"></i><?= date('d/m/Y', strtotime($log['created_at'])) ?><br>
                                                            <i class="fas fa-clock me-1"></i><strong><?= date('H:i', strtotime($log['created_at'])) ?></strong>
                                                        </small>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <i class="fas fa-info-circle text-muted me-2"></i>
                                                    Tidak ada aktivitas terbaru
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Status untuk Admin -->
                <div class="col-lg-4 mb-4">
                    <!-- Quick Actions -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-bolt me-2 text-primary"></i>Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="../data jamaah/index.php" class="btn btn-light text-start py-2 border">
                                    <i class="fas fa-users me-2 text-primary"></i>Kelola Jamaah
                                </a>
                                <a href="../data paket/index.php" class="btn btn-light text-start py-2 border">
                                    <i class="fas fa-box me-2 text-success"></i>Kelola Paket
                                </a>
                                <a href="../data pembayaran/index.php" class="btn btn-light text-start py-2 border">
                                    <i class="fas fa-credit-card me-2 text-warning"></i>Lihat Pembayaran
                                </a>
                                <a href="../data berangkat/index.php" class="btn btn-light text-start py-2 border">
                                    <i class="fas fa-plane-departure me-2 text-info"></i>Data Keberangkatan
                                </a>
                                <a href="../user/index.php" class="btn btn-light text-start py-2 border">
                                    <i class="fas fa-user-cog me-2 text-secondary"></i>Kelola Users
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Status Pembayaran -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-chart-pie me-2 text-info"></i>Status Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-medium"><i class="fas fa-check-circle text-success me-1"></i>Sukses</span>
                                    <span class="fw-bold"><?= $pembayaranSukses ?></span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: <?= $totalPembayaran > 0 ? ($pembayaranSukses / $totalPembayaran * 100) : 0 ?>%"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-medium"><i class="fas fa-clock text-warning me-1"></i>Pending</span>
                                    <span class="fw-bold"><?= $pembayaranPending ?></span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: <?= $totalPembayaran > 0 ? ($pembayaranPending / $totalPembayaran * 100) : 0 ?>%"></div>
                                </div>
                            </div>
                            <div class="text-center mt-3 pt-2 border-top">
                                <small class="text-muted"><i class="fas fa-chart-bar me-1"></i>Total: <?= $totalPembayaran ?> transaksi</small>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <!-- Layout untuk User Biasa -->
                <div class="col-lg-8 mb-4">
                    <!-- Informasi untuk User -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-info-circle me-2 text-success"></i>Informasi Umrah</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                            <i class="fas fa-check-circle text-success"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1"><i class="fas fa-file-signature me-1 text-success"></i> Pendaftaran Berhasil</h6>
                                            <p class="text-muted mb-0">Total pendaftaran yang telah Anda lakukan: <strong><?= $totalPendaftaran ?></strong></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start">
                                        <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                            <i class="fas fa-credit-card text-info"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1"><i class="fas fa-money-check me-1 text-info"></i> Status Pembayaran</h6>
                                            <p class="text-muted mb-0">
                                                <i class="fas fa-check text-success me-1"></i>Sukses: <strong><?= $pembayaranSukses ?></strong><br>
                                                <i class="fas fa-clock text-warning me-1"></i>Pending: <strong><?= $pembayaranPending ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                            <i class="fas fa-plane text-warning"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1"><i class="fas fa-plane-departure me-1 text-warning"></i> Keberangkatan</h6>
                                            <p class="text-muted mb-0">Jadwal keberangkatan tersedia: <strong><?= $totalKeberangkatan ?></strong></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                            <i class="fas fa-box text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1"><i class="fas fa-cubes me-1 text-primary"></i> Paket Tersedia</h6>
                                            <p class="text-muted mb-0">Total paket umrah: <strong><?= $totalPaket ?></strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panduan Cepat -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-play-circle me-2 text-primary"></i>Mulai Pendaftaran</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-3"><i class="fas fa-info-circle me-1 text-primary"></i> Ikuti langkah-langkah berikut untuk mendaftar umrah:</p>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center border-0 px-0 py-2">
                                    <span class="badge bg-primary rounded-circle me-3"><i class="fas fa-1 text-white"></i></span>
                                    <div>
                                        <h6 class="fw-bold mb-1"><i class="fas fa-search me-1 text-primary"></i> Pilih Paket</h6>
                                        <p class="text-muted mb-0">Pilih paket umrah yang sesuai dengan kebutuhan Anda</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center border-0 px-0 py-2">
                                    <span class="badge bg-primary rounded-circle me-3"><i class="fas fa-2 text-white"></i></span>
                                    <div>
                                        <h6 class="fw-bold mb-1"><i class="fas fa-edit me-1 text-primary"></i> Isi Form Pendaftaran</h6>
                                        <p class="text-muted mb-0">Lengkapi data diri dan dokumen yang diperlukan</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center border-0 px-0 py-2">
                                    <span class="badge bg-primary rounded-circle me-3"><i class="fas fa-3 text-white"></i></span>
                                    <div>
                                        <h6 class="fw-bold mb-1"><i class="fas fa-money-bill-wave me-1 text-primary"></i> Konfirmasi Pembayaran</h6>
                                        <p class="text-muted mb-0">Lakukan pembayaran dan upload bukti transfer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions untuk User -->
                <div class="col-lg-4 mb-4">
                    <!-- Quick Actions -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-bolt me-2 text-primary"></i>Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="../pendaftaran/index.php" class="btn btn-light text-start py-2 border">
                                    <i class="fas fa-file-signature me-2 text-success"></i>Pendaftaran Baru
                                </a>
                                <a href="../data jamaah/index.php" class="btn btn-light text-start py-2 border">
                                    <i class="fas fa-users me-2 text-primary"></i>Data Jamaah
                                </a>
                                <a href="../data paket/index.php" class="btn btn-light text-start py-2 border">
                                    <i class="fas fa-box me-2 text-info"></i>Lihat Paket
                                </a>
                                <a href="../data pembayaran/index.php" class="btn btn-light text-start py-2 border">
                                    <i class="fas fa-credit-card me-2 text-warning"></i>Pembayaran
                                </a>
                                <a href="../data berangkat/index.php" class="btn btn-light text-start py-2 border">
                                    <i class="fas fa-plane-departure me-2 text-secondary"></i>Jadwal Berangkat
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Status Ringkas -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-chart-bar me-2 text-info"></i>Statistik Ringkas</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                    <span><i class="fas fa-users me-2 text-primary"></i>Jamaah Terdaftar</span>
                                    <span class="badge bg-primary rounded-pill"><?= $totalJamaah ?></span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                    <span><i class="fas fa-file-signature me-2 text-success"></i>Pendaftaran</span>
                                    <span class="badge bg-success rounded-pill"><?= $totalPendaftaran ?></span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                    <span><i class="fas fa-check-circle me-2 text-success"></i>Pembayaran Sukses</span>
                                    <span class="badge bg-success rounded-pill"><?= $pembayaranSukses ?></span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2">
                                    <span><i class="fas fa-box me-2 text-warning"></i>Paket Tersedia</span>
                                    <span class="badge bg-warning rounded-pill"><?= $totalPaket ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<style>
    /* Reset dan layout utama */
    body {
        background-color: #f8f9fa;
        overflow-x: hidden;
    }

    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        min-height: calc(100vh - 80px);
        padding-top: 80px;
        transition: all 0.3s ease;
    }

    .sidebar.collapsed~.main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    /* Stat card styling */
    .stat-card {
        border: none;
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .stat-card .stat-icon {
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1);
    }

    /* Table styling */
    .avatar-sm {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        color: #6c757d;
        background-color: #f8f9fa;
    }

    .log-message {
        cursor: help;
    }

    /* Card header styling */
    .card-header {
        border-radius: 12px 12px 0 0 !important;
    }

    /* List group styling */
    .list-group-item {
        border: none;
        padding: 0.75rem 0;
        background: transparent;
    }

    /* Badge styling */
    .badge.rounded-circle {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Button styling */
    .btn-light {
        transition: all 0.2s ease;
    }

    .btn-light:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        transform: translateY(-1px);
    }

    /* Progress bar styling */
    .progress {
        border-radius: 4px;
    }

    /* Ikon styling */
    .fas, .fab {
        transition: transform 0.2s ease;
    }

    .btn:hover .fas,
    .btn:hover .fab {
        transform: scale(1.1);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 15px;
            padding-top: 100px;
        }

        .sidebar.collapsed~.main-content {
            margin-left: 0 !important;
            width: 100% !important;
        }

        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
    }

    @media (max-width: 576px) {
        .main-content {
            padding-top: 120px;
        }

        .stat-card .card-body {
            padding: 1rem;
        }

        .stat-card h2 {
            font-size: 1.5rem;
        }

        .stat-icon {
            font-size: 1.5rem !important;
        }
    }

    /* Tambahan untuk memastikan footer tidak nabrak */
    .main-content {
        padding-bottom: 2rem;
    }
</style>

<?php include '../../partials/footer.php'; ?>