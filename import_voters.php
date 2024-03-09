<?php
include 'config.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

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
    echo '<div class="search-box">';
    echo '<input type="text" id="search" name="search" placeholder="Cari pemilih...">';
    echo '<select id="sort" name="sort">';
    echo '<option value="">Urutkan berdasarkan Nama</option>';
    echo '<option value="asc">A-Z</option>';
    echo '<option value="desc">Z-A</option>';
    echo '</select>';
    echo '</div>';
    echo '<table id="voters-table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nama Lengkap</th>';
    echo '<th>Username</th>';
    echo '<th>Password</th>';
    echo '<th>Aksi</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($data as $pemilih) {
        echo '<tr>';
        echo '<td>' . $pemilih['full_name'] . '</td>';
        echo '<td>' . $pemilih['username'] . '</td>';
        echo '<td>' . $pemilih['password'] . '</td>';
        echo '<td>';
        echo '<a href="edit_voter.php?id=' . $pemilih['id'] . '" class="edit-button">Edit</a>';
        echo '<a href="delete_voter.php?id=' . $pemilih['id'] . '" class="delete-button">Hapus</a>';
        echo '</td>';
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
            try {
                $spreadsheet = IOFactory::load($uploadPath);
                $worksheet = $spreadsheet->getActiveSheet();
                $highestRow = $worksheet->getHighestRow();

                // Mulai dari baris ke-2 untuk melewati baris header
                for ($row = 2; $row <= $highestRow; $row++) {
                    $namaLengkap = $worksheet->getCell('A' . $row)->getValue();
                    $username = $worksheet->getCell('B' . $row)->getValue();
                    $password = $worksheet->getCell('C' . $row)->getValue();

                    // Lakukan operasi INSERT ke tabel users
$query = "INSERT INTO users (full_name, username, password, role) VALUES ('$namaLengkap', '$username', '$password', 'user')";
mysqli_query($conn, $query);

                }

                // Menampilkan notifikasi sukses
                showSuccessNotification();
            } catch (Exception $e) {
                echo '<script>alert("Terjadi kesalahan saat mengimpor data.");</script>';
            }
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
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            margin-top: 0;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="file"],
        input[type="text"],
        input[type="password"] {
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            padding: 8px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons a,
        .action-buttons button {
            margin-right: 5px;
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            background-color: #333;
            border: none;
            cursor: pointer;
        }

        .action-buttons a:hover,
        .action-buttons button:hover {
            background-color: #555;
        }

        .search-box {
            margin-bottom: 10px;
        }

        .search-box input {
            padding: 5px;
            margin-right: 5px;
        }

        .edit-button {
            background-color: #007bff;
        }

        .delete-button {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="admin.php">Home</a></li>
        </ul>
    </nav>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const sortSelect = document.getElementById('sort');
            const table = document.getElementById('voters-table');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function() {
                const searchText = searchInput.value.toLowerCase();

                for (let i = 0; i < rows.length; i++) {
                    const name = rows[i].getElementsByTagName('td')[0].innerText.toLowerCase();
                    const username = rows[i].getElementsByTagName('td')[1].innerText.toLowerCase();

                    if (name.includes(searchText) || username.includes(searchText)) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            });

            sortSelect.addEventListener('change', function() {
                const sortValue = sortSelect.value;

                if (sortValue === '') {
                    return;
                }

                const sortedRows = Array.from(rows);

                sortedRows.sort(function(a, b) {
                    const aValue = a.getElementsByTagName('td')[0].innerText.toLowerCase();
                    const bValue = b.getElementsByTagName('td')[0].innerText.toLowerCase();

                    if (sortValue === 'asc') {
                        return aValue.localeCompare(bValue);
                    } else if (sortValue === 'desc') {
                        return bValue.localeCompare(aValue);
                    } else {
                        return 0;
                    }
                });

                for (let i = 0; i < sortedRows.length; i++) {
                    table.getElementsByTagName('tbody')[0].appendChild(sortedRows[i]);
                }
            });
        });
    </script>
</body>
</html>
