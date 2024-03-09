<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];

    // Proses import data pemilih dari file Excel
    // ...

    // Redirect ke halaman admin setelah berhasil mengimport data pemilih
    header("Location: admin.php");
    exit();
}

mysqli_close($conn);
?>
