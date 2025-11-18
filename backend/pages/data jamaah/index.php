<?php
session_start();
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';
include '../../../config/connection.php';

// Ambil semua data jamaah
$q = mysqli_query($conn, "SELECT * FROM jamaah ORDER BY created_at DESC");
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<div class="main-content">
    <div class="container py-4">

        <!-- Header Card -->
        <div class="card shadow-sm border-0 rounded-3 mb-3">
            <div class="card-body d-flex justify-content-between align-items-center py-3 px-4">
                <h5 class="mb-0 fw-semibold">
                    <i class="fa fa-users me-2"></i> Data Jamaah
                </h5>
                <a href="create.php" class="btn btn-primary btn-sm px-3 fw-semibold shadow-sm">
                    <i class="fa fa-plus me-2"></i> Tambah Jamaah
                </a>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <div class="table-responsive">

                    <table id="jamaahTable" class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;
                            while ($d = mysqli_fetch_assoc($q)): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($d['nama']) ?></td>
                                    <td><?= htmlspecialchars($d['nik']) ?></td>
                                    <td><?= htmlspecialchars($d['phone']) ?></td>
                                    <td><?= htmlspecialchars($d['alamat']) ?></td>

                                    <td>
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <a href="detail.php?id=<?= $d['id'] ?>" class="btn btn-info btn-sm">
                                                <i class="fa fa-eye me-1"></i> Detail
                                            </a>

                                            <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm text-white">
                                                <i class="fa fa-edit me-1"></i> Edit
                                            </a>

                                            <a href="../../actions/data jamaah/delete.php?id=<?= $d['id'] ?>"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash me-1"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- CSS -->
<style>
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        margin-top: 80px;
    }

    table th {
        background-color: #1a1a1a !important;
        color: white !important;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-size: 13px;
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
        transition: .2s;
    }

    .btn:hover {
        transform: scale(1.05);
        opacity: .9;
    }
</style>

<!-- DataTable Init -->
<script>
    $(document).ready(function() {
        var table = $('#jamaahTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            pageLength: 10,
            ordering: true,

            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-secondary btn-sm',
                    title: 'Data Jamaah'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success btn-sm',
                    title: 'Data Jamaah'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: 'Data Jamaah',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-info btn-sm',
                    title: 'Data Jamaah'
                }
            ]
        });

        // Pindahkan tombol ke kiri atas
        table.buttons().container()
            .appendTo('#jamaahTable_wrapper .col-md-6:eq(0)');
    });
</script>

<?php include '../../partials/footer.php'; ?>