<?php
session_start();
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';
include '../../../config/connection.php';

$id = $_GET['id'];
$q = $conn->prepare("SELECT * FROM paket WHERE id = ?");
$q->bind_param("i", $id);
$q->execute();
$data = $q->get_result()->fetch_assoc();
?>

<div class="main-content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Paket</h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="../../actions/data paket/update.php" method="POST">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

                            <div class="form-group mb-3">
                                <label><strong>Kode</strong></label>
                                <input type="text" name="kode" value="<?= htmlspecialchars($data['kode']) ?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label><strong>Nama Paket</strong></label>
                                <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label><strong>Jenis</strong></label>
                                <select name="jenis" class="form-control" required>
                                    <option value="haji" <?= $data['jenis'] == 'haji' ? 'selected' : '' ?>>Haji</option>
                                    <option value="umroh" <?= $data['jenis'] == 'umroh' ? 'selected' : '' ?>>Umroh</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label><strong>Durasi (hari)</strong></label>
                                <input type="number" name="durasi_days" value="<?= htmlspecialchars($data['durasi_days']) ?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label><strong>Harga</strong></label>
                                <input type="text" name="harga" value="<?= htmlspecialchars($data['harga']) ?>" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label><strong>Deskripsi</strong></label>
                                <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                            </div>

                            <div class="mt-4 d-flex justify-content-end gap-2">
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Update
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
    /* 🔹 Sejajar sidebar + navbar */
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        margin-top: 80px;
        transition: all 0.3s ease;
    }

    .sidebar.collapsed~.main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    .card {
        background-color: #fff;
    }

    .card-header {
        padding: 15px 20px;
        font-weight: 600;
    }

    label {
        color: #333;
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
    }
</style>

<?php include '../../partials/footer.php'; ?>