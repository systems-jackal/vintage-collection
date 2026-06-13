<?php include 'partials/header.php'; ?>
<div class="dashboard">
    <h2>Welcome, <?= $_SESSION['user_name'] ?>!</h2>
    <div class="cards">
        <a href="/quotations/create" class="card">+ New Quotation</a>
        <a href="/customers" class="card">Customers</a>
        <a href="/logout" class="card logout">Logout</a>
    </div>
</div>
<?php include 'partials/footer.php'; ?>