<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$qPaket = mysqli_query($conn, "SELECT * FROM paket ORDER BY nama ASC");
?>

<div class="main-content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Keberangkatan</h5>
                    </div>

                    <div class="card-body p-4" style="background-color: #f9fafc;">
                        <form action="../../actions/data keberangkatan/store.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Paket</label>
                                <select name="paket_id" class="form-control" required>
                                    <option value="">-- Pilih Paket --</option>
                                    <?php while ($p = mysqli_fetch_assoc($qPaket)) : ?>
                                        <option value="<?= $p['id'] ?>">
                                            <?= htmlspecialchars($p['nama']) ?> (<?= strtoupper($p['jenis']) ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Tanggal Berangkat</label>
                                    <input type="date" name="departure_date" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Tanggal Pulang</label>
                                    <input type="date" name="return_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kuota Jamaah</label>
                                <input type="number" name="quota" class="form-control" placeholder="Masukkan jumlah kuota" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status Keberangkatan</label>
                                <select name="status" class="form-control">
                                    <option value="open">Open</option>
                                    <option value="closed">Closed</option>
                                    <option value="canceled">Canceled</option>
                                </select>
                            </div>

                            <div class="mt-4 d-flex justify-content-end gap-2">
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="fa fa-times me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* 🔹 Posisi pas sesuai layout admin */
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        margin-top: 80px;
        transition: all 0.3s ease;
    }

    /* 🔹 Jika sidebar di-collapse */
    .sidebar.collapsed~.main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    .card-header {
        padding: 15px 20px;
        font-weight: 600;
    }

    .form-label {
        color: #333;
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
    }

    .card-body {
        background-color: #f9fafc;
    }
</style>

<?php include '../../partials/footer.php'; ?>