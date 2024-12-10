<?php
require_once '../models/Antrian.php';

class AntrianController
{
    private $antrianModel;

    public function __construct($db)
    {
        $this->antrianModel = new Antrian($db);
    }

    /**
     * Tambahkan antrean baru.
     * 
     * @param int $pasienId
     * @param int $dokterId
     * @param int $jadwalId
     * @throws Exception
     */
    public function addQueue($pasienId, $dokterId, $jadwalId, $keluhan)
    {   
        $this->antrianModel->add($pasienId, $dokterId, $jadwalId, $keluhan);
    }

    public function updateStatus($id, $status) {
        $this->antrianModel->updateStatus($id, $status);
    }

    public function getAllQueueDokter($userId) {
        return $this->antrianModel->getAllDokterQueue($userId);
    } 
}
?>
