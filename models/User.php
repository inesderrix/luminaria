<?php
class User {
    public $id;
    public $name;
    public $family_name;
    public $email;

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($name, $family_name, $email) {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if($stmt->fetch()){
            return false;
        }
        $stmt = $this->pdo->prepare("INSERT INTO users (name, family_name, email) VALUES (?, ?, ?)");
        $stmt->execute([$name, $family_name, $email]);
        return $this->pdo->lastInsertId();
    }

    public function getByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }
}
?>