<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        // Set session untuk user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect ke halaman yang sesuai berdasarkan role
        if ($user['role'] === 'admin') {
            header("Location: admin.php");
            exit();
        } elseif ($user['role'] === 'user') {
            header("Location: vote.php");
            exit();
        }
    } else {
        // Gagal login
        $error = "Username atau password salah.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
            width: 45px;
            height: 45px;   
        }

        .header-title {
            font-size: 9px;
            font-weight: ;
            text-align:center;
            
        }

        /* Login Styles */
        .login-container {
            min-height: calc(100vh - 160px);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }
        .login-logo {
            margin-bottom:15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .password-toggle label:hover {
            text-decoration: underline;
        }

        /* Button Styles */
        .btn-login {
            background-color: #ccc;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #4CAF50;
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
   <div class="header-title">
   <h1>Pemilihan Ketua OSIS SMK SUMATRA 40</h1>
</div> 
</header>
<center><body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <div class="text-center">
                 <img src="logo.png" width="100" height="100"  class="d-inline-block align-top" alt="Logo">
            </div>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body" style="border-radius: 20px;">
                <p class="login-box-msg">Masukan username dan password</p>

                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger text-center">
                        <b>Username/Password Salah</b>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username..." required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password..." required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                        </div>

                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="login" class="btn btn-success btn-block">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

               <!-- <hr>
                <p class="mb-1 text-center">
                    <span class="mt-5 mb-3 text-muted">Developer &copy;
                        <a href="https://mubatekno.com">Muba Teknologi</a> <?= date('Y') ?>
                    </span>
                </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div> </center>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var toggleIcon = document.getElementById('show-password').querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
