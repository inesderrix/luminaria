<?php
session_start();
require_once 'config/config.php';
require_once 'controllers/AdminController.php';
require_once 'config/api.php';

$adminController = new AdminController($pdo);

if(isset($_POST['admin_login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $token = $adminController->login($email, $password);
    if($token){
        $_SESSION['admin_token'] = $token;
    } else {
        $error = "Identifiants incorrects.";
        include 'views/admin_login.php';
        exit;
    }
}

if(!isset($_SESSION['admin_token']) || !JWT::decode($_SESSION['admin_token'])){
    include 'views/admin_login.php';
    exit;
}

$users = $adminController->getUsers();
$reservations = $adminController->getReservations();
$statsByDay = $adminController->getStatsByDay();
$statsByTimeSlot = $adminController->getStatsByTimeSlot();

include 'views/admin_dashboard.php';
?>