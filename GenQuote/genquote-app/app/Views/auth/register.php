<!DOCTYPE html>
<html>
<head>
    <title>Register - GenQuote</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" href="https://favicon.io/emoji-favicons/⚡/">
</head>
<body class="login-page">
    <div class="login-container">
        <h2><i class="fas fa-user-plus"></i> Create Account</h2>
        <?php $error = getFlash('error'); if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="/do-register">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit"><i class="fas fa-check-circle"></i> Register</button>
        </form>
        <div class="register-link">
            <a href="/login"><i class="fas fa-sign-in-alt"></i> Already have an account? Login</a>
        </div>
    </div>
</body>
</html>