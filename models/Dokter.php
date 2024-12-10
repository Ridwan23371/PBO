<?php
class Dokter extends BaseModel {
    public function create($userId, $nama, $spesialisasi, $jadwal) {
        $sql = "INSERT INTO dokter (user_id, nama, spesialisasi, jadwal) VALUES (?, ?, ?, ?)";
        $result = $this->query($sql, [$userId, $nama, $spesialisasi, json_encode($jadwal)]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function update($dokterId, $spesialisasi, $jadwal) {
        $sql = "UPDATE dokter SET spesialisasi = ?, jadwal = ? WHERE id = ?";
        $this->query($sql, [$spesialisasi, json_encode($jadwal), $dokterId]);
    }

    public function getId ($userId) {
        $sql = "SELECT id FROM dokter WHERE user_id = ?";
        $result = $this->query($sql, [$userId])->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    public function getSpesialisasi($userId) {
        $sql = "SELECT spesialisasi FROM dokter WHERE user_id = ?";  
        $result = $this->query($sql, [$userId])->fetch(PDO::FETCH_ASSOC);
        return $result['spesialisasi'];
    }

    public function getAllDokter() {
        $sql = "SELECT * FROM dokter";
        $stmt = $this->query($sql);
    
        if (!$stmt) {
            error_log("Query gagal dijalankan: $sql");
            return [];
        }
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getSchedule($dokterId) {
        $sql = "SELECT jadwal FROM dokter WHERE id = ?";
        $result = $this->query($sql, [$dokterId])->fetch(PDO::FETCH_ASSOC);
        return json_decode($result['jadwal'], true);
    }

    
}
?>
