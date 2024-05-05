<?php
// Memanggil file koneksi database
require '../../config/dbkoneksi.php';

// Memeriksa apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan nama file gambar dari database sebelum penghapusan
    $sql_get_image = "SELECT foto FROM users WHERE user_id = ?";
    $stmt_get_image = $dbh->prepare($sql_get_image);
    $stmt_get_image->execute([$id]);
    $image_name = $stmt_get_image->fetchColumn();

    // Hapus file gambar jika ada
    if (!empty($image_name)) {
        $image_path = '../../assets/foto/users/' . $image_name;
        if (file_exists($image_path)) {
            unlink($image_path); // Hapus file gambar dari direktori
        }
    }

    // Query untuk menghapus data pengguna berdasarkan ID
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);

    // Menampilkan alert setelah proses penghapusan selesai
    echo "<script>alert('Data berhasil dihapus.'); window.location='index.php';</script>";
    exit();
} else {
    echo "Parameter ID tidak ditemukan.";
    exit;
}
?>
