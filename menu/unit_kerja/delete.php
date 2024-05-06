<?php
// Memanggil file koneksi database
require '../../config/dbkoneksi.php';

// Memeriksa apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    $unit_kerja_id = $_GET['id']; // Inisialisasi variabel $unit_kerja_id dengan nilai dari parameter id

    // Fungsi untuk memeriksa apakah terdapat rekaman terkait di tabel "dokter"
    function hasRelatedDokter($unit_kerja_id, $dbh)
    {
        $query = $dbh->prepare("SELECT COUNT(*) as count FROM dokter WHERE unit_kerja_id = ?");
        $query->execute([$unit_kerja_id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    // $unit_kerja_id sudah diinisialisasi sebelumnya dari parameter URL
    // Periksa apakah terdapat rekaman terkait di tabel "dokter"
    if (hasRelatedDokter($unit_kerja_id, $dbh)) {
        echo "<script>alert('Unit Kerja ini memiliki relasi dengan data Dokter. Anda tidak dapat menghapusnya.'); window.location.href = 'index.php';</script>";
    } else {
        // Lanjutkan dengan penghapusan jika tidak terdapat rekaman terkait
        $query = $dbh->prepare("DELETE FROM unit_kerja WHERE id = ?");
        $query->execute([$unit_kerja_id]);
        echo "<script>alert('Data Unit Kerja berhasil dihapus.'); window.location.href = 'index.php';</script>";
    }
}
