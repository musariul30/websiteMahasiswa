<?php
include "../config/koneksi.php";

// Ambil semua data mahasiswa (DESC berdasarkan NIM)
$stmt = mysqli_prepare($conn, "SELECT * FROM mahasiswa ORDER BY nim DESC");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Pesan notifikasi (optional)
$pesan = "";
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "tambah") {
        $pesan = "Data berhasil ditambahkan!";
    } elseif ($_GET['msg'] == "edit") {
        $pesan = "Data berhasil diperbarui!";
    } elseif ($_GET['msg'] == "hapus") {
        $pesan = "Data berhasil dihapus!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - Kelola Data Mahasiswa</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Table -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.1/dist/bootstrap-table.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Admin page styles -->
    <link rel="stylesheet" href="../style/admin.css">
</head>

<body>

    <?php include "../style/navbar.php"; ?>

    <div class="container py-4">

        <!-- Hero -->
        <div class="admin-hero d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1><i class="fas fa-cog me-2"></i>Kelola Data Mahasiswa</h1>
                <p>Tambah, edit, atau hapus data mahasiswa dari daftar berikut.</p>
            </div>
        </div>

        <!-- Alert Notifikasi -->
        <?php if ($pesan != "") : ?>
        <div class="alert alert-success alert-dismissible fade show admin-alert" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= $pesan ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="table-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-table me-2"></i>Daftar Mahasiswa</span>
                <a href="tambah.php" class="btn btn-tambah btn-sm">
                    <i class="fas fa-plus me-1"></i>Tambah Data
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" data-toggle="table" data-search="true"
                        data-pagination="true" data-page-size="5" data-show-columns="true" data-show-refresh="true"
                        data-sortable="true" data-pagination-pre-text="Sebelumnya"
                        data-pagination-next-text="Berikutnya">

                        <thead>
                            <tr>
                                <th data-field="nim" data-sortable="true">NIM</th>
                                <th data-field="nama" data-sortable="true">Nama</th>
                                <th data-field="gender" data-sortable="true">Gender</th>
                                <th data-field="aksi">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><span class="fw-medium"><?= htmlspecialchars($row['nim']) ?></span></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td>
                                    <span class="badge <?= $row['gender'] == 'L' ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $row['gender'] == 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="edit.php?nim=<?= $row['nim'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#hapusModal" data-nim="<?= $row['nim'] ?>"
                                        data-nama="<?= htmlspecialchars($row['nama']) ?>">Hapus</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada data mahasiswa.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade admin-modal" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="hapusModalLabel"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus Data</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Apakah Anda yakin ingin menghapus data mahasiswa dengan nama:</p>
                    <p class="fw-bold text-danger mb-2" id="namaMahasiswa"></p>
                    <p class="text-muted small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="tombolYakin" class="btn btn-danger">Yakin, Hapus Data</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <script>
    // Event delegation: modal hapus tetap jalan setelah tabel di-render ulang oleh bootstrap-table (search/pagination)
    $(document).on('click', '[data-bs-target="#hapusModal"]', function() {
        var nim = $(this).data('nim');
        var nama = $(this).data('nama');
        $('#namaMahasiswa').text(nama);
        $('#tombolYakin').attr('href', 'hapus.php?nim=' + nim);
    });
    </script>
</body>

</html>

<?php include "../style/footer.php"; ?>