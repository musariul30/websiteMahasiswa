<?php
include "../config/koneksi.php";

$nim = $_GET['nim'];

// Ambil data berdasarkan NIM
$stmt = mysqli_prepare($conn, "SELECT * FROM mahasiswa WHERE nim=?");
mysqli_stmt_bind_param($stmt, "s", $nim);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

// Jika tombol update ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE mahasiswa 
         SET nama=?, alamat=?, tanggal_lahir=?, gender=?, usia=? 
         WHERE nim=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssssis",
        $_POST['nama'],
        $_POST['alamat'],
        $_POST['tanggal_lahir'],
        $_POST['gender'],
        $_POST['usia'],
        $nim
    );

    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include "../style/navbar.php"; ?>

    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card shadow border-0">

                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">✏ Edit Data Mahasiswa</h5>
                    </div>

                    <div class="card-body">

                        <form method="POST">

                            <!-- NIM readonly -->
                            <div class="mb-3">
                                <label class="form-label">NIM</label>
                                <input type="text" class="form-control bg-light"
                                    value="<?= htmlspecialchars($data['nim']) ?>" readonly>
                                <small class="text-muted">
                                    NIM tidak dapat diubah
                                </small>
                            </div>

                            <!-- Nama -->
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control"
                                    value="<?= htmlspecialchars($data['nama']) ?>" required>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control"
                                    rows="3"><?= htmlspecialchars($data['alamat']) ?></textarea>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control"
                                    value="<?= $data['tanggal_lahir'] ?>">
                            </div>

                            <!-- Gender -->
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="L" <?= $data['gender'] == 'L' ? 'selected' : '' ?>>
                                        Laki-laki
                                    </option>
                                    <option value="P" <?= $data['gender'] == 'P' ? 'selected' : '' ?>>
                                        Perempuan
                                    </option>
                                </select>
                            </div>

                            <!-- Usia -->
                            <div class="mb-3">
                                <label class="form-label">Usia</label>
                                <input type="number" name="usia" class="form-control" value="<?= $data['usia'] ?>">
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">
                                    ← Kembali
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    Update Data
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