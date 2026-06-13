<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="container">
    <h2>Add Customer</h2>
    <form method="POST" action="/customers/store">
        <div class="form-group">
            <label>Name *</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Attention (e.g., Finance Manager)</label>
            <input type="text" name="attention">
        </div>
        <div class="form-group">
            <label>Contact Person (e.g., Mr. Daniel)</label>
            <input type="text" name="contact_person">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email">
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea name="address"></textarea>
        </div>
        <button type="submit">Save</button>
        <a href="/customers" class="cancel">Cancel</a>
    </form>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>