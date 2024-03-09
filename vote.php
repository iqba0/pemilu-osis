<!DOCTYPE html>
<html>
<head>
    <title>Pemilihan Ketua OSIS</title>
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Container Styles */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 10px;
            text-align: center;
        }

        /* Heading Styles */
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Candidate Styles */
        .candidate-container {
            display: flex;
            flex-wrap: wrap; 
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .candidate {
            height: 525px;
            width: 350px;
            margin: 10px;
            padding: 10px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: center;
            position: relative;
            transition: filter 0.3s ease;
        }

        .candidate img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
            margin-top: 15px;
            transition: filter 0.3s ease;
        }

        .candidate h2 {
            margin-bottom: 5px;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .candidate p {
            margin-bottom: 10px;
            font-size: 14px;
            word-wrap: break-word;
        }

        .candidate input[type="radio"] {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            opacity: 0;
            cursor: pointer;
        }

        .candidate input[type="radio"] + label {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: block;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .candidate input[type="radio"]:checked + label {
            opacity: 1;
        }

        .candidate.blur {
            filter: blur(4px);
        }

        .candidate.blur img,
        .candidate.blur h2,
        .candidate.blur p {
            color: transparent;
        }

        /* Button Styles */
        button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            height: 30px;
            width: 80px;
            text-align: center;
            font-size:17px;
            border-radius: 7px;
            cursor: pointer;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Error Message Styles */
        .error-message {
            color: red;
            margin-top: 10px;
        }

        /* Logout Button Styles */
        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ccc;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #999;
        }

        /* Voting Instructions Styles */
        .voting-instructions {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pemilihan Ketua OSIS SMK SUMATRA 40</h1>
        <button class="logout-button" onclick="location.href='logout.php'">Keluar</button>
        <div class="voting-instructions">
            <br>
            <h3><font color="red">Tata Cara Memilih:</font></h3>
            <p>1. Klik pada foto calon Ketua OSIS pilihanmu.</p>
            <p>2. Klik tombol "<b>Pilih</b>".</p>
            <br><br>
        </div>
        <form action="process_vote.php" method="POST" id="vote-form">
            <div class="candidate-container">
                <?php
                include 'config.php';
                session_start();

                // Mendapatkan daftar calon kandidat
                $query = mysqli_query($conn, "SELECT * FROM candidates");
                while ($row = mysqli_fetch_assoc($query)) {
                    // Periksa apakah pemilih telah memilih kandidat ini sebelumnya
                    $selected = false;
                    $disabled = '';
                    if (isset($_SESSION['user_id'])) {
                        $voterId = $_SESSION['user_id'];
                        $checkVoteQuery = mysqli_query($conn, "SELECT * FROM votes WHERE voter_id = $voterId AND candidate_id = {$row['id']}");
                        if (mysqli_num_rows($checkVoteQuery) > 0) {
                            $selected = true;
                            $disabled = 'disabled';
                        }
                    }

                    echo '<div class="candidate' . ($selected ? ' blur' : '') . '">';
                    echo '<img src="photos/' . $row['photo'] . '" alt="Foto Kandidat">';
                    echo '<h2>' . $row['name'] . '</h2>';
                    echo '<p><strong>Visi:</strong><br>' . $row['vision'] . '</p>';
                    echo '<p><strong>Misi:</strong><br>' . $row['mission'] . '</p>';
                    echo '<input type="radio" name="candidate" value="' . $row['id'] . '" id="candidate-' . $row['id'] . '" ' . ($selected ? 'disabled' : '') . '>';
                    echo '<label for="candidate-' . $row['id'] . '"></label>';
                    echo '</div>';
                }

                mysqli_close($conn);
                ?>
            </div>
            <button type="submit" id="vote-button" <?php echo $disabled; ?>>Pilih</button>
            <p id="error-message" class="error-message"></p>
        </form>
    </div>

    <script>
        document.getElementById('vote-form').addEventListener('submit', function(event) {
            var selectedCandidate = document.querySelectorAll('input[name="candidate"]:checked');

            if (!selectedCandidate || selectedCandidate.length === 0) {
                event.preventDefault();
                document.getElementById('error-message').textContent = 'Pilih salah satu kandidat.';
            } else if (selectedCandidate.length > 1) {
                event.preventDefault();
                document.getElementById('error-message').textContent = 'Anda hanya boleh memilih satu kandidat.';
            } else {
                document.getElementById('vote-button').disabled = true;
            }
        });
    </script>
</body>
</html>
