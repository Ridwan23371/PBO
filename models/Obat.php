<?php
class Obat extends BaseModel {
    public function add($namaObat, $stok, $deskripsi) {
        $sql = "INSERT INTO obat (nama_obat, stok, deskripsi) VALUES (?, ?, ?)";
        $this->query($sql, [$namaObat, $stok, $deskripsi]);
    }

    public function updateStock($id, $stok) {
        $sql = "UPDATE obat SET stok = ? WHERE id = ?";
        $this->query($sql, [$stok, $id]);
    }

    public function getAll() {
        $sql = "SELECT * FROM obat";
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
