<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

// 🔹 Ambil semua data keberangkatan
$q = mysqli_query($conn, "
  SELECT k.*, p.nama AS nama_paket
  FROM keberangkatan k
  JOIN paket p ON k.paket_id = p.id
  ORDER BY k.created_at DESC
");
?>
<!-- DATATABLES CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DATATABLES JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- DATATABLES BUTTONS -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- PDF MAKE (untuk export PDF) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<!-- JSZIP (untuk export Excel) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<div class="main-content">
    <div class="container mt-4 pt-3">

        <!-- 🔹 Card Judul -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-body d-flex justify-content-between align-items-center py-3 px-4">
                <h4 class="fw-bold text-primary mb-0">🛫 Data Keberangkatan</h4>
                <a href="create.php" class="btn btn-primary">
                    <i class="fa fa-plus me-1"></i> Tambah Keberangkatan
                </a>
            </div>
        </div>

        <!-- 🔹 Card Tabel -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table id="tabel-keberangkatan" class="table table-bordered table-hover align-middle text-center mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Paket</th>
                                <th width="15%">Tanggal Berangkat</th>
                                <th width="15%">Tanggal Pulang</th>
                                <th width="10%">Status</th>
                                <th width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php if (mysqli_num_rows($q) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($q)): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row['nama_paket']) ?></td>
                                        <td><?= date('d M Y', strtotime($row['departure_date'])) ?></td>
                                        <td><?= date('d M Y', strtotime($row['return_date'])) ?></td>
                                        <td>
                                            <span class="badge 
                                                <?= $row['status'] == 'aktif' ? 'bg-success' : ($row['status'] == 'selesai' ? 'bg-secondary' : 'bg-warning text-dark') ?>">
                                                <?= ucfirst($row['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">
                                                <i class="fa fa-eye me-1"></i> Detail
                                            </a>
                                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit me-1"></i> Edit
                                            </a>
                                            <a href="delete.php?id=<?= $row['id'] ?>"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash me-1"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        Belum ada data keberangkatan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tabel-keberangkatan').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            pageLength: 10,
            ordering: true,
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-secondary btn-sm'
                },
                {
                    extend: 'excel',
                    title: 'Data Keberangkatan',
                    className: 'btn btn-success btn-sm'
                },
                {
                    extend: 'pdf',
                    title: 'Data Keberangkatan',
                    className: 'btn btn-danger btn-sm'
                },
                {
                    extend: 'print',
                    title: 'Data Keberangkatan',
                    className: 'btn btn-info btn-sm'
                }
            ]
        }).buttons().container().appendTo('#tabel-keberangkatan_wrapper .col-md-6:eq(0)');
    });
</script>


<style>
    /* 🔹 Sejajarkan konten dengan sidebar & navbar */
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        margin-top: 75px;
        transition: all 0.3s ease;
    }

    /* 🔹 Responsif saat sidebar collapse */
    .sidebar.collapsed~.main-content {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    /* 🔹 Header tabel */
    table th {
        background-color: #1a1a1a !important;
        color: #fff !important;
        vertical-align: middle !important;
    }

    /* 🔹 Isi tabel */
    table td {
        vertical-align: middle !important;
    }

    /* 🔹 Tampilan card */
    .card {
        background-color: #ffffff;
        border-radius: 10px;
        transition: 0.3s;
    }

    .card:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    /* 🔹 Tombol */
    .btn {
        border-radius: 6px;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn:hover {
        opacity: 0.9;
    }

    /* 🔹 Badge status */
    .badge {
        font-size: 0.85rem;
        padding: 6px 10px;
        border-radius: 6px;
    }
</style>

<?php include '../../partials/footer.php'; ?>