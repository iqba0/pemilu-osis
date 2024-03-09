<!DOCTYPE html>
<html>
<head>
    <title>Pemilihan Ketua OSIS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Container Styles */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
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
        }

        .candidate {
            width: 200px;
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
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
            transition: filter 0.3s ease;
        }

        .candidate h2 {
            margin-bottom: 5px;
            transition: color 0.3s ease;
        }

        .candidate p {
            margin-bottom: 10px;
            transition: color 0.3s ease;
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
            border-radius: 50%;
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
            border-radius: 4px;
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
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Pemilihan Ketua OSIS</h1>
        <form action="vote.php" method="POST">
            <div class="candidate-container">
                <?php
                include 'config.php';

                // Mendapatkan daftar calon kandidat
                $query = mysqli_query($conn, "SELECT * FROM candidates");
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '<div class="candidate">';
                    echo '<img src="photos/' . $row['photo'] . '" alt="Foto Kandidat">';
                    echo '<h2>' . $row['name'] . '</h2>';
                    echo '<p><strong>Visi:</strong> ' . $row['vision'] . '</p>';
                    echo '<p><strong>Misi:</strong> ' . $row['mission'] . '</p>';
                    echo '<input type="radio" name="candidate" value="' . $row['id'] . '">';
                    echo '<label></label>';
                    echo '</div>';
                }

                mysqli_close($conn);
                ?>
            </div>
            <button type="submit">Vote</button>
            <p class="error-message">
                <?php
                if (isset($_SESSION['vote_error'])) {
                    echo $_SESSION['vote_error'];
                    unset($_SESSION['vote_error']);
                }
                ?>
            </p>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>