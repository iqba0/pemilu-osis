<?php
include 'config.php';

if (isset($_GET['id'])) {
    $candidateId = $_GET['id'];

    // Hapus data kandidat dari database berdasarkan ID
    $deleteQuery = mysqli_query($conn, "DELETE FROM candidates WHERE id = '$candidateId'");

    if ($deleteQuery) {
        // Redirect ke halaman admin setelah berhasil menghapus kandidat
        header("Location: admin.php");
        exit();
    } else {
        echo "Gagal menghapus kandidat.";
    }
} else {
    echo "ID kandidat tidak ditemukan.";
}

mysqli_close($conn);
?>
