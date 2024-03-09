<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Memeriksa apakah pemilih sudah melakukan pemilihan sebelumnya
    if (isset($_SESSION['voted'])) {
        echo '<p style="color: red; font-size: 36px; font-family: Arial, sans-serif;">Anda tidak dapat memilih 2x, anda telah melakukan pemilihan sebelumnya</p>';
        echo '<script>setTimeout(function(){ window.location.href = "logout.php"; }, 3000);</script>';
        exit();
    }

    $candidateId = $_POST['candidate'];

    // Mendapatkan data pemilih yang sedang login
    $voterId = $_SESSION['user_id'];

    // Periksa apakah pemilih telah memilih calon tersebut sebelumnya
    $queryCheckVoter = mysqli_query($conn, "SELECT * FROM users WHERE id = $voterId");
    $voter = mysqli_fetch_assoc($queryCheckVoter);
    if (!$voter) {
        echo "Data pemilih tidak ditemukan.";
        echo '<script>setTimeout(function(){ window.location.href = "logout.php"; }, 3000);</script>';
        exit();
    }

    // Simpan pemilihan ke database
    $queryInsertVote = mysqli_query($conn, "INSERT INTO votes (voter_id, candidate_id) VALUES ($voterId, $candidateId)");

    if ($queryInsertVote) {
        // Set session untuk menandai pemilih sudah melakukan pemilihan
        $_SESSION['voted'] = true;

        // Redirect ke halaman utama setelah pemilihan selesai
        echo '<script>alert("Pemilihan berhasil!");</script>';
echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center;">';
echo '<p style="color: red; font-size: 47px; font-family: Arial, sans-serif;">Terima kasih sudah memberikan hak suara Anda</p>';
echo '</div>';

        echo '<script>setTimeout(function(){ window.location.href = "index.php"; }, 5000);</script>';
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan pemilihan.";
        echo '<script>setTimeout(function(){ window.location.href = "logout.php"; }, 3000);</script>';
        exit();
    }
}

mysqli_close($conn);
?>
