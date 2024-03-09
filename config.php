<?php
$host = "localhost";
$username = "rplsmksumatra40m_osis"; // Username MySQL Anda
$password = "smkS40"; // Password MySQL
$database = "rplsmksumatra40m_osis"; // Nama database

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
