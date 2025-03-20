<?php
require_once 'models/User.php';

class UserController {
    private $pdo;
    private $userModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
    }

    public function register($name, $family_name, $email) {
        return $this->userModel->create($name, $family_name, $email);
    }

    public function getUserByEmail($email) {
        return $this->userModel->getByEmail($email);
    }

    public function getAllUsers() {
        return $this->userModel->getAll();
    }

    public function updateUserInfo($id, $name, $family_name) {
        $sql = "UPDATE users SET name = :name, family_name = :family_name WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':family_name' => $family_name,
            ':id' => $id
        ]);
    }
    
}
?>