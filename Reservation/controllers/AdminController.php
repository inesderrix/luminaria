<?php
require_once 'models/Admin.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ReservationController.php';
require_once 'config/api.php';

class AdminController {
    private $adminModel;
    private $userController;
    private $reservationController;

    public function __construct($pdo) {
        $this->adminModel = new Admin();
        $this->userController = new UserController($pdo);
        $this->reservationController = new ReservationController($pdo);
    }

    public function login($email, $password) {
        if ($this->adminModel->login($email, $password)) {
            $token = JWT::encode(['admin' => true, 'email' => $email]);
            return $token;
        }
        return false;
    }

    public function getUsers() {
        return $this->userController->getAllUsers();
    }

    public function getReservations() {
        return $this->reservationController->getAllReservations();
    }

    public function getStatsByDay() {
        return $this->reservationController->getStatsByDay();
    }

    public function getStatsByTimeSlot() {
        return $this->reservationController->getStatsByTimeSlot();
    }
}
?>