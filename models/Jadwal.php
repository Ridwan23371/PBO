<?php
class Jadwal extends BaseModel {
    public function add($dokterId, $tanggal, $waktuMulai, $waktuSelesai) {
        $sql = "INSERT INTO jadwal (dokter_id, tanggal, waktu_mulai, waktu_selesai, status) VALUES (?, ?, ?, ?, 'tersedia')";
        $this->query($sql, [$dokterId, $tanggal, $waktuMulai, $waktuSelesai]);
    }

    public function getAvailableSchedules() {
        $sql = "SELECT * FROM jadwal WHERE status = 'tersedia'";
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
