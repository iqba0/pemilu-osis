<?php
include 'config.php';

// Ambil data pemilih dari database
$query = mysqli_query($conn, "SELECT * FROM users WHERE role = 'user'");

// Inisialisasi array untuk menyimpan data pemilih
$voters = [];

// Loop untuk mengambil setiap baris data pemilih
while ($row = mysqli_fetch_assoc($query)) {
    $voters[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Pemilih</title>
    <style>
        /* Container Styles */
        .container {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        table th {
            text-align: left;
            background-color: #f2f2f2;
        }

        /* Print Button Styles */
        .print-button {
            margin-bottom: 20px;
            text-align: right;
        }

        .print-button button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* @media Print Styles */
        @media print {
            .container {
                border: none;
                box-shadow: none;
            }

            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="print-button">
            <button onclick="window.print()">Cetak</button>
        </div>
        <h1>Data Pemilih</h1>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                <?php foreach ($voters as $voter) { ?>
                    <tr>
                        <td class="number-column"><?php echo $counter; ?></td>
                        <td><?php echo $voter['full_name']; ?></td>
                        <td><?php echo $voter['username']; ?></td>
                        <td><?php echo $voter['password']; ?></td>
                    </tr>
                    <?php $counter++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
