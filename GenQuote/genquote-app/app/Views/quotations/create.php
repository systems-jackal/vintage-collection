<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="container">
    <h2>Create Quotation</h2>
    <form method="POST" action="/quotations/store" id="quotationForm">
        <input type="hidden" name="quotation_number" value="<?= $nextNum ?>">
        <div class="form-row">
            <div class="form-group">
                <label>Customer</label>
                <select name="customer_id" required>
                    <option value="">-- Select Customer --</option>
                    <?php foreach ($customers as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <a href="/customers/create" target="_blank">+ New</a>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="form-group">
                <label>Quotation #</label>
                <input type="text" value="<?= $nextNum ?>" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group"><label>Our Contact</label><input type="text" name="our_contact" value="Julius c. Malel"></div>
            <div class="form-group"><label>Our Phone</label><input type="text" name="our_contact_phone" value="0720706110"></div>
        </div>
        <div class="form-group"><label>RE (description)</label><input type="text" name="re_description" value="QUOTATION FOR NORMAL SERVICE OF GENERATOR" style="width:100%"></div>

        <h3>Items</h3>
        <table id="itemsTable" class="dynamic-table borderless">
            <thead>
                <tr>
                    <th style="width:25%">Material Name</th>
                    <th style="width:40%">Material Description</th>
                    <th style="width:10%">Qty</th>
                    <th style="width:15%">Unit</th>
                    <th style="width:15%">Unit Price (KES)</th>
                    <th style="width:15%">Total (KES)</th>
                    <th style="width:5%"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="item-row">
                    <td><input type="text" name="generator_group[]" placeholder="e.g., Solar Panel" style="width:100%"></td>
                    <td><textarea name="item_description[]" placeholder="Detailed description" rows="2" style="width:100%"></textarea></td>
                    <td><input type="number" name="item_quantity[]" class="qty" value="1" step="any" style="width:80px" required></td>
                    <td>
                        <select name="item_unit[]" class="unit-select" style="width:100px">
                            <option value="pcs">pcs</option>
                            <option value="L">L (litres)</option>
                            <option value="m">m (metres)</option>
                            <option value="kg">kg</option>
                            <option value="lump sum">lump sum</option>
                            <option value="batch">batch</option>
                            <option value="roll">roll</option>
                            <option value="box">box</option>
                            <option value="pair">pair</option>
                            <option value="set">set</option>
                            <option value="other">Other...</option>
                        </select>
                        <input type="text" name="item_unit_custom[]" class="unit-custom" placeholder="Custom unit" style="display:none; width:100px; margin-top:4px;">
                    </td>
                    <td><input type="number" name="item_unit_price[]" class="price" step="0.01" style="width:100px" required></td>
                    <td><input type="text" class="row-total" readonly style="width:100px"></td>
                    <td><button type="button" class="remove-row">✖</button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" id="addRow">+ Add Item</button>

        <div class="form-group" style="margin-top:20px">
            <label><input type="checkbox" name="vat_included" id="vatCheckbox" checked> Include VAT (16%)</label>
        </div>
        <div class="totals-section">
            <div>Subtotal: KES <span id="subtotal">0.00</span></div>
            <div id="vatDisplay">VAT (16%): KES <span id="vatAmount">0.00</span></div>
            <div class="grand-total">Total: KES <span id="grandTotal">0.00</span></div>
        </div>

        <div class="form-row">
            <div class="form-group"><label>Validity</label><input type="text" name="validity" value="1 month unless cancelled or extended in writing"></div>
            <div class="form-group"><label>Payment Terms</label><input type="text" name="payment_terms" value="Upfront payment for routine service and repair"></div>
            <div class="form-group"><label>Warranty</label><input type="text" name="warranty" value="6 months on spares"></div>
        </div>

        <button type="submit">Save & Generate PDF</button>
        <a href="/dashboard" class="cancel">Cancel</a>
    </form>
</div>
<script src="/assets/js/quotation.js"></script>
<?php include __DIR__ . '/../partials/footer.php'; ?>