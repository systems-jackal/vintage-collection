<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quotation <?= htmlspecialchars($quotation['quotation_number'] ?? '') ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10.5pt;
            line-height: 1.4;
            color: #1e2a3a;
            background: white;
            padding: 0.5in 0.6in;
            margin: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }
        .company-name {
            font-size: 22pt;
            font-weight: 700;
            letter-spacing: 1px;
            color: #0f3b5c;
            margin-bottom: 6px;
        }
        .company-details {
            font-size: 9pt;
            color: #4a5568;
        }
        .quotation-title {
            font-size: 18pt;
            font-weight: 600;
            text-align: center;
            margin: 10px 0 25px;
            color: #0f3b5c;
            letter-spacing: 2px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 5px 8px;
            vertical-align: top;
            border: none;
        }
        .info-table .label {
            font-weight: 600;
            width: 100px;
            color: #2c5282;
        }
        .info-table .ref-number {
            font-family: monospace;
            background: #f7fafc;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9.5pt;
        }
        .re-line {
            text-align: center;
            text-decoration: underline;
            margin: 10px 0 15px 0;
            font-weight: 500;
            color: #2c5282;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0 20px;
        }
        .items-table th {
            text-align: left;
            padding: 12px 5px 8px 5px;
            font-weight: 600;
            color: #2c5282;
            border-bottom: 1px solid #cbd5e0;
            font-size: 10pt;
        }
        .items-table td {
            padding: 10px 5px;
            border: none;
            vertical-align: top;
        }
        .group-header td {
            background-color: #f7fafc;
            font-weight: 600;
            padding: 8px 5px 4px 5px;
            color: #1e4a76;
            font-size: 10.5pt;
        }
        .totals {
            width: 280px;
            margin-left: auto;
            margin-top: 25px;
            margin-bottom: 35px;
            border-collapse: collapse;
        }
        .totals td {
            padding: 6px 0;
            border: none;
            text-align: right;
        }
        .totals .label {
            font-weight: normal;
            padding-right: 20px;
        }
        .totals .grand-total td {
            font-weight: 700;
            font-size: 12pt;
            padding-top: 10px;
            border-top: 1px solid #a0aec0;
        }
        .terms {
            margin: 25px 0 20px;
            font-size: 9pt;
            color: #2d3748;
            border-top: 1px solid #e2e8f0;
            padding-top: 18px;
        }
        .terms p {
            margin: 4px 0;
        }
        .signature {
            margin-top: 35px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .signature-line {
            border-top: 1px solid #4a5568;
            width: 220px;
            margin-top: 35px;
            margin-bottom: 6px;
        }
        .signature-name {
            font-weight: 600;
            font-size: 9.5pt;
            color: #1e4a76;
        }
        .customer-note {
            font-size: 8pt;
            color: #718096;
            margin-top: 5px;
        }
        .footer-note {
            font-size: 8pt;
            color: #718096;
            margin-top: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <div class="company-name"><?= htmlspecialchars($settings['company_name'] ?? 'Your Company') ?></div>
        <div class="company-details">
            <?= htmlspecialchars($settings['company_phone'] ?? '') ?>
            <?php if (!empty($settings['company_email'])): ?>
                | <?= htmlspecialchars($settings['company_email']) ?>
            <?php endif; ?>
            <?php if (!empty($settings['company_address'])): ?>
                <br><?= nl2br(htmlspecialchars($settings['company_address'])) ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="quotation-title">QUOTATION</div>

    <!-- CUSTOMER INFO TABLE -->
    <table class="info-table">
        <tr>
            <td class="label">Customer:</td>
            <td><strong><?= htmlspecialchars($quotation['customer_name'] ?? 'Walk-in Customer') ?></strong></td>
            <td class="label">Date:</td>
            <td><?= date('d/m/Y', strtotime($quotation['date'] ?? 'now')) ?></td>
        </tr>
        <?php if (!empty($quotation['attention'])): ?>
        <tr>
            <td class="label">Attention:</td>
            <td><?= htmlspecialchars($quotation['attention']) ?></td>
            <td class="label">Ref:</td>
            <td><span class="ref-number"><?= htmlspecialchars($quotation['quotation_number'] ?? '') ?></span></td>
        </tr>
        <?php else: ?>
        <tr>
            <td class="label"></td>
            <td></td>
            <td class="label">Ref:</td>
            <td><span class="ref-number"><?= htmlspecialchars($quotation['quotation_number'] ?? '') ?></span></td>
        </tr>
        <?php endif; ?>
        <?php if (!empty($quotation['contact_person'])): ?>
        <tr>
            <td class="label">Contact:</td>
            <td><?= htmlspecialchars($quotation['contact_person']) ?></td>
            <td class="label">Our Contact:</td>
            <td><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name'] ?? '') ?>
                <?= !empty($quotation['our_contact_phone']) ? ' ('.htmlspecialchars($quotation['our_contact_phone']).')' : '' ?>
            </td>
        </tr>
        <?php else: ?>
        <tr>
            <td class="label"></td>
            <td></td>
            <td class="label">Our Contact:</td>
            <td><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name'] ?? '') ?>
                <?= !empty($quotation['our_contact_phone']) ? ' ('.htmlspecialchars($quotation['our_contact_phone']).')' : '' ?>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <td class="label">Address:</td>
            <td colspan="3"><?= nl2br(htmlspecialchars($quotation['address'] ?? '')) ?></td>
        </tr>
    </table>

    <!-- RE LINE (CENTERED + UNDERLINED) -->
    <?php if (!empty($quotation['re_description'])): ?>
    <div class="re-line">
        <strong>RE: <?= htmlspecialchars($quotation['re_description']) ?></strong>
    </div>
    <?php endif; ?>

    <!-- ITEMS TABLE -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width:22%">Material Name</th>
                <th style="width:38%">Material Description</th>
                <th style="width:10%">Qty</th>
                <th style="width:10%">Unit</th>
                <th style="width:20%">Unit Price (KES)</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $currentGroup = null;
        $displayedItems = [];
        foreach ($items as $item):
            $materialName = !empty($item['generator_group']) ? $item['generator_group'] : '';
            $description = $item['description'] ?? '';
            $uniqueKey = $materialName . '|' . $description . '|' . ($item['quantity'] ?? 0) . '|' . ($item['unit'] ?? '') . '|' . ($item['unit_price'] ?? 0);
            if (in_array($uniqueKey, $displayedItems)) continue;
            $displayedItems[] = $uniqueKey;
            
            if (!empty($materialName) && $materialName !== $currentGroup):
                $currentGroup = $materialName;
        ?>
            <tr class="group-header"><td colspan="5"><strong><?= htmlspecialchars($materialName) ?></strong></td></tr>
        <?php endif; ?>
            <tr>
                <td><?= htmlspecialchars($materialName) ?></td>
                <td><?= nl2br(htmlspecialchars($description)) ?></td>
                <td><?= number_format((float)($item['quantity'] ?? 0), 2) ?></td>
                <td><?= htmlspecialchars($item['unit'] ?? '') ?></td>
                <td><?= number_format((float)($item['unit_price'] ?? 0), 2) ?></td>
            </tr>
        <?php endforeach; ?>
        
        <!-- LABOUR CHARGE ROW (if present) -->
        <?php if (!empty($quotation['labour_charge']) && $quotation['labour_charge'] > 0): ?>
        <tr class="group-header"><td colspan="5"><strong>Labour & Sundries</strong></td></tr>
        <tr>
            <td>Labour Charge</td>
            <td>Installation & commissioning</td>
            <td>1.00</td>
            <td>lumpsum</td>
            <td><?= number_format((float)($quotation['labour_charge'] ?? 0), 2) ?></td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- TOTALS SECTION -->
    <table class="totals">
        <tr><td class="label">Subtotal</td><td>KES <?= number_format((float)($quotation['subtotal'] ?? 0), 2) ?></td></tr>
        <?php if (!empty($quotation['vat_included']) && (float)($quotation['vat_amount'] ?? 0) > 0): ?>
        <tr><td class="label">VAT 16%</td><td>KES <?= number_format((float)($quotation['vat_amount'] ?? 0), 2) ?></td></tr>
        <?php endif; ?>
        <tr class="grand-total"><td class="label"><strong>TOTAL</strong></td><td><strong>KES <?= number_format((float)($quotation['total'] ?? 0), 2) ?></strong></td></tr>
    </table>

    <!-- TERMS AND CONDITIONS -->
    <div class="terms">
        <p><strong>Validity:</strong> <?= nl2br(htmlspecialchars($quotation['validity'] ?? '1 month unless cancelled or extended in writing')) ?></p>
        <p><strong>Payment:</strong> <?= nl2br(htmlspecialchars($quotation['payment_terms'] ?? 'Upfront payment for routine service and repair')) ?></p>
        <p><strong>Warranty:</strong> <?= nl2br(htmlspecialchars($quotation['warranty'] ?? '6 months on spares')) ?></p>
    </div>

    <!-- SIGNATURES -->
    <div class="signature">
        <div>
            <div class="signature-line"></div>
            <div class="signature-name"><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name'] ?? '') ?></div>
            <div><?= htmlspecialchars($settings['manager_title'] ?? 'Manager') ?></div>
        </div>
        <div>
            <div class="signature-line"></div>
            <div class="signature-name">Customer confirmation</div>
            <div class="customer-note">(Signature & Date)</div>
        </div>
    </div>

    <div class="footer-note">
        <?= nl2br(htmlspecialchars($settings['footer_text'] ?? 'Thank you for your business')) ?>
    </div>
</body>
</html>