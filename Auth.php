<?php
class Auth {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=authentication', 'root', '');

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function register($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashedPassword]);
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // User is authenticated
            $_SESSION['user_id'] = $user['id'];
            return true;
        }

        return false;
    }

    public function logout() {
        unset($_SESSION['user_id']);
    }

    public function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }
}
