<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $vision = $_POST['vision'];
    $mission = $_POST['mission'];
    $motto = $_POST['motto'];
    $photoName = $_FILES['photo']['name'];
    $photoTmpName = $_FILES['photo']['tmp_name'];

    // Memeriksa apakah ada foto yang diunggah
    if (!empty($photoName)) {
        // Mendapatkan ekstensi file foto
        $photoExtension = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));

        // Memeriksa tipe file foto (hanya file gambar yang diizinkan)
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        if (in_array($photoExtension, $allowedExtensions)) {
            // Menentukan lokasi tujuan penyimpanan foto
            $photoPath = 'photos/' . $photoName;

            // Memindahkan foto ke lokasi yang diinginkan
            move_uploaded_file($photoTmpName, $photoPath);

            // Update data kandidat termasuk foto di database berdasarkan ID
            $query = mysqli_query($conn, "UPDATE candidates SET name = '$name', vision = '$vision', mission = '$mission', motto = '$motto', photo = '$photoName' WHERE id = $id");
        } else {
            // Tipe file foto tidak valid
            echo "Hanya file gambar (.jpg, .jpeg, .png) yang diizinkan.";
            exit();
        }
    } else {
        // Update data kandidat tanpa foto di database berdasarkan ID
        $query = mysqli_query($conn, "UPDATE candidates SET name = '$name', vision = '$vision', mission = '$mission', motto = '$motto' WHERE id = $id");
    }

    if ($query) {
        // Redirect ke halaman admin setelah berhasil mengedit kandidat
        header("Location: admin.php");
        exit();
    } else {
        // Tampilkan pesan kesalahan jika gagal mengedit kandidat
        echo "Gagal mengedit kandidat. Silakan coba lagi.";
    }
}

mysqli_close($conn);
?>
