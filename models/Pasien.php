<?php
class Pasien extends BaseModel {
    public function create($userId, $nama, $tanggalLahir, $alamat, $nomorTelepon) {
        $sql = "INSERT INTO pasien (user_id, nama, tanggal_lahir, alamat, nomor_telepon) VALUES (?, ?, ?, ?, ?)";
        $this->query($sql, [$userId, $nama, $tanggalLahir, $alamat, $nomorTelepon]);
    }

    public function getByUserId($userId) {
        $sql = "SELECT * FROM pasien WHERE user_id = ?";
        return $this->query($sql, [$userId])->fetch(PDO::FETCH_ASSOC);
    }
}
?>
