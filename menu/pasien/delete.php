<?php
// Memanggil file koneksi database
require '../../config/dbkoneksi.php';

// Memeriksa apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data pasien berdasarkan id
    $sql = "DELETE FROM pasien WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);

    // Menampilkan alert setelah proses penghapusan selesai
    echo "<script>alert('Data berhasil dihapus.'); window.location='index.php';</script>";
    exit();
} else {
    echo "Parameter ID tidak ditemukan.";
    exit;
}
