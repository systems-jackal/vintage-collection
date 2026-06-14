<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quotation <?= htmlspecialchars($quotation['quotation_number'] ?? '') ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Arial', 'Helvetica Neue', sans-serif;
            font-size: 9pt;
            line-height: 1.45;
            color: #1a2332;
            background: #fff;
            padding: 0.35in 0.45in;
        }
        .header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 0;
            padding-bottom: 10px;
        }
        .header-left {
            flex: 1;
        }
        .company-name {
            font-family: 'Georgia', 'Times New Roman', serif;
            font-size: 20pt;
            font-weight: 700;
            color: #0B1F3A;
            letter-spacing: -0.3px;
            line-height: 1.1;
        }
        .company-details {
            font-size: 7.5pt;
            color: #64748B;
            margin-top: 4px;
            line-height: 1.6;
        }
        .header-badge {
            text-align: right;
            padding-top: 2px;
        }
        .doc-type-label {
            font-family: 'Georgia', serif;
            font-size: 18pt;
            font-weight: 700;
            color: #0B1F3A;
            letter-spacing: 3px;
            text-transform: uppercase;
            line-height: 1;
        }
        .gold-rule {
            height: 3px;
            background: linear-gradient(to right, #C9952A, #e8b84b, #C9952A);
            margin: 10px 0 0;
            border-radius: 1px;
        }
        .navy-rule {
            height: 1px;
            background: #0B1F3A;
            margin: 0 0 12px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 24px;
            margin: 12px 0;
            padding: 10px 12px;
            background: #F7F9FC;
            border-left: 3px solid #2563EB;
            border-radius: 0 3px 3px 0;
        }
        .info-block {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .info-row {
            display: flex;
            gap: 6px;
            align-items: baseline;
            font-size: 8.5pt;
        }
        .info-label {
            font-weight: 700;
            color: #2563EB;
            min-width: 72px;
            font-size: 7.5pt;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            flex-shrink: 0;
        }
        .info-value {
            color: #1a2332;
            flex: 1;
        }
        .ref-number {
            font-family: 'Courier New', monospace;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            padding: 1px 5px;
            border-radius: 3px;
            font-size: 8pt;
            color: #1E40AF;
            letter-spacing: 0.5px;
        }
        .re-line {
            text-align: center;
            margin: 4px 0 12px;
            font-size: 9pt;
            font-weight: 600;
            color: #0B1F3A;
            letter-spacing: 0.2px;
            text-decoration: none;
            border-bottom: 1px dashed #CBD5E1;
            padding-bottom: 8px;
        }
        .re-line::before {
            content: 'RE: ';
            color: #2563EB;
            font-size: 7.5pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 0 12px;
        }
        .items-table thead tr {
            background: #0B1F3A;
        }
        .items-table th {
            text-align: left;
            padding: 6px 7px;
            font-weight: 700;
            font-size: 7.5pt;
            color: #fff;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }
        .items-table th:not(:first-child) {
            text-align: right;
        }
        .items-table tbody tr:nth-child(even):not(.group-header) td {
            background-color: #F7F9FC;
        }
        .items-table td {
            padding: 5px 7px;
            border-bottom: 1px solid #E2E8F0;
            vertical-align: top;
            font-size: 8.5pt;
        }
        .items-table td:not(:first-child) {
            text-align: right;
        }
        .group-header td {
            background: #EFF6FF !important;
            font-weight: 700;
            font-size: 8.5pt;
            color: #1E3A5F;
            padding: 5px 7px 4px;
            border-bottom: 1px solid #BFDBFE;
            border-top: 1px solid #BFDBFE;
            letter-spacing: 0.3px;
        }
        .group-header td::before {
            content: '▸ ';
            color: #C9952A;
            font-size: 8pt;
        }
        .totals-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 18px;
        }
        .totals {
            min-width: 240px;
            border-collapse: collapse;
        }
        .totals td {
            padding: 3px 6px;
            text-align: right;
            font-size: 8.5pt;
        }
        .totals .t-label {
            color: #64748B;
            font-size: 8pt;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding-right: 16px;
        }
        .totals .t-value {
            color: #1a2332;
            min-width: 100px;
        }
        .totals .grand-total td {
            font-weight: 700;
            font-size: 10pt;
            padding-top: 7px;
            padding-bottom: 5px;
            color: #0B1F3A;
        }
        .grand-total-row {
            border-top: 2px solid #0B1F3A;
        }
        .grand-total-row td {
            background: #F7F9FC;
        }
        .terms {
            margin: 0 0 16px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            border-top: 1px solid #E2E8F0;
            padding-top: 10px;
        }
        .term-block {
            background: #F7F9FC;
            border-radius: 3px;
            padding: 7px 9px;
            border-top: 2px solid #2563EB;
        }
        .term-label {
            font-size: 7pt;
            font-weight: 700;
            color: #2563EB;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 3px;
        }
        .term-value {
            font-size: 8pt;
            color: #334155;
            line-height: 1.4;
        }
        .signature-section {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            margin-top: 18px;
        }
        .sig-block {
            flex: 1;
        }
        .sig-name {
            font-weight: 700;
            font-size: 9pt;
            color: #0B1F3A;
            margin-bottom: 24px;
        }
        .sig-line {
            border-top: 1px solid #94A3B8;
            width: 100%;
            margin-bottom: 4px;
        }
        .sig-title {
            font-size: 7.5pt;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .footer-note {
            margin-top: 18px;
            border-top: 1px solid #E2E8F0;
            padding-top: 8px;
            text-align: center;
            font-size: 7.5pt;
            color: #94A3B8;
        }
        @media print {
            body { padding: 0.3in 0.4in; }
            .items-table thead tr { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .group-header td, .grand-total-row td, .info-grid, .term-block {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <div class="company-name"><?= htmlspecialchars($settings['company_name'] ?? 'Your Company') ?></div>
            <div class="company-details">
                <?= htmlspecialchars($settings['company_phone'] ?? '') ?>
                <?php if (!empty($settings['company_email'])): ?> &nbsp;|&nbsp; <?= htmlspecialchars($settings['company_email']) ?><?php endif; ?>
                <?php if (!empty($settings['company_address'])): ?><br><?= nl2br(htmlspecialchars($settings['company_address'])) ?><?php endif; ?>
            </div>
        </div>
        <div class="header-badge">
            <div class="doc-type-label">Quotation</div>
        </div>
    </div>
    <div class="gold-rule"></div>
    <div class="navy-rule"></div>

    <div class="info-grid">
        <div class="info-block">
            <div class="info-row">
                <span class="info-label">Customer</span>
                <span class="info-value"><?= htmlspecialchars($quotation['customer_name'] ?? '') ?></span>
            </div>
            <?php if (!empty($quotation['attention'])): ?>
            <div class="info-row">
                <span class="info-label">Attention</span>
                <span class="info-value"><?= htmlspecialchars($quotation['attention']) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($quotation['contact_person'])): ?>
            <div class="info-row">
                <span class="info-label">Contact</span>
                <span class="info-value"><?= htmlspecialchars($quotation['contact_person']) ?></span>
            </div>
            <?php endif; ?>
            <div class="info-row">
                <span class="info-label">Address</span>
                <span class="info-value"><?= nl2br(htmlspecialchars($quotation['address'] ?? '')) ?></span>
            </div>
        </div>
        <div class="info-block" style="text-align:right; align-items: flex-end;">
            <div class="info-row" style="justify-content: flex-end;">
                <span class="info-label" style="min-width:auto; margin-right:6px;">Date</span>
                <span class="info-value" style="flex:none;"><?= date('d/m/Y', strtotime($quotation['date'] ?? 'now')) ?></span>
            </div>
            <div class="info-row" style="justify-content: flex-end;">
                <span class="info-label" style="min-width:auto; margin-right:6px;">Ref</span>
                <span class="info-value" style="flex:none;"><span class="ref-number"><?= htmlspecialchars($quotation['quotation_number'] ?? '') ?></span></span>
            </div>
            <div class="info-row" style="justify-content: flex-end;">
                <span class="info-label" style="min-width:auto; margin-right:6px;">Our Contact</span>
                <span class="info-value" style="flex:none;"><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name'] ?? '') ?></span>
            </div>
            <div class="info-row" style="justify-content: flex-end;">
                <span class="info-label" style="min-width:auto; margin-right:6px;">Mobile</span>
                <span class="info-value" style="flex:none;"><?= htmlspecialchars($quotation['our_contact_phone'] ?? '') ?></span>
            </div>
        </div>
    </div>

    <?php if (!empty($quotation['re_description'])): ?>
    <div class="re-line"><?= htmlspecialchars($quotation['re_description']) ?></div>
    <?php endif; ?>

    <?php
    // Merge duplicate items
    $mergedItems = [];
    if (!empty($items)) {
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
    }
    ?>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width:46%">Material Description</th>
                <th style="width:18%; text-align:right;">Qty / Unit</th>
                <th style="width:18%; text-align:right;">Unit Price (KES)</th>
                <th style="width:18%; text-align:right;">Total (KES)</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $currentGroup = null;
        if (!empty($mergedItems)):
            foreach ($mergedItems as $item):
                $materialName = $item['generator_group'] ?? '';
                $description  = $item['description'] ?? '';
                $qty          = $item['quantity'];
                $unit         = $item['unit'];
                $unitPrice    = $item['unit_price'];
                $total        = $item['total'];

                $qtyUnit = number_format((float)$qty, 2);
                if (!empty($unit)) {
                    $qtyUnit .= ' ' . $unit;
                }

                if (!empty($materialName) && $materialName !== $currentGroup):
                    $currentGroup = $materialName;
        ?>
            <tr class="group-header"><td colspan="4"><?= htmlspecialchars($materialName) ?></td></tr>
        <?php endif; ?>
            <tr>
                <td><?= htmlspecialchars($description) ?></td>
                <td><?= htmlspecialchars($qtyUnit) ?></td>
                <td><?= number_format((float)$unitPrice, 2) ?></td>
                <td><?= number_format((float)$total, 2) ?></td>
            </tr>
        <?php
            endforeach;
        endif;
        ?>
        </tbody>
    </table>

    <div class="totals-wrapper">
        <table class="totals">
            <tr>
                <td class="t-label">Sub-Total</td>
                <td class="t-value">KES <?= number_format((float)($quotation['subtotal'] ?? 0), 2) ?></td>
            </tr>
            <?php if (!empty($quotation['vat_included']) && (float)($quotation['vat_amount'] ?? 0) > 0): ?>
            <tr>
                <td class="t-label">VAT 16%</td>
                <td class="t-value">KES <?= number_format((float)($quotation['vat_amount'] ?? 0), 2) ?></td>
            </tr>
            <?php endif; ?>
            <tr class="grand-total grand-total-row">
                <td class="t-label" style="font-weight:700; color:#0B1F3A;">Total</td>
                <td class="t-value" style="font-weight:700; color:#0B1F3A;">KES <?= number_format((float)($quotation['total'] ?? 0), 2) ?></td>
            </tr>
        </table>
    </div>

    <div class="terms">
        <div class="term-block">
            <div class="term-label">Validity</div>
            <div class="term-value"><?= nl2br(htmlspecialchars($quotation['validity'] ?? '1 month unless cancelled or extended in writing')) ?></div>
        </div>
        <div class="term-block">
            <div class="term-label">Payment</div>
            <div class="term-value"><?= nl2br(htmlspecialchars($quotation['payment_terms'] ?? 'Upfront payment for routine service and repair')) ?></div>
        </div>
        <div class="term-block">
            <div class="term-label">Warranty</div>
            <div class="term-value"><?= nl2br(htmlspecialchars($quotation['warranty'] ?? '6 months on spares')) ?></div>
        </div>
    </div>

    <div class="signature-section">
        <div class="sig-block">
            <div class="sig-name"><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name'] ?? '') ?></div>
            <div class="sig-line"></div>
            <div class="sig-title"><?= htmlspecialchars($settings['manager_title'] ?? 'Manager') ?></div>
        </div>
        <div class="sig-block">
            <div class="sig-name">Customer Confirmation</div>
            <div class="sig-line"></div>
            <div class="sig-title">Authorized Signature &amp; Date</div>
        </div>
    </div>

    <div class="footer-note">
        <?= nl2br(htmlspecialchars($settings['footer_text'] ?? 'Thank you for your business')) ?>
    </div>
</body>
</html>