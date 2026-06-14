<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use League\OAuth2\Client\Provider\Google;

class AuthController {
    private $pdo;
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    private function getGoogleProvider() {
        return new Google([
            'clientId'     => getenv('GOOGLE_CLIENT_ID'),
            'clientSecret' => getenv('GOOGLE_CLIENT_SECRET'),
            'redirectUri'  => getenv('GOOGLE_REDIRECT_URI'),
        ]);
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
            exit;
        } catch (PDOException $e) {
            setFlash('error', 'Email already exists. Please login or use a different email.');
            header('Location: /register');
            exit;
        }
    }

    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and has a password (not Google-only)
        if ($user && !empty($user['password']) && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: /dashboard');
            exit;
        } else {
            setFlash('error', 'Invalid email/password or account may use Google login.');
            header('Location: /login');
            exit;
        }
    }

    public function redirectToGoogle() {
        $provider = $this->getGoogleProvider();
        $authUrl = $provider->getAuthorizationUrl();
        $_SESSION['oauth2state'] = $provider->getState();
        header('Location: ' . $authUrl);
        exit;
    }

    public function handleGoogleCallback() {
        if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            setFlash('error', 'Invalid Google authentication state.');
            header('Location: /login');
            exit;
        }

        $provider = $this->getGoogleProvider();
        try {
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);
            $googleUser = $provider->getResourceOwner($token);

            // Check if user exists by google_id or email
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE google_id = ? OR email = ?");
            $stmt->execute([$googleUser->getId(), $googleUser->getEmail()]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Update google_id if missing, and last_login
                $upd = $this->pdo->prepare("UPDATE users SET google_id = ?, avatar = ?, last_login = NOW() WHERE id = ?");
                $upd->execute([$googleUser->getId(), $googleUser->getAvatar(), $user['id']]);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
            } else {
                // Create new user
                $stmt = $this->pdo->prepare("INSERT INTO users (name, email, google_id, avatar, role, last_login) VALUES (?, ?, ?, ?, 'user', NOW())");
                $stmt->execute([$googleUser->getName(), $googleUser->getEmail(), $googleUser->getId(), $googleUser->getAvatar()]);
                $_SESSION['user_id'] = $this->pdo->lastInsertId();
                $_SESSION['user_name'] = $googleUser->getName();
            }

            header('Location: /dashboard');
            exit;
        } catch (Exception $e) {
            setFlash('error', 'Google login failed. Please try again.');
            header('Location: /login');
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
        exit;
    }
}