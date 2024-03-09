<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Mendapatkan ID pemilih dari parameter URL
    if (isset($_GET['id'])) {
        $voterId = $_GET['id'];

        // Periksa apakah pemilih memiliki keterkaitan dengan data lain di tabel votes
        $queryCheck = mysqli_query($conn, "SELECT * FROM votes WHERE voter_id = $voterId");
        $rowCount = mysqli_num_rows($queryCheck);

        if ($rowCount > 0) {
            // Jika pemilih memiliki keterkaitan dengan data lain di tabel votes, tampilkan pesan kesalahan
            echo "Data pemilih tidak dapat dihapus karena terkait dengan data lain.";
        } else {
            // Hapus data pemilih dari database berdasarkan ID
            $query = mysqli_query($conn, "DELETE FROM users WHERE id = $voterId");

            if ($query) {
                // Redirect ke halaman admin.php setelah berhasil menghapus data pemilih
                header("Location: admin.php");
                exit();
            } else {
                // Tampilkan pesan kesalahan jika gagal menghapus data pemilih
                echo "Gagal menghapus data pemilih. Silakan coba lagi.";
            }
        }
    } else {
        // Jika parameter ID pemilih tidak ditemukan, tampilkan pesan kesalahan
        echo "ID pemilih tidak ditemukan.";
    }
}
?>
