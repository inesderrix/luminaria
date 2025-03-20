<?php
class Admin {
    private $adminEmail = 'luminaria@gmail.com';
    private $adminPassword = 'ada_lovelace';

    public function login($email, $password) {
        if ($email === $this->adminEmail && $password === $this->adminPassword) {
            return true;
        }
        return false;
    }
}
?>