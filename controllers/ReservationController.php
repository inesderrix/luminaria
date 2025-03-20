<?php
require_once 'models/Reservation.php';

class ReservationController {
    private $pdo;
    private $reservationModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->reservationModel = new Reservation($pdo);
    }

    public function createReservation($user_id, $date, $time_slot, $places) {
        return $this->reservationModel->create($user_id, $date, $time_slot, $places);
    }

    public function getAllReservations() {
        return $this->reservationModel->getAll();
    }

    public function getStatsByDay() {
        return $this->reservationModel->getStatsByDay();
    }

    public function getStatsByTimeSlot() {
        return $this->reservationModel->getStatsByTimeSlot();
    }
}
?>