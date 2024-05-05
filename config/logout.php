<?php
// Mulai sesi PHP
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect kembali ke halaman login atau halaman lain yang diinginkan
header("Location: ../index.php");
exit;
?>
