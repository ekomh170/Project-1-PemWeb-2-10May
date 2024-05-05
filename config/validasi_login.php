<?php

function validasi_login($redirect_url) {
    session_start();
    
    if (!isset($_SESSION['user'])) {
        header("Location: " . $redirect_url);
        exit;
    }
}