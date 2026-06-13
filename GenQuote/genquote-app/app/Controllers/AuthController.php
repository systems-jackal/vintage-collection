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

    public function registerForm() {
        include __DIR__ . '/../Views/auth/register.php';
    }

    public function register() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$name, $email, $password]);
            $_SESSION['user_id'] = $this->pdo->lastInsertId();
            $_SESSION['user_name'] = $name;
            header('Location: /dashboard');
        } catch (PDOException $e) {
            header('Location: /register?error=Email already exists');
        }
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
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