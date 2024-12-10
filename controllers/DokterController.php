<?php 

require_once '../models/Dokter.php';

class DokterController {

    private $doctor;
    public function __construct($db)
    {
        $this->doctor = new Dokter($db);
    }
    public function addDokter($userId, $username, $spesialisasi, $jadwal) {
        $result = $this->doctor->getId($userId);
        if ($result) {
            $this->doctor->update($result, $spesialisasi, $jadwal);
            return true;
        }
        $resultcreate = $this->doctor->create($userId, $username, $spesialisasi, $jadwal);
        if ($resultcreate) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDokter($dokterId, $spesialisasi, $jadwal) {
        $this->doctor->update($dokterId, $spesialisasi, $jadwal);
    }

    public function getAllDokter() {
        return $this->doctor->getAllDokter();
    }

    public function getSpesialisasi($userId) {
        return $this->doctor->getSpesialisasi($userId);
    }


}
?>
