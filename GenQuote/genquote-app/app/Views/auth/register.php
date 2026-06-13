<!DOCTYPE html>
<html>
<head>
    <title>Register - GenQuote</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <h2>Create Account</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>
        <form method="POST" action="/do-register">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <div style="text-align:center; margin-top:15px;">
            <a href="/login">Already have an account? Login</a>
        </div>
    </div>
</body>
</html>