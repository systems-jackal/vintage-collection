<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="container">
    <h2>Customers</h2>
    <a href="/customers/create" class="btn">+ Add Customer</a>
    <table class="data-table borderless">
        <thead>
            <tr><th>Name</th><th>Attention</th><th>Contact Person</th><th>Phone</th><th>Email</th><th>Address</th><th></th></tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['name']) ?></td>
                <td><?= htmlspecialchars($c['attention']) ?></td>
                <td><?= htmlspecialchars($c['contact_person']) ?></td>
                <td><?= htmlspecialchars($c['phone']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td><?= htmlspecialchars($c['address']) ?></td>
                <td><a href="#">Edit</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>