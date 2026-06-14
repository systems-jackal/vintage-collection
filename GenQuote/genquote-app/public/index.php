<?php
session_start();

// Flash message helper
function setFlash($key, $message) {
    $_SESSION['flash'][$key] = $message;
}
function getFlash($key) {
    if (isset($_SESSION['flash'][$key])) {
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }
    return null;
}

require_once __DIR__ . '/../config/database.php';

$request = $_SERVER['REQUEST_URI'];
$request = strtok($request, '?');
$basePath = '/index.php';
if (strpos($request, $basePath) === 0) {
    $request = substr($request, strlen($basePath));
}
if (empty($request)) $request = '/';

$publicRoutes = [
    '/login', '/do-login',
    '/register', '/do-register',
    '/login/google', '/login/google-callback'
];

if (!isset($_SESSION['user_id']) && !in_array($request, $publicRoutes)) {
    header('Location: /login');
    exit;
}

switch ($request) {
    case '/':
    case '/dashboard':
        require_once __DIR__ . '/../app/Controllers/DashboardController.php';
        (new DashboardController())->index();
        break;
    case '/login':
        require_once __DIR__ . '/../app/Controllers/AuthController.php';
        (new AuthController())->loginForm();
        break;
    case '/do-login':
        require_once __DIR__ . '/../app/Controllers/AuthController.php';
        (new AuthController())->login();
        break;
    case '/register':
        require_once __DIR__ . '/../app/Controllers/AuthController.php';
        (new AuthController())->registerForm();
        break;
    case '/do-register':
        require_once __DIR__ . '/../app/Controllers/AuthController.php';
        (new AuthController())->register();
        break;
    case '/login/google':
        require_once __DIR__ . '/../app/Controllers/AuthController.php';
        (new AuthController())->redirectToGoogle();
        break;
    case '/login/google-callback':
        require_once __DIR__ . '/../app/Controllers/AuthController.php';
        (new AuthController())->handleGoogleCallback();
        break;
    case '/logout':
        require_once __DIR__ . '/../app/Controllers/AuthController.php';
        (new AuthController())->logout();
        break;
    case '/customers':
        require_once __DIR__ . '/../app/Controllers/CustomerController.php';
        (new CustomerController())->index();
        break;
    case '/customers/create':
        require_once __DIR__ . '/../app/Controllers/CustomerController.php';
        (new CustomerController())->create();
        break;
    case '/customers/store':
        require_once __DIR__ . '/../app/Controllers/CustomerController.php';
        (new CustomerController())->store();
        break;
    case '/quotations/create':
        require_once __DIR__ . '/../app/Controllers/QuotationController.php';
        (new QuotationController())->create();
        break;
    case '/quotations/store':
        require_once __DIR__ . '/../app/Controllers/QuotationController.php';
        (new QuotationController())->store();
        break;
    case '/quotations/generate-pdf':
        require_once __DIR__ . '/../app/Controllers/QuotationController.php';
        (new QuotationController())->generatePDF();
        break;
    default:
        http_response_code(404);
        echo "404 - Page not found";
}