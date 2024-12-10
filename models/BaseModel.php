<?php

require_once '../database/connection.php'; // Pastikan koneksi database di-include

class BaseModel {
    protected $db;

    // Menerima parameter $db dan menyimpannya ke dalam properti kelas
    public function __construct($db) {
        $this->db = $db;
    }

    // Fungsi query untuk mengeksekusi perintah SQL
    protected function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql); // Menyiapkan statement SQL
        $stmt->execute($params); // Menjalankan query dengan parameter
        return $stmt; // Mengembalikan hasil query
    }
}
?>
