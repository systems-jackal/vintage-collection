<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quotation <?= htmlspecialchars($quotation['quotation_number'] ?? '') ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9.5pt;
            line-height: 1.3;
            color: #1a1a1a;
            background: white;
            padding: 0.3in 0.4in;
            margin: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 6px;
            border-bottom: 1px solid #ccc;
        }
        .company-name {
            font-size: 18pt;
            font-weight: 700;
            color: #0f3b5c;
            margin-bottom: 4px;
        }
        .company-details {
            font-size: 8pt;
            color: #555;
        }
        .quotation-title {
            font-size: 14pt;
            font-weight: 600;
            text-align: center;
            margin: 10px 0 12px;
            color: #0f3b5c;
        }
        .info-table {
            width: 100%;
            margin-bottom: 12px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 2px 5px;
            vertical-align: top;
            border: none;
        }
        .info-table .label {
            font-weight: 600;
            width: 80px;
            color: #2c5282;
        }
        .info-table .right-label {
            font-weight: 600;
            color: #2c5282;
            text-align: right;
            padding-right: 10px;
        }
        .info-table .right-value {
            text-align: left;
            width: 40%;
        }
        .ref-number {
            font-family: monospace;
            background: #f7fafc;
            padding: 1px 4px;
            border-radius: 3px;
        }
        .re-line {
            text-align: center;
            text-decoration: underline;
            margin: 5px 0 12px;
            font-weight: 500;
            font-size: 9.5pt;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0 12px;
        }
        .items-table th {
            text-align: left;
            padding: 5px 4px 4px 4px;
            font-weight: 600;
            border-bottom: 1px solid #cbd5e0;
            font-size: 8.5pt;
            color: #2c5282;
        }
        .items-table td {
            padding: 5px 4px;
            border: none;
            vertical-align: top;
            font-size: 9pt;
        }
        .group-header td {
            background-color: #f7fafc;
            font-weight: 600;
            padding: 5px 4px 3px 4px;
            color: #1e4a76;
            font-size: 9.5pt;
        }
        .totals {
            width: 250px;
            margin-left: auto;
            margin-top: 12px;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .totals td {
            padding: 3px 0;
            text-align: right;
            font-size: 9pt;
        }
        .totals .label {
            padding-right: 15px;
        }
        .totals .grand-total td {
            font-weight: 700;
            font-size: 10pt;
            padding-top: 6px;
            border-top: 1px solid #aaa;
        }
        .terms {
            margin: 12px 0 15px;
            font-size: 8pt;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
        .terms p {
            margin: 2px 0;
        }
        .signature-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 20px;
            gap: 20px;
        }
        .signature-left, .signature-right {
            flex: 1;
        }
        .signature-line {
            border-top: 1px solid #4a5568;
            width: 100%;
            margin-top: 8px;
            margin-bottom: 4px;
        }
        .signature-name {
            font-weight: 600;
            font-size: 9pt;
            margin-bottom: 2px;
        }
        .signature-title {
            font-size: 8pt;
            color: #555;
        }
        .footer-note {
            font-size: 7.5pt;
            text-align: center;
            margin-top: 20px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
            color: #718096;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name"><?= htmlspecialchars($settings['company_name'] ?? 'Your Company') ?></div>
        <div class="company-details">
            <?= htmlspecialchars($settings['company_phone'] ?? '') ?>
            <?php if (!empty($settings['company_email'])): ?> | <?= htmlspecialchars($settings['company_email']) ?><?php endif; ?>
            <?php if (!empty($settings['company_address'])): ?><br><?= nl2br(htmlspecialchars($settings['company_address'])) ?><?php endif; ?>
        </div>
    </div>

    <div class="quotation-title">QUOTATION</div>

    <!-- INFO TABLE (left vs right) -->
    <table class="info-table">
        <tr>
            <td class="label">Customer:<?= !empty($quotation['customer_name']) ? '' : ' ' ?> </td>
            <td><?= htmlspecialchars($quotation['customer_name'] ?? '') ?></td>
            <td class="right-label">Date:</td>
            <td class="right-value"><?= date('d/m/Y', strtotime($quotation['date'] ?? 'now')) ?></td>
        </tr>
        <?php if (!empty($quotation['attention'])): ?>
        <tr>
            <td class="label">Attention:</td>
            <td><?= htmlspecialchars($quotation['attention']) ?></td>
            <td class="right-label">Ref:</td>
            <td class="right-value"><span class="ref-number"><?= htmlspecialchars($quotation['quotation_number'] ?? '') ?></span></td>
        </tr>
        <?php else: ?>
        <tr>
            <td class="label"></td><td></td>
            <td class="right-label">Ref:</td>
            <td class="right-value"><span class="ref-number"><?= htmlspecialchars($quotation['quotation_number'] ?? '') ?></span></td>
        </tr>
        <?php endif; ?>
        <?php if (!empty($quotation['contact_person'])): ?>
        <tr>
            <td class="label">Contact:</td>
            <td><?= htmlspecialchars($quotation['contact_person']) ?></td>
            <td class="right-label">Our Contact:</td>
            <td class="right-value"><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name'] ?? '') ?></td>
        </tr>
        <?php else: ?>
        <tr>
            <td class="label"></td><td></td>
            <td class="right-label">Our Contact:</td>
            <td class="right-value"><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name'] ?? '') ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td class="label"></td><td></td>
            <td class="right-label">Mobile No:</td>
            <td class="right-value"><?= htmlspecialchars($quotation['our_contact_phone'] ?? '') ?></td>
        </tr>
        <tr>
            <td class="label">Address:</td>
            <td colspan="3"><?= nl2br(htmlspecialchars($quotation['address'] ?? '')) ?></td>
        </tr>
    </table>

    <?php if (!empty($quotation['re_description'])): ?>
    <div class="re-line">RE: <?= htmlspecialchars($quotation['re_description']) ?></div>
    <?php endif; ?>

    <!-- MERGE DUPLICATE ITEMS (same description, unit, price) -->
    <?php
    $mergedItems = [];
    foreach ($items as $item) {
        $group = $item['generator_group'] ?? '';
        $desc = $item['description'] ?? '';
        $unit = $item['unit'] ?? '';
        $price = (float)($item['unit_price'] ?? 0);
        $key = $group . '|' . $desc . '|' . $unit . '|' . $price;
        if (isset($mergedItems[$key])) {
            $mergedItems[$key]['quantity'] += (float)($item['quantity'] ?? 0);
            $mergedItems[$key]['total'] = $mergedItems[$key]['quantity'] * $price;
        } else {
            $mergedItems[$key] = [
                'generator_group' => $group,
                'description' => $desc,
                'quantity' => (float)($item['quantity'] ?? 0),
                'unit' => $unit,
                'unit_price' => $price,
                'total' => (float)($item['total'] ?? 0)
            ];
        }
    }
    ?>

    <!-- ITEMS TABLE with Qty+Unit combined -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width:45%">MATERIAL DESCRIPTION</th>
                <th style="width:20%">QTY/UNIT</th>
                <th style="width:17%">UNIT PRICE (KES)</th>
                <th style="width:18%">TOTAL (KES)</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $currentGroup = null;
        foreach ($mergedItems as $item):
            $materialName = !empty($item['generator_group']) ? $item['generator_group'] : '';
            $description = $item['description'] ?? '';
            $qty = $item['quantity'];
            $unit = $item['unit'];
            $unitPrice = $item['unit_price'];
            $total = $item['total'];
            
            // Combine quantity and unit (e.g., "2 pcs", "25 L", "10 m")
            $qtyUnit = number_format((float)$qty, 2);
            if (!empty($unit)) {
                $qtyUnit .= ' ' . $unit;
            }
            
            if (!empty($materialName) && $materialName !== $currentGroup):
                $currentGroup = $materialName;
        ?>
            <tr class="group-header"><td colspan="4"><strong><?= htmlspecialchars($materialName) ?></strong></td></tr>
        <?php endif; ?>
            <tr>
                <td><?= htmlspecialchars($description) ?></td>
                <td><?= htmlspecialchars($qtyUnit) ?></td>
                <td><?= number_format((float)$unitPrice, 2) ?></td>
                <td><?= number_format((float)$total, 2) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <table class="totals">
        <tr><td class="label">SUB-TOTAL</td><td>KES <?= number_format((float)($quotation['subtotal'] ?? 0), 2) ?></td></tr>
        <?php if (!empty($quotation['vat_included']) && (float)($quotation['vat_amount'] ?? 0) > 0): ?>
        <tr><td class="label">VAT 16%</td><td>KES <?= number_format((float)($quotation['vat_amount'] ?? 0), 2) ?></td></tr>
        <?php endif; ?>
        <tr class="grand-total"><td class="label"><strong>TOTAL</strong></td><td><strong>KES <?= number_format((float)($quotation['total'] ?? 0), 2) ?></strong></td></tr>
    </table>

    <div class="terms">
        <p><strong>Validity:</strong> <?= nl2br(htmlspecialchars($quotation['validity'] ?? '1 month unless cancelled or extended in writing')) ?></p>
        <p><strong>Payment:</strong> <?= nl2br(htmlspecialchars($quotation['payment_terms'] ?? 'Upfront payment for routine service and repair')) ?></p>
        <p><strong>Warranty:</strong> <?= nl2br(htmlspecialchars($quotation['warranty'] ?? '6 months on spares')) ?></p>
    </div>

    <div class="signature-row">
        <div class="signature-left">
            <div class="signature-name"><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name'] ?? '') ?></div>
            <div class="signature-line"></div>
            <div class="signature-title"><?= htmlspecialchars($settings['manager_title'] ?? 'Manager') ?></div>
        </div>
        <div class="signature-right">
            <div class="signature-name">Customer confirmation</div>
            <div class="signature-line"></div>
        </div>
    </div>

    <div class="footer-note">
        <?= nl2br(htmlspecialchars($settings['footer_text'] ?? 'Thank you for your business')) ?>
    </div>
</body>
</html>