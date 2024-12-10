<?php 
require_once '../models/Resep.php';

class ResepController {
    private $resepModel;
    public function __construct($db) {
        $this->resepModel = new Resep($db);
    }
    public function add($pasienId, $dokterId, $obat, $ketentuan) {
        $this->resepModel->add($pasienId, $dokterId, $obat, $ketentuan);
    }

    public function getByPasienId($pasienId) {
        return $this->resepModel->getByPasienId($pasienId);
    }
}

?>