<?php
session_start();
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

// Ambil semua log terbaru
$qLogs = mysqli_query($conn, "
    SELECT a.*, u.full_name
    FROM audit_logs a
    LEFT JOIN users u ON u.id = a.user_id
    ORDER BY a.created_at DESC
");
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

        <!-- HEADER CARD -->
        <div class="card shadow-sm border-0 rounded-3 mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="fw-semibold mb-0">
                    <i class="fa fa-history me-2"></i> Audit Log Aktivitas
                </h5>
            </div>
        </div>

        <!-- TABLE CARD -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table id="auditTable" class="table table-striped table-bordered text-center align-middle w-100">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Waktu</th>
                                <th>Nama Pengguna</th>
                                <th>Aksi</th>
                                <th>Objek</th>
                                <th style="width: 90px;">ID Objek</th>
                                <th style="width: 300px;">Pesan</th>
                                <th style="width: 80px;">Detail</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;
                            while ($row = mysqli_fetch_assoc($qLogs)) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('d M Y H:i:s', strtotime($row['created_at'])) ?></td>
                                    <td><?= htmlspecialchars($row['full_name'] ?? 'Guest') ?></td>
                                    <td><span class="badge bg-primary"><?= strtoupper($row['action']) ?></span></td>
                                    <td><?= htmlspecialchars($row['object_type']) ?></td>
                                    <td><?= htmlspecialchars($row['object_id']) ?></td>
                                    <td class="text-start"><?= htmlspecialchars(substr($row['message'], 0, 80)) ?>...</td>
                                    <td>
                                        <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">
                                            Lihat
                                        </a>
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

<style>
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        margin-top: 80px;
    }

    table th {
        font-size: 13px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .badge {
        font-size: 11px;
        padding: 6px 10px;
    }
</style>

<script>
    $(document).ready(function() {
        $('#auditTable').DataTable({
            responsive: true,
            autoWidth: false,

            dom: '<"row mb-3"' +
                '<"col-md-6"l>' +
                '<"col-md-6 text-end"B>' +
                '>' +
                'rt' +
                '<"row mt-3"' +
                '<"col-md-6"i>' +
                '<"col-md-6"p>' +
                '>',

            buttons: [{
                    extend: 'excelHtml5',
                    className: 'btn btn-success btn-sm',
                    title: 'Audit Log Aktivitas',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger btn-sm',
                    title: 'Audit Log Aktivitas',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary btn-sm',
                    title: 'Audit Log Aktivitas'
                }
            ],

            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            },

            pageLength: 10
        });
    });
</script>

<?php include '../../partials/footer.php'; ?>