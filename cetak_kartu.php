<!DOCTYPE html>
<html>
<head>
    <title>Cetak Kartu Pemilih</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .card {
            position: relative;
            width: 6.8cm;
            height: 4cm;
            margin: 0;
            padding: 5mm;
            border: 1px solid #ccc;
            float: left;
            margin-right: 10mm;
            margin-bottom: 10mm;
        }

        .logo {
            position: absolute;
            top: 5mm;
            left: 5mm;
            width: 10mm;
            height: auto;
        }

        .header {
            text-align: center;
            margin-top: 10px;
        }

        .title {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 10px;
            margin-bottom: 10px;
        }

        .content {
            margin-top: 10px;
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
        }

        .content-table th,
        .content-table td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 10px;
        }

        @media print {
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
    <?php
    // Koneksi ke database
    include 'config.php';

    // Fungsi untuk mendapatkan data pemilih dari database
    function getDataPemilih($conn)
    {
        $dataPemilih = array();

        // Query untuk mengambil data pemilih dengan role 'user' dari tabel users
        $query = "SELECT full_name, username, password FROM users WHERE role = 'user'";
        $result = mysqli_query($conn, $query);

        // Memasukkan data pemilih ke dalam array
        while ($row = mysqli_fetch_assoc($result)) {
            $dataPemilih[] = $row;
        }

        // Mengembalikan data pemilih
        return $dataPemilih;
    }

    // Mengambil data pemilih dari database
    $dataPemilih = getDataPemilih($conn);

    // Menutup koneksi database
    mysqli_close($conn);
    ?>

    <?php $counter = 1; ?>
    <?php foreach ($dataPemilih as $pemilih): ?>
        <div class="card">
            <img class="logo" src="logo.png" alt="Logo">

            <div class="header">
                <div class="title">Kartu Pemilih</div>
                <div class="subtitle">Pemilihan Ketua Osis</div>
            </div>

            <div class="content">
                <table class="content-table">
                    <tr>
                        <th>Nama</th>
                        <td><?php echo $pemilih['full_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?php echo $pemilih['username']; ?></td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td><?php echo $pemilih['password']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <?php if ($counter % 6 === 0): ?>
            <div class="page-break"></div>
        <?php endif; ?>

        <?php $counter++; ?>
    <?php endforeach; ?>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
