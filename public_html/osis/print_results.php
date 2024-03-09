<?php
include 'config.php';

// Ambil data hasil voting dari database
$query = mysqli_query($conn, "SELECT candidates.name, COUNT(votes.id) AS total_votes FROM candidates LEFT JOIN votes ON candidates.id = votes.candidate_id GROUP BY candidates.id");
$results = [];

while ($row = mysqli_fetch_assoc($query)) {
    $results[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Hasil Voting</title>
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
            margin-top: 20px;
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
        <h1>Hasil Voting</h1>
        <table>
            <thead>
                <tr>
                    <th>Nama Kandidat</th>
                    <th>Total Suara</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result) { ?>
                    <tr>
                        <td><?php echo $result['name']; ?></td>
                        <td><?php echo $result['total_votes']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="print-button">
            <button onclick="window.print()">Cetak</button>
        </div>
    </div>
</body>
</html>
