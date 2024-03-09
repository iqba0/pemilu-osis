<?php
include 'config.php';

// Memeriksa apakah metode permintaan adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari formulir
    $id = $_POST['id'];
    $fullName = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Melakukan validasi data (sesuaikan dengan kebutuhan Anda)

    // Melakukan pembaruan data pemilih di database
    $query = mysqli_query($conn, "UPDATE users SET full_name = '$fullName', username = '$username', password = '$password' WHERE id = $id");

    if ($query) {
        // Pembaruan sukses, redirect ke halaman admin
        header("Location: admin.php");
        exit();
    } else {
        // Pembaruan gagal, tampilkan pesan error
        echo "Gagal memperbarui data pemilih.";
    }
} else {
    // Jika metode permintaan bukan POST, redirect ke halaman admin
    header("Location: admin.php");
    exit();
}

mysqli_close($conn);
?>
