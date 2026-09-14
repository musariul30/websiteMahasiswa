<?php
include "../config/koneksi.php";

/* ===============================
   QUERY DATA MAHASISWA (DESC NIM)
=================================*/
$stmt = mysqli_prepare($conn, "SELECT * FROM mahasiswa ORDER BY nim DESC");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

/* ===============================
   HITUNG TOTAL MAHASISWA
=================================*/
$totalQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa");
$totalData = mysqli_fetch_assoc($totalQuery)['total'];

/* ===============================
   STATISTIK GENDER
=================================*/
$genderQuery = mysqli_query($conn, "
    SELECT gender, COUNT(*) as jumlah 
    FROM mahasiswa 
    GROUP BY gender
");

$genderData = ['L' => 0, 'P' => 0];
while ($row = mysqli_fetch_assoc($genderQuery)) {
    $genderData[$row['gender']] = $row['jumlah'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME - Data Mahasiswa</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Table -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.1/dist/bootstrap-table.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Home page styles -->
    <link rel="stylesheet" href="../style/home.css">
</head>

<body>

    <?php include "../style/navbar.php"; ?>

    <div class="container py-4">

        <!-- Hero -->
        <div
            class="home-hero d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h1><i class="fas fa-graduation-cap me-2"></i>Data Mahasiswa</h1>
                <p>Ringkasan statistik dan daftar data mahasiswa.</p>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stat-card total card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <div class="stat-label">Total Mahasiswa</div>
                            <div class="stat-value"><?= $totalData ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card laki card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="fas fa-mars"></i>
                        </div>
                        <div>
                            <div class="stat-label">Laki-laki</div>
                            <div class="stat-value"><?= $genderData['L'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card perempuan card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="fas fa-venus"></i>
                        </div>
                        <div>
                            <div class="stat-label">Perempuan</div>
                            <div class="stat-value"><?= $genderData['P'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel -->
        <div class="table-card card">
            <div class="card-header">
                <i class="fas fa-table me-2"></i>Daftar Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table table-hover align-middle" data-toggle="table" data-search="true"
                    data-pagination="true" data-page-size="5" data-show-columns="true" data-show-refresh="true"
                    data-sortable="true" data-pagination-pre-text="Sebelumnya" data-pagination-next-text="Berikutnya">

                    <thead>
                        <tr>
                            <th data-field="nim" data-sortable="true">NIM</th>
                            <th data-field="nama" data-sortable="true">Nama</th>
                            <th data-field="alamat">Alamat</th>
                            <th data-field="tanggal_lahir" data-sortable="true">Tanggal Lahir</th>
                            <th data-field="gender" data-sortable="true">Gender</th>
                            <th data-field="usia" data-sortable="true">Usia</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><span class="fw-medium"><?= htmlspecialchars($row['nim']) ?></span></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td class="text-muted"><?= htmlspecialchars($row['alamat']) ?></td>
                            <td><?= $row['tanggal_lahir'] ?></td>
                            <td>
                                <span class="badge <?= $row['gender'] == 'L' ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $row['gender'] == 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                </span>
                            </td>
                            <td><?= $row['usia'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>

    <!-- JS Section -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>

</body>

</html>

<?php include "../style/footer.php"; ?>