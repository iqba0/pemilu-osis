<?php
include 'config.php';

// Fungsi untuk mendapatkan data pemilih dari database
function getDataPemilih()
{
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM users WHERE role='user'");
    $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
    return $data;
}

// Fungsi untuk menampilkan notifikasi JavaScript
function showSuccessNotification()
{
    echo '<script>alert("Import berhasil!");</script>';
}

// Fungsi untuk menampilkan data pemilih
function showDataPemilih($data)
{
    echo '<h2>Data Pemilih</h2>';
    echo '<table>';
    echo '<thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
        </thead>';
    echo '<tbody>';
    foreach ($data as $pemilih) {
        echo '<tr>';
        echo '<td>' . $pemilih['full_name'] . '</td>';
        echo '<td>' . $pemilih['username'] . '</td>';
        echo '<td>' . $pemilih['password'] . '</td>';
        echo '<td>
                <a href="edit_voter.php?id=' . $pemilih['id'] . '">Edit</a>
                <a href="delete_voter.php?id=' . $pemilih['id'] . '">Hapus</a>
            </td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Memeriksa apakah file Excel diunggah
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Mendapatkan informasi file yang diunggah
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];

        // Memeriksa tipe file (hanya file Excel yang diizinkan)
        $allowedExtensions = ['xlsx', 'xls'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (in_array($fileExtension, $allowedExtensions)) {
            // Memindahkan file ke lokasi yang diinginkan
            $uploadPath = 'uploads/' . $fileName;
            move_uploaded_file($fileTmpName, $uploadPath);

            // Mengimpor data dari file Excel ke tabel users
            // ...

            // Menampilkan notifikasi sukses
            showSuccessNotification();
        } else {
            // Tipe file tidak valid
            echo '<script>alert("Hanya file Excel (.xlsx, .xls) yang diizinkan.");</script>';
        }
    } else {
        // Tidak ada file yang diunggah
        echo '<script>alert("Silakan pilih file untuk diunggah.");</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Import Data Pemilih</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Import Data Pemilih</h1>

        <form action="import_voter.php" method="POST" enctype="multipart/form-data">
            <label for="file">Upload File Excel:</label>
            <input type="file" name="file" id="file" required>

            <button type="submit">Import</button>
        </form>
        <h2>Input Manual</h2>
        <form action="process_input_manual.php" method="POST">
            <label for="fullname">Nama Lengkap:</label>
            <input type="text" name="fullname" id="fullname" required>

            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Tambah</button>
        </form>
        <?php
        // Mengambil data pemilih dari database
        $dataPemilih = getDataPemilih();

        // Menampilkan data pemilih
        showDataPemilih($dataPemilih);
        ?>
    </div>
</body>
</html>
