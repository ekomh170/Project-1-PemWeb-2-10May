<?php

function validasi_login($redirect_url) {
    session_start();
    
    if (!isset($_SESSION['user'])) {
        header("Location: " . $redirect_url);
        exit;
    }
    
    // Mengambil informasi user jika sudah login
    $user = $_SESSION['user'];
    
    // Mengembalikan informasi user
    return $user;
}
