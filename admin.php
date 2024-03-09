<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            background-color: #333;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .header-logo img {
            width: 70px;
            height: 70px;
        }

        .header-title {
            font-size: 24px;
            font-weight: bold;
            margin-left: 10px;
        }

        .container {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 20px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar-logo img {
            width: 50px;
            height: 50px;
        }

        .navbar-nav {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar-nav li {
            margin-right: 10px;
        }

        .navbar-nav li a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .navbar-nav li a:hover {
            background-color: #555;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        /* Media queries */
        @media screen and (max-width: 600px) {
            /* Modifikasi tampilan untuk perangkat dengan lebar maksimum 600px */
            .header {
                flex-direction: column;
                align-items: center;
                padding: 10px;
            }

            .header-logo img {
                margin-bottom: 10px;
            }

            .container {
                padding: 10px;
            }

            .navbar {
                flex-direction: column;
            }

            .navbar li {
                margin-bottom: 5px;
            }
        }

        @media screen and (max-width: 400px) {
            /* Modifikasi tampilan untuk perangkat dengan lebar maksimum 400px */
            .header-title {
                font-size: 20px;
            }

            .container {
                grid-gap: 10px;
            }

            table {
                font-size: 14px;
            }
        }

        /* Icons */
        .icon {
            display: inline-block;
            width: 16px;
            height: 16px;
            background-repeat: no-repeat;
            background-position: center center;
            vertical-align: middle;
            margin-right: 5px;
        }

        .edit-icon {
            background-image: url("edit-icon.png");
        }

        .delete-icon {
            background-image: url("delete-icon.png");
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
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
            $('#sort').on('change', function() {
                var value = $(this).val();
                var table = $('#voters-table');
                var rows = table.find('tbody tr');

                rows.sort(function(a, b) {
                    var aValue = $(a).find('td:nth-child(2)').text();
                    var bValue = $(b).find('td:nth-child(2)').text();

                    if (value === 'asc') {
                        return aValue.localeCompare(bValue);
                    } else if (value === 'desc') {
                        return bValue.localeCompare(aValue);
                    } else {
                        return 0;
                    }
                });
                table.find('tbody').html(rows);
            });
        });

    </script>
</head>
<body>
    <?php
    include 'config.php';

    $queryCandidates = mysqli_query($conn, "SELECT * FROM candidates");
    $candidates = mysqli_fetch_all($queryCandidates, MYSQLI_ASSOC);

    $queryVoters = mysqli_query($conn, "SELECT * FROM users WHERE role = 'user'");
    $voters = mysqli_fetch_all($queryVoters, MYSQLI_ASSOC);

    mysqli_close($conn);
    ?>
    <header class="header">
        <div class="header-logo">
            <img src="logo.png" alt="Logo">
        </div>
        <h1 class="header-title">Admin Panel</h1>
    </header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="add_candidate.php">Tambah Data Kandidat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="import_voters.php">Data Pemilih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="print_results.php">Cetak Hasil Voting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="print_voters.php">Cetak Data Pemilih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cetak_kartu.php">Cetak Kartu Pemilih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Keluar</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div>
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
                            <td>
                                <object data="photos/<?php echo $candidate['photo']; ?>" type="image">
                                    <img src="photos/<?php echo $candidate['photo']; ?>" alt="Foto Kandidat" style="width: 100px; height: 100px;">
                                </object>
                            </td>
                            <td class="action-buttons">
                                <a href="edit_candidate.php?id=<?php echo $candidate['id']; ?>"><i class="fas fa-edit"></i></a>
                                <a href="delete_candidate.php?id=<?php echo $candidate['id']; ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <h2>Data Pemilih</h2>
            <div class="search-box">
                <input type="text" id="search" name="search" placeholder="Cari pemilih...">
                <select id="sort" name="sort">
                    <option value="">Urutkan berdasarkan Nama</option>
                    <option value="asc">A-Z</option>
                    <option value="desc">Z-A</option>
                </select>
            </div>
            <table id="voters-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1; ?>
                    <?php foreach ($voters as $voter): ?>
                        <tr>
                            <td class="number-column"><?php echo $counter; ?></td>
                            <td><?php echo $voter['full_name']; ?></td>
                            <td><?php echo $voter['username']; ?></td>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; SMK Sumatra 40 2023. All rights reserved.</p>
    </footer>
</body>
</html>
