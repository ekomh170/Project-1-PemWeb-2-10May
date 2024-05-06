<?php
// Memanggil file koneksi database
require '../../config/dbkoneksi.php';

// Memeriksa apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    $kelurahan_id = $_GET['id']; // Inisialisasi variabel $kelurahan_id dengan nilai dari parameter id

    // Fungsi untuk memeriksa apakah terdapat rekaman terkait di tabel "pasien"
    function hasRelatedPasien($kelurahan_id, $dbh)
    {
        $query = $dbh->prepare("SELECT COUNT(*) as count FROM pasien WHERE kelurahan_id = ?");
        $query->execute([$kelurahan_id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    // $kelurahan_id sudah diinisialisasi sebelumnya dari parameter URL
    // Periksa apakah terdapat rekaman terkait di tabel "pasien"
    if (hasRelatedPasien($kelurahan_id, $dbh)) {
        echo "<script>alert('Kelurahan ini memiliki relasi dengan data Pasien. Anda tidak dapat menghapusnya.'); window.location.href = 'index.php';</script>";
    } else {
        // Lanjutkan dengan penghapusan jika tidak terdapat rekaman terkait
        $query = $dbh->prepare("DELETE FROM kelurahan WHERE id = ?");
        $query->execute([$kelurahan_id]);
        echo "<script>alert('Data Kelurahan berhasil dihapus.'); window.location.href = 'index.php';</script>";
    }
}
