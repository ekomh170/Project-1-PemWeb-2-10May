<?php
// Mulai sesi PHP
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Pesan untuk alert
$message = "Anda telah berhasil logout.";

// Menggunakan JavaScript untuk menampilkan alert
echo "<script>alert('$message'); window.location.href='../index.php';</script>";
exit;
?>
