<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        // Set session untuk user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect ke halaman utama setelah login berhasil
        header("Location: index.php");
        exit();
    } else {
        // Gagal login
        echo "Username atau password salah.";
    }
}

mysqli_close($conn);
?>
