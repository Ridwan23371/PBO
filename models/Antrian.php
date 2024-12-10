<?php

require_once 'BaseModel.php';

class Antrian extends BaseModel {
    public function add($pasienId, $dokterId, $jadwalId, $keluhan) {
        $sql = "INSERT INTO antrian (pasien_id, dokter_id, jadwal_id, status, keluhan) VALUES (?, ?, ?, 'menunggu', ?)";
        $this->query($sql, [$pasienId, $dokterId, $jadwalId, $keluhan]);
    }

    public function updateStatus($id, $status) {
        $sql = "UPDATE antrian SET status = ? WHERE id = ?";
        $this->query($sql, [$status, $id]);
    }

    public function getByDokterId($dokterId) {
        $sql = "SELECT * FROM antrian WHERE dokter_id = ? AND status = 'menunggu' ORDER BY id ASC";
        return $this->query($sql, [$dokterId])->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllDokterQueue($userId) {
        // Query untuk mendapatkan ID dokter berdasarkan user_id
        $sqlDokter = "SELECT id FROM dokter WHERE user_id = ?";
        $dokter = $this->query($sqlDokter, [$userId])->fetch(PDO::FETCH_ASSOC);
    
        if (!$dokter) {
            return [];
        }
    
        $dokterId = $dokter['id'];
    
        // Query untuk mendapatkan antrian berdasarkan dokter_id, status, dan tanggal hari ini
        $sqlAntrian = "
            SELECT antrian.*, users.username AS pasien_username 
            FROM antrian 
            JOIN users ON antrian.pasien_id = users.id 
            WHERE antrian.dokter_id = ? 
            AND antrian.status = 'menunggu' 
            AND DATE(antrian.jadwal_id) = DATE('now')";
        $antrian = $this->query($sqlAntrian, [$dokterId])->fetchAll(PDO::FETCH_ASSOC);
    
        return $antrian;
    }
    
    
    
}
?>
