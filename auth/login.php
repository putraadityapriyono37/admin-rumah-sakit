<?php
require_once "../_config/config.php";

if (isset($_SESSION['user'])) {
    echo "<script>window.location='" . base_url() . "';</script>";
} else {
    $error = false; // Flag untuk menentukan apakah login gagal atau tidak

    if (isset($_POST['login'])) {
        $user = trim(mysqli_real_escape_string($con, $_POST['user']));
        $pass = sha1(trim(mysqli_real_escape_string($con, $_POST['pass'])));

        // Query login
        $sql_login = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$user' AND password = '$pass'") or die(mysqli_error($con));

        // Jika login berhasil
        if (mysqli_num_rows($sql_login) > 0) {
            $_SESSION['user'] = $user;
            echo "<script>window.location='" . base_url() . "';</script>";
        } else {
            $error = true; // Set flag error jika login gagal
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Admin RST WijayaKusuma Purwokerto</title>
        <link href="<?= base_url('_assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
        <link rel="icon" href="<?= base_url('_assets/rswk.jpg') ?>">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
        <style>
            /* Tema tentara */
            body {
                background-color: #2c3e50;
                color: #ecf0f1;
                font-family: 'Poppins', sans-serif;
            }

            .login-container {
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .card {
                background-color: #34495e;
                border-radius: 15px;
                box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.7), 0px 4px 20px rgba(0, 0, 0, 0.5);
                transition: all 0.3s ease-in-out;
                padding: 30px;
                width: 100%;
                max-width: 400px;
            }

            .card:hover {
                transform: scale(1.05);
                box-shadow: 0px 15px 40px rgba(0, 0, 0, 0.7), 0px 10px 30px rgba(0, 0, 0, 0.5);
            }

            .card-header {
                text-align: center;
                background-color: #2c3e50;
                color: #ecf0f1;
                border-bottom: 1px solid #7f8c8d;
                padding-bottom: 20px;
                margin-bottom: 20px;
            }

            .card-header img {
                width: 100px;
                height: 100px;
                border-radius: 35%;
                box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.5);
                object-fit: cover;
                transition: all 0.3s ease-in-out;
            }

            .card-header img:hover {
                transform: scale(1.1);
                box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.7);
            }

            .form-control {
                border-radius: 8px;
                /* Radius yang lebih pas */
                background-color: #2c3e50;
                border: 1px solid #7f8c8d;
                color: #ecf0f1;
                padding-left: 40px;
                /* Jarak untuk ikon */
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: #1abc9c;
                box-shadow: none;
            }

            .input-group-text {
                background-color: #2c3e50;
                color: #ecf0f1;
                border: none;
                border-radius: 50%;
            }

            .input-group-text i {
                color: #1abc9c;
            }

            .d-grid {
                margin-top: 20px;
            }

            .btn-primary {
                background-color: #1abc9c;
                border: none;
                border-radius: 8px;
                transition: background-color 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .btn-primary:hover {
                background-color: #16a085;
            }

            .btn-primary i {
                margin-right: 8px;
            }

            /* SweetAlert2 customization */
            .swal2-popup {
                background-color: #34495e !important;
                color: #ecf0f1;
            }

            .form-group {
                margin-bottom: 15px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="login-container">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <img src="<?= base_url('_assets/rswk.jpg') ?>" alt="Logo RSWK">
                            <h4 class="mt-2">Login Admin</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" id="loginForm">
                                <div class="form-group">
                                    <div class="input-group" style=" width: 100%;">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div> <!-- Menggunakan Font Awesome -->
                                        <input type="text" name="user" class="form-control" placeholder="Username" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group" style="width: 100%;">
                                        <div class="input-group-text"><i class="fas fa-lock"></i></div> <!-- Menggunakan Font Awesome -->
                                        <input type="password" name="pass" class="form-control" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" name="login" class="btn btn-primary">
                                        <i class="fas fa-sign-in-alt"></i> Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?= base_url('_assets/js/jquery.js') ?>"></script>
        <script src="<?= base_url('_assets/js/bootstrap.bundle.min.js') ?>"></script>

        <!-- JavaScript untuk menampilkan peringatan -->
        <script>
            // Jika login gagal, tampilkan alert menggunakan SweetAlert2
            <?php if ($error) : ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal!',
                    text: 'Username atau password salah.',
                    confirmButtonColor: '#1abc9c',
                    footer: 'Silakan coba lagi.'
                });
            <?php endif; ?>
        </script>
    </body>

    </html>
<?php
}
?>