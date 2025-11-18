<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

// Ambil semua data pembayaran
$query = "
    SELECT pay.*, j.nama AS nama_jamaah, r.id AS reg_id
    FROM payments pay
    JOIN registrations r ON r.id = pay.registration_id
    JOIN jamaah j ON j.id = r.jamaah_id
    ORDER BY pay.created_at DESC
";
$result = mysqli_query($conn, $query);
?>

<div class="main-content">
    <div class="container py-4">

        <!-- Wrapper Card -->
        <div class="card shadow-sm border-0 rounded-3">
            <!-- Header -->
            <div class="card-body d-flex justify-content-between align-items-center py-3 px-4">
                <h5 class="mb-0 fw-semibold">
                    <i class="fa fa-money-bill-wave me-2"></i> Konfirmasi Pembayaran Jamaah
                </h5>
            </div>
        </div>
        <!-- DataTable CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

        <!-- jQuery (jika belum ada) -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- DataTable JS -->
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

        <!-- Body -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table id="paymentTable" class="table table-bordered table-hover mb-0 align-middle text-center">

                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Jamaah</th>
                                <th width="15%">Jumlah</th>
                                <th width="10%">Metode</th>
                                <th width="10%">Status</th>
                                <th width="15%">Tanggal</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (mysqli_num_rows($result) > 0):
                                while ($p = mysqli_fetch_assoc($result)):
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($p['nama_jamaah']); ?></td>
                                        <td><strong>Rp <?= number_format($p['amount'], 0, ',', '.'); ?></strong></td>
                                        <td><?= ucfirst(htmlspecialchars($p['method'])); ?></td>
                                        <td>
                                            <?php if ($p['status'] == 'pending'): ?>
                                                <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                            <?php elseif ($p['status'] == 'confirmed'): ?>
                                                <span class="badge bg-success px-3 py-2">Confirmed</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger px-3 py-2">Rejected</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d M Y', strtotime($p['payment_date'])); ?></td>
                                        <td>
                                            <?php if ($p['status'] == 'pending'): ?>
                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                    <a href="confrim.php?id=<?= $p['id']; ?>&status=confirmed"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fa fa-check me-1"></i> Konfirmasi
                                                    </a>
                                                    <a href="confrim.php?id=<?= $p['id']; ?>&status=rejected"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fa fa-times me-1"></i> Tolak
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada aksi</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile;
                            else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="fa fa-info-circle me-2"></i> Belum ada data pembayaran
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
        var table = $('#paymentTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            pageLength: 10,
            ordering: true,

            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-secondary btn-sm',
                    title: 'Data Pembayaran Jamaah'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success btn-sm',
                    title: 'Data Pembayaran Jamaah'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: 'Data Pembayaran Jamaah'
                },
                {
                    extend: 'print',
                    className: 'btn btn-info btn-sm',
                    title: 'Data Pembayaran Jamaah'
                }
            ]
        });

        table.buttons().container()
            .appendTo('#paymentTable_wrapper .col-md-6:eq(0)');
    });
</script>



<!-- Style -->
<style>
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

    .card-header h5 {
        font-size: 1.1rem;
        letter-spacing: 0.3px;
    }

    table th {
        background-color: #1a1a1a !important;
        color: #fff !important;
        vertical-align: middle !important;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
    }

    table td {
        vertical-align: middle !important;
        font-size: 14px;
    }

    .badge {
        border-radius: 6px;
        font-weight: 600;
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .btn:hover {
        transform: scale(1.05);
        opacity: 0.9;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .card {
        background: #ffffff;
    }
</style>

<?php include '../../partials/footer.php'; ?>