<?php
$host = "localhost";
$username = "rplsmksumatra40m_osis"; // Ganti dengan username MySQL Anda
$password = "smkS40"; // Ganti dengan password MySQL Anda
$database = "rplsmksumatra40m_osis"; // Ganti dengan nama database yang Anda gunakan

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
