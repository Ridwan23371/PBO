<?php 
    session_start();
    require_once '../controllers/AntrianController.php';

    $controller = new AntrianController($db);
    $antrian = $controller->getAllQueueDokter($_SESSION['user_id']);
    echo '<script>console.log(' . $_SESSION['user_id'] . ');</script>';
    echo '<script>console.log(' . json_encode($antrian) . ');</script>';

?>