function updateTotals() {
    let subtotal = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const qty = parseFloat(row.querySelector('.qty').value) || 0;
        const price = parseFloat(row.querySelector('.price').value) || 0;
        const total = qty * price;
        row.querySelector('.row-total').value = total.toFixed(2);
        subtotal += total;
    });
    document.getElementById('subtotal').innerText = subtotal.toFixed(2);
    const vatChecked = document.getElementById('vatCheckbox').checked;
    const vatAmount = vatChecked ? subtotal * 0.16 : 0;
    document.getElementById('vatAmount').innerText = vatAmount.toFixed(2);
    document.getElementById('vatDisplay').style.display = vatChecked ? 'block' : 'none';
    const grandTotal = subtotal + vatAmount;
    document.getElementById('grandTotal').innerText = grandTotal.toFixed(2);
}

function addRow() {
    const tbody = document.querySelector('#itemsTable tbody');
    const newRow = document.createElement('tr');
    newRow.className = 'item-row';
    newRow.innerHTML = `
        <td><input type="text" name="generator_group[]" placeholder="e.g., Solar Panel" style="width:100%"></td>
        <td><textarea name="item_description[]" placeholder="Detailed description (model, specs, etc.)" rows="2" style="width:100%"></textarea></td>
        <td><input type="number" name="item_quantity[]" class="qty" value="1" step="any" style="width:80px" required></td>
        <td><input type="text" name="item_unit[]" placeholder="pcs" style="width:80px"></td>
        <td><input type="number" name="item_unit_price[]" class="price" step="0.01" style="width:100px" required></td>
        <td><input type="text" class="row-total" readonly style="width:100px"></td>
        <td><button type="button" class="remove-row">✖</button></td>
    `;
    tbody.appendChild(newRow);
    attachEvents(newRow);
    updateTotals();
}

function attachEvents(row) {
    row.querySelector('.qty').addEventListener('input', updateTotals);
    row.querySelector('.price').addEventListener('input', updateTotals);
    row.querySelector('.remove-row').addEventListener('click', () => {
        if (document.querySelectorAll('.item-row').length > 1) {
            row.remove();
            updateTotals();
        } else alert("At least one item is required");
    });
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.item-row').forEach(row => attachEvents(row));
    document.getElementById('addRow').addEventListener('click', addRow);
    document.getElementById('vatCheckbox').addEventListener('change', updateTotals);
    updateTotals();
});