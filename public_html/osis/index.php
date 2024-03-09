<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Header Styles */
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

        /* Login Styles */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 160px);
        }

        .login-box {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .login-box h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-box label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-box .password-toggle {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .login-box .password-toggle label {
            margin-left: 5px;
            font-weight: normal;
            cursor: pointer;
        }

        .login-box .password-toggle label:hover {
            text-decoration: underline;
        }

        .login-box button[type="submit"] {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .login-box button[type="submit"]:hover {
            background-color: #45a049;
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
</head>
<body>
    <header class="header">
        <div class="header-logo">
            <img src="logo.png" alt="Logo">
        </div>
        <h1 class="header-title">Aplikasi Pemilihan OSIS SMK Sumatra 40</h1>
    </header>

    <div class="login-container">
        <div class="login-box">
            <h1>Login</h1>
            <form action="index.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>

                <label for="password">Password:</label>
                <div class="password-toggle">
    <input type="password" name="password" id="password" required>
    <button type="button" id="toggle-password" class="toggle-password"><i class="fas fa-eye"></i></button>
</div>


                <button type="submit">Login</button>
            </form>
            <?php
            include 'config.php';

            // Memeriksa apakah data POST ada
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Memeriksa login admin
                $adminQuery = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = 'admin'");
                $admin = mysqli_fetch_assoc($adminQuery);

                // Memeriksa login pemilih
                $userQuery = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = 'user'");
                $user = mysqli_fetch_assoc($userQuery);

                if ($admin) {
                    // Set session untuk admin
                    session_start();
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['username'] = $admin['username'];
                    $_SESSION['role'] = $admin['role'];

                    // Redirect ke halaman admin
                    header("Location: admin.php");
                    exit();
                } elseif ($user) {
                    // Set session untuk pemilih
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    // Redirect ke halaman pemilihan
                    header("Location: vote.php");
                    exit();
                } else{
                    // Gagal login
                    echo '<p>Username atau password salah.</p>';
                }
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; SMK Sumatra 40 2023. All rights reserved.</p>
    </footer>

    <script>
        var passwordInput = document.getElementById('password');
        var showPasswordLabel = document.getElementById('show-password-label');
        var showPasswordCheckbox = document.createElement('input');
        showPasswordCheckbox.type = 'checkbox';
        showPasswordCheckbox.id = 'show-password';
        showPasswordLabel.prepend(showPasswordCheckbox);

        showPasswordCheckbox.addEventListener('change', function() {
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>
