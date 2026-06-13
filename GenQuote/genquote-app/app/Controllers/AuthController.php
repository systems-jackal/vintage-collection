<?php
class AuthController {
    private $pdo;
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
    public function loginForm() {
        include __DIR__ . '/../Views/auth/login.php';
    }
    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: /dashboard');
        } else {
            header('Location: /login?error=Invalid credentials');
        }
    }
    public function logout() {
        session_destroy();
        header('Location: /login');
    }
}