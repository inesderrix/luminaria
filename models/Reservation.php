<?php
class Reservation {
    public $id;
    public $user_id;
    public $date;
    public $time_slot;
    public $places;

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($user_id, $date, $time_slot, $places) {
        $stmt = $this->pdo->prepare("INSERT INTO reservations (user_id, date, time_slot, places) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$user_id, $date, $time_slot, $places]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT r.*, u.name, u.family_name, u.email FROM reservations r JOIN users u ON r.user_id = u.id ORDER BY r.date, r.time_slot");
        return $stmt->fetchAll();
    }

    public function getStatsByDay() {
        $stmt = $this->pdo->query("SELECT date, COUNT(*) as total_reservations FROM reservations GROUP BY date ORDER BY date");
        return $stmt->fetchAll();
    }

    public function getStatsByTimeSlot() {
        $stmt = $this->pdo->query("SELECT time_slot, COUNT(*) as total_reservations FROM reservations GROUP BY time_slot ORDER BY time_slot");
        return $stmt->fetchAll();
    }
}
?>