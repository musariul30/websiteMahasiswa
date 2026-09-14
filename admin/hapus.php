<?php
include "../config/koneksi.php";

$nim = $_GET['nim'];

$stmt = mysqli_prepare($conn, "DELETE FROM mahasiswa WHERE nim=?");
mysqli_stmt_bind_param($stmt, "s", $nim);
mysqli_stmt_execute($stmt);

header("Location: index.php");
exit;
