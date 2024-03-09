<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
            .header {
            background-color: #333;
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0px 20px;
            color: #fff;
        }

        .header-logo img {
            width: 70px;
            height: 70px;
        }

        .header-title {
            font-size: 24px;
            font-weight: bold;
            margin-left: 10px;
            margin-top: 20px;
        }

        /* Container Styles */
        .container {
            margin-top: 20px;
            margin-bottom: 20px;
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

        /* Action Buttons */
        .action-buttons a {
            margin-right: 5px;
        }

        /* Search Box */
        .search-box {
            margin-bottom: 10px;
        }

        /* Navbar Styles */
        .navbar {
            margin-bottom: 20px;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #f2f2f2;
        }

        .navbar li {
            float: left;
        }

        .navbar li a {
            display: block;
            color: #333;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar li a:hover {
            background-color: #ddd;
        }

        /* Footer Styles */
        .footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi pencarian
            $('#search').on('keyup', function() {
                var input = $(this).val().toLowerCase();
                var table = $('#voters-table');
                var rows = table.find('tbody tr');

                rows.each(function() {
                    var name = $(this).find('td:nth-child(2)').text().toLowerCase();
                    var username = $(this).find('td:nth-child(3)').text().toLowerCase();

                    if (name.includes(input) || username.includes(input)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });

        // Fungsi hapus pemilih menggunakan AJAX
        function deleteVoter(id) {
            var confirmation = confirm('Anda yakin ingin menghapus data pemilih ini?');
            if (confirmation) {
                $.ajax({
                    url: 'check_voter_relationship.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        if (response === 'related') {
                            alert('Pemilih tidak dapat dihapus karena terkait dengan data lainnya.');
                        } else if (response === 'unrelated') {
                            $.ajax({
                                url: 'delete_voter.php',
                                type: 'POST',
                                data: { id: id },
                                success: function(response) {
                                    alert('Data pemilih berhasil dihapus');
                                    window.location.reload(); // Refresh halaman setelah penghapusan data pemilih
                                },
                                error: function(xhr, status, error) {
                                    alert('Gagal menghapus data pemilih. Silakan coba lagi.');
                                }
                            });
                        } else {
                            alert('Gagal memeriksa hubungan pemilih dengan data lainnya.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Gagal memeriksa hubungan pemilih dengan data lainnya. Silakan coba lagi.');
                    }
                });
            }
        }
    </script>
</head>
<body>
<?php
include 'config.php';

// Mengambil data kandidat dari database
$queryCandidates = mysqli_query($conn, "SELECT * FROM candidates");
$candidates = mysqli_fetch_all($queryCandidates, MYSQLI_ASSOC);

// Mengambil data pemilih dari database
$queryVoters = mysqli_query($conn, "SELECT * FROM users WHERE role = 'user'");
$voters = mysqli_fetch_all($queryVoters, MYSQLI_ASSOC);

mysqli_close($conn);
?>
    <header class="header">
        <div class="header-logo">
            <img src="logo.png" alt="Logo">
        </div>
        <h1 class="header-title">SMK Sumatra 40</h1>
    </header>

    <div class="container">
        <div class="navbar">
            <ul>
                <li><a href="add_candidate.php">Tambah Data Kandidat</a></li>
                <li><a href="import_voters.php">Tambah Data Pemilih</a></li>
                <li><a href="print_results.php">Cetak Hasil Voting</a></li>
                <li><a href="print_voters.php">Cetak Data Pemilih</a></li>
                <li><a href="logout.php">Keluar</a></li>
            </ul>
        </div>

        <h2>Data Kandidat</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Kandidat</th>
                    <th>Visi</th>
                    <th>Misi</th>
                    <th>Motto Hidup</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($candidates as $candidate): ?>
                    <tr>
                        <td><?php echo $candidate['name']; ?></td>
                        <td><?php echo $candidate['vision']; ?></td>
                        <td><?php echo $candidate['mission']; ?></td>
                        <td><?php echo $candidate['motto']; ?></td>
                        <td><img src="photos/<?php echo $candidate['photo']; ?>" alt="Foto Kandidat" style="width: 100px; height: 100px;"></td>
                        <td class="action-buttons">
                            <a href="edit_candidate.php?id=<?php echo $candidate['id']; ?>">Edit</a>
                            <a href="delete_candidate.php?id=<?php echo $candidate['id']; ?>">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Data Pemilih</h2>
        <div class="search-box">
            <input type="text" id="search" name="search" placeholder="Cari pemilih...">
        </div>
        <table id="voters-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                <?php foreach ($voters as $voter): ?>
                    <tr>
                        <td class="number-column"><?php echo $counter; ?></td>
                        <td><?php echo $voter['full_name']; ?></td>
                        <td><?php echo $voter['username']; ?></td>
                        <td class="action-buttons">
                            <a href="edit_voter.php?id=<?php echo $voter['id']; ?>">Edit</a>
                            <button onclick="deleteVoter(<?php echo $voter['id']; ?>)">Hapus</button>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <p>&copy; SMK Sumatra 40 2023. All rights reserved.</p>
    </footer>
</body>
</html>
