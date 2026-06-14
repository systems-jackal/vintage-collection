<!DOCTYPE html>
<html>
<head>
    <title>Login - GenQuote</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <h2><i class="fas fa-file-invoice"></i> GenQuote</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>
        
        <!-- Email/Password Form -->
        <form method="POST" action="/do-login">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>

        <!-- Google Login Button -->
        <div class="google-login">
            <a href="/login/google" class="google-btn">
                <i class="fab fa-google"></i> Login with Google
            </a>
        </div>

        <div class="register-link">
            <a href="/register"><i class="fas fa-user-plus"></i> Create new account</a>
        </div>
    </div>
</body>
</html>