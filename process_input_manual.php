<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = addslashes($_POST['fullname']);
    $username = addslashes($_POST['username']);
    $password = $_POST['password'];

    // Memasukkan data pemilih baru ke dalam tabel voters
    $query = mysqli_query($conn, "INSERT INTO users (full_name, username, password, role) VALUES ('$fullname', '$username', '$password', 'user')");


    if ($query) {
        // Redirect ke halaman import_voter.php setelah berhasil menambahkan data pemilih
        header("Location: import_voters.php");
        exit();
    } else {
        // Tampilkan pesan kesalahan jika gagal menambahkan data pemilih
        echo "Gagal menambahkan data pemilih. Silakan coba lagi.";
    }
}
?>
