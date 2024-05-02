<!-- Buatkan Halam Login Terdiri Dari Username, Passowrd, Email -->

<!DOCTYPE html>
<html>

<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php

if (isset($_POST['submit'])) {
    require_once 'dbkoneksi.php';

    $user = $dbh->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
    $user->execute([
        $_POST['email'], $_POST['password']
    ]);

    $count = $user->rowCount();
    // Untuk Memastikan Apakah User Tersedia Atau Tidak

    if ($count > 0) {
        session_start();
        $_SESSION['user'] = $user->fetch();

        header("Location: index.php");
    } else { // Jika Data Login
        header("Location: login.php");
    }
}

?>

<body>
    <!-- Buatkan Form Berisi Username Password & Email -->

    <form action="" method="post">
        <div class="container">
            <h1>Login</h1>

            <div>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email">
            </div>
            <br />

            <div>
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
            </div>
            <br />

            <button type="submit" name="submit">Login</button>
        </div>
    </form>

</body>

</html>