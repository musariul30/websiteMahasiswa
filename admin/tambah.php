<?php
include "../config/koneksi.php";

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO mahasiswa 
        (nim, nama, alamat, tanggal_lahir, gender, usia) 
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $_POST['nim'],
        $_POST['nama'],
        $_POST['alamat'],
        $_POST['tanggal_lahir'],
        $_POST['gender'],
        $_POST['usia']
    );

    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include "../style/navbar.php"; ?>

    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card shadow border-0">

                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">➕ Tambah Data Mahasiswa</h5>
                    </div>

                    <div class="card-body">

                        <form method="POST">

                            <!-- NIM -->
                            <div class="mb-3">
                                <label class="form-label">NIM</label>
                                <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
                            </div>

                            <!-- Nama -->
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama"
                                    required>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3"
                                    placeholder="Masukkan Alamat"></textarea>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control">
                            </div>

                            <!-- Gender -->
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">-- Pilih Gender --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <!-- Usia -->
                            <div class="mb-3">
                                <label class="form-label">Usia</label>
                                <input type="number" name="usia" class="form-control" placeholder="Masukkan Usia"
                                    min="0">
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">
                                    ← Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Simpan Data
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>