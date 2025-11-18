<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$q = mysqli_query($conn, "
    SELECT u.*, r.role_name 
    FROM users u
    LEFT JOIN roles r ON r.id = u.role_id
    ORDER BY u.created_at DESC
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
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


<div class="main-content">
    <div class="container py-4">

        <div class="card shadow-sm border-0 rounded-3 mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="fw-semibold mb-0">
                    <i class="fa fa-user-shield me-2"></i> Data Users
                </h5>

            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table id="usersTable" class="table table-striped table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;
                            while ($row = mysqli_fetch_assoc($q)) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['username']) ?></td>
                                    <td><?= htmlspecialchars($row['role_name']) ?></td>

                                    <td>
                                        <?= $row['is_active']
                                            ? '<span class="badge bg-success">Aktif</span>'
                                            : '<span class="badge bg-danger">Nonaktif</span>' ?>
                                    </td>

                                    <td>
                                        <a href="../../actions/data users/delete.php?id=<?= $row['id'] ?>"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash me-1"></i> Hapus
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
    }
</style>

<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            responsive: true,
            dom: '<"row mb-3"<"col-md-6"l><"col-md-6 text-end"B>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>',

            buttons: [{
                    extend: 'excelHtml5',
                    className: 'btn btn-success btn-sm',
                    title: 'Data Users',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger btn-sm',
                    title: 'Data Users',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary btn-sm',
                    title: 'Data Users'
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