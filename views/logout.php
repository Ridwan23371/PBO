<?php
session_start();
require_once '../controllers/AuthController.php';

$auth = new AuthController($db);
$auth->logout();
header("Location: login.php");

?>