<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $vision = $_POST['vision'];
    $mission = $_POST['mission'];
    $motto = $_POST['motto'];
    $photoName = $_FILES['photo']['name'];
    $photoTmpName = $_FILES['photo']['tmp_name'];

    // Pindahkan foto ke folder yang diinginkan
    $photoPath = 'photos/' . strtolower(pathinfo($photoName, PATHINFO_FILENAME)) . '.' . pathinfo($photoName, PATHINFO_EXTENSION);
    move_uploaded_file($photoTmpName, $photoPath);

    // Simpan data kandidat ke database
    $insertQuery = mysqli_query($conn, "INSERT INTO candidates (name, vision, mission, motto, photo) VALUES ('$name', '$vision', '$mission', '$motto', '$photoPath')");

    if ($insertQuery) {
        // Redirect ke halaman admin setelah berhasil menambahkan kandidat
        header("Location: admin.php");
        exit();
    } else {
        // Gagal menambahkan kandidat
        $errorMessage = "Terjadi kesalahan dalam menambahkan kandidat.";
    }
}

mysqli_close($conn);
?>
