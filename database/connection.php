<?php
try {
    // Menghubungkan ke database SQLite
    $db = new PDO('sqlite:../database/klinik.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Menangkap error jika koneksi gagal
    echo "Koneksi gagal: " . $e->getMessage();
}
?>
