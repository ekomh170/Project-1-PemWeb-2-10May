<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Puskesmas | Eko Muchamad Haryono</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon, Apple Touch Icon, Android Chrome 192 & 512, Favicon 16 & 32, Site.Web Manifest  -->
    <link rel="icon" href="../dist/img/favicon/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="../dist/img/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="../dist/img/favicon/android-chrome-192x192.png" />
    <link rel="icon" type="image/png" sizes="512x512" href="../dist/img/favicon/android-chrome-512x512.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../dist/img/favicon/favicon-16x16.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../dist/img/favicon/favicon-32x32.png" />
    <link rel="manifest" href="../dist/img/favicon/site.webmanifest" />


    <link rel="stylesheet" type="text/css" href="../assets/auth/vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/auth/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/auth/vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css" href="../assets/auth/vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/auth/vendor/animsition/css/animsition.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/auth/vendor/select2/select2.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/auth/vendor/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" type="text/css" href="../assets/auth/css/util.css">
    <link rel="stylesheet" type="text/css" href="../assets/auth/css/main.css">

</head>

<?php
$error_message = ''; // Menyimpan pesan kesalahan

if (isset($_POST['submit'])) {
    require_once '../config/dbkoneksi.php';

    $user = $dbh->prepare("SELECT * FROM users WHERE email = ? AND password = MD5(?)");
    $user->execute([
        $_POST['email'], $_POST['password']
    ]);

    $count = $user->rowCount();
    // Untuk Memastikan Apakah User Tersedia Atau Tidak

    if ($count > 0) {
        session_start();
        $_SESSION['user'] = $user->fetch();
        header("Location: ../menu/index.php?login=success");
        exit();
    } else {
        $error_message = 'Email atau password salah. Silakan coba lagi.'; // Set pesan kesalahan
    }
}
?>


<body style="background-image: url(../assets/auth/images/bg-02.jpg);">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <div class="login100-form-title" style="background-image: url(../assets/auth/images/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        Login Petugas Puskesmas
                    </span>
                </div>

                <form action="" method="post" class="login100-form validate-form">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Email Harus di Isi">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" id="email" placeholder="Masukan email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password Harus di Isi">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" id="password" placeholder="Masukan password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me" onchange="autoFill()">
                            <label class="label-checkbox100" for="ckb1">
                                Akun Otomatis Untuk Uji Coba
                            </label>
                        </div>
                    </div>


                    <div class="container-login100-form-btn">
                        <button name="submit" class="login100-form-btn">
                            Login
                        </button>
                        <a href="../index.php" class="login100-form-btn" style="margin-left: 20px;">
                            Halaman Utama
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/auth/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="../assets/auth/vendor/animsition/js/animsition.min.js"></script>

    <script src="../assets/auth/vendor/bootstrap/js/popper.js"></script>
    <script src="../assets/auth/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="../assets/auth/vendor/select2/select2.min.js"></script>

    <script src="../assets/auth/vendor/daterangepicker/moment.min.js"></script>
    <script src="../assets/auth/vendor/daterangepicker/daterangepicker.js"></script>

    <script src="../assets/auth/vendor/countdowntime/countdowntime.js"></script>

    <script src="../assets/auth/js/main.js"></script>

    <script>
        function autoFill() {
            if (document.getElementById('ckb1').checked) {
                document.getElementById('email').value = 'admin@puskesmas.co.id';
                document.getElementById('password').value = '123';
            } else {
                document.getElementById('email').value = '';
                document.getElementById('password').value = '';
            }
        }
    </script>


</body>

</html>