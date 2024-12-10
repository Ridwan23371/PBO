<?php
class Resep extends BaseModel {
    public function add($pasienId, $dokterId, $obat, $ketentuan) {
        $sql = "INSERT INTO resep (pasien_id, dokter_id, obat, ketentuan) VALUES (?, ?, ?, ?)";
        $this->query($sql, [$pasienId, $dokterId, $obat, $ketentuan]);
    }

    public function getByPasienId($pasienId) {
        $sql = "SELECT * FROM resep WHERE pasien_id = ?";
        return $this->query($sql, [$pasienId])->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
