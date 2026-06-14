<?php include 'partials/header.php'; ?>
<div class="dashboard">
    <h2><i class="fas fa-tachometer-alt"></i> Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h2>
    <div class="cards">
        <a href="/quotations/create" class="card">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>New Quotation</span>
        </a>
        <a href="/customers" class="card">
            <i class="fas fa-users"></i>
            <span>Customers</span>
        </a>
        <a href="/logout" class="card logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>
</div>
<?php include 'partials/footer.php'; ?>