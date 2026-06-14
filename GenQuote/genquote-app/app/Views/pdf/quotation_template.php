<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quotation <?= htmlspecialchars($quotation['quotation_number'] ?? '') ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Arial', 'Helvetica Neue', sans-serif;
            font-size: 9.5pt;
            line-height: 1.45;
            color: #1C2B3A;
            background: #fff;
            padding: 0.35in 0.45in 0.4in;
        }

        /* ══ HEADER ══════════════════════════════════════════════ */
        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .company-name {
            font-size: 22pt;
            font-weight: 800;
            color: #0D3B6E;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            display: inline-block;
            border-bottom: 3px solid #C9952A;
            padding-bottom: 4px;
        }

        .company-details {
            font-size: 8pt;
            color: #5A6A7A;
            margin-top: 5px;
        }

        .logo-strip {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 10px 0 0;
            padding: 7px 10px;
            border-top: 1px solid #E2E8F0;
            border-bottom: 1px solid #E2E8F0;
            flex-wrap: wrap;
        }

        .logo-strip img {
            height: 28px;
            object-fit: contain;
            opacity: 0.85;
        }

        /* ══ DOC TITLE ═══════════════════════════════════════════ */
        .doc-title-row {
            text-align: center;
            margin: 12px 0 10px;
        }

        .doc-title {
            display: inline-block;
            font-size: 13pt;
            font-weight: 700;
            letter-spacing: 4px;
            color: #fff;
            background: #0D3B6E;
            padding: 5px 28px;
            border-radius: 2px;
        }

        /* ══ INFO TABLE ══════════════════════════════════════════ */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 9pt;
        }

        .info-table td { padding: 2.5px 4px; vertical-align: top; }
        .info-table .lbl  { font-weight: 700; color: #0D3B6E; width: 72px; white-space: nowrap; }
        .info-table .val  { color: #1C2B3A; }
        .info-table .rlbl { font-weight: 700; color: #0D3B6E; text-align: right; padding-right: 8px; white-space: nowrap; }
        .info-table .rval { color: #1C2B3A; width: 38%; }

        .ref-pill {
            display: inline-block;
            font-family: 'Courier New', monospace;
            font-size: 8.5pt;
            background: #EBF4FF;
            border: 1px solid #90C4F0;
            color: #0D3B6E;
            padding: 1px 6px;
            border-radius: 3px;
            letter-spacing: 0.5px;
        }

        /* ══ RE LINE ═════════════════════════════════════════════ */
        .re-line {
            text-align: center;
            font-weight: 700;
            font-size: 9.5pt;
            color: #0D3B6E;
            letter-spacing: 0.3px;
            text-decoration: underline;
            text-underline-offset: 3px;
            margin: 8px 0 12px;
        }

        /* ══ ITEMS TABLE — ALL IN ONE ROW ════════════════════════
           Columns: No. | Generator / Description | Qty | Unit Price | Total
        ══════════════════════════════════════════════════════════ */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin-bottom: 0;
        }

        /* Header row */
        .items-table thead tr { background: #0D3B6E; }

        .items-table th {
            padding: 6px 7px;
            font-weight: 700;
            font-size: 7.8pt;
            color: #fff;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            text-align: left;
        }

        .items-table th.r { text-align: right; }

        /* Group / generator name row */
        .gen-row td {
            background: #EBF4FF;
            font-weight: 700;
            font-size: 9.5pt;
            color: #0D3B6E;
            padding: 5px 7px;
            border-top: 1.5px solid #90C4F0;
            border-bottom: 1px solid #BDD6F5;
        }

        .gen-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 17px;
            height: 17px;
            background: #0D3B6E;
            color: #fff;
            border-radius: 50%;
            font-size: 7.5pt;
            font-weight: 700;
            margin-right: 6px;
            vertical-align: middle;
            flex-shrink: 0;
        }

        /* Item rows */
        .item-row td {
            padding: 4.5px 7px;
            border-bottom: 1px solid #E8EFF7;
            vertical-align: middle;
            color: #2D3F50;
        }

        .item-row:nth-child(even) td { background: #F8FBFF; }

        /* Number cell */
        .cell-no {
            width: 26px;
            text-align: center;
            color: #8899AA;
            font-size: 8pt;
            white-space: nowrap;
        }

        /* Material name cell — bold, navy */
        .cell-material {
            font-weight: 700;
            color: #0D3B6E;
            white-space: nowrap;
        }

        /* Description cell */
        .cell-desc {
            color: #2D3F50;
        }

        /* Right-aligned cells */
        .cell-r {
            text-align: right;
            white-space: nowrap;
        }

        /* Labour / service rows — italic, slightly muted */
        .labour-row td {
            font-style: italic;
            color: #4A5A6A;
        }

        /* ══ TOTALS ══════════════════════════════════════════════ */
        .totals-wrap {
            display: flex;
            justify-content: flex-end;
            margin: 10px 0 14px;
        }

        .totals {
            min-width: 240px;
            border-collapse: collapse;
            font-size: 9pt;
        }

        .totals td { padding: 3px 6px; text-align: right; }

        .totals .tl {
            color: #5A6A7A;
            font-size: 8pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding-right: 20px;
        }

        .totals .tv { color: #1C2B3A; min-width: 95px; }

        .totals .gt-row td {
            font-weight: 800;
            font-size: 10.5pt;
            color: #0D3B6E;
            border-top: 2px solid #0D3B6E;
            padding-top: 6px;
            background: #EBF4FF;
        }

        /* ══ TERMS + SIGNATURES BLOCK ════════════════════════════ */
        .lower-block {
            border-top: 1.5px solid #D0DDE8;
            padding-top: 12px;
            margin-top: 4px;
        }

        /* Terms stacked as plain lines — matching the PDF style */
        .terms-list {
            margin-bottom: 14px;
            font-size: 9pt;
            line-height: 2;
        }

        .terms-list p { }

        .terms-list .t-key {
            font-weight: 700;
            color: #1C2B3A;
        }

        .terms-list .t-val {
            color: #2D3F50;
        }

        /* Signer name */
        .signer-name {
            font-size: 9pt;
            font-weight: 600;
            color: #1C2B3A;
            margin-bottom: 18px;
        }

        /* Signature row — two columns with dotted lines */
        .sig-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 40px;
            margin-top: 4px;
        }

        .sig-block { flex: 1; }

        /* Dotted line — matches the PDF exactly */
        .dotted-line {
            border: none;
            border-bottom: 1.5px dotted #5A6A7A;
            width: 100%;
            margin-bottom: 5px;
        }

        .sig-caption {
            font-size: 9pt;
            font-weight: 600;
            color: #1C2B3A;
        }

        /* ══ FOOTER ══════════════════════════════════════════════ */
        .footer {
            margin-top: 14px;
            border-top: 1px solid #E2E8F0;
            padding-top: 7px;
            text-align: center;
            font-size: 7.5pt;
            color: #9AA8B8;
        }

        /* ══ PRINT ═══════════════════════════════════════════════ */
        @media print {
            body { padding: 0.3in 0.4in; }
            .items-table thead tr,
            .gen-row td,
            .totals .gt-row td,
            .doc-title { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <div><span class="company-name"><?= htmlspecialchars($settings['company_name'] ?? 'Londiani Electricals and Hardware') ?></span></div>
        <div class="company-details">
            <?= htmlspecialchars($settings['company_phone'] ?? '') ?>
            <?php if (!empty($settings['company_email'])): ?> &nbsp;|&nbsp; <?= htmlspecialchars($settings['company_email']) ?><?php endif; ?>
            <?php if (!empty($settings['company_address'])): ?><br><?= nl2br(htmlspecialchars($settings['company_address'])) ?><?php endif; ?>
        </div>
        <?php if (!empty($settings['logo_strip_html'])): ?>
        <div class="logo-strip"><?= $settings['logo_strip_html'] ?></div>
        <?php else: ?>
        <div class="logo-strip" style="font-size:7pt; color:#9AA8B8; letter-spacing:1px;">
            DSE &nbsp;·&nbsp; PERKINS &nbsp;·&nbsp; CUMMINS &nbsp;·&nbsp; DEUTZ
        </div>
        <?php endif; ?>
    </div>

    <!-- DOC TITLE -->
    <div class="doc-title-row">
        <span class="doc-title">QUOTATION</span>
    </div>

    <!-- INFO TABLE -->
    <table class="info-table">
        <tr>
            <td class="lbl">Customer:</td>
            <td class="val"><?= htmlspecialchars($quotation['customer_name'] ?? '') ?></td>
            <td class="rlbl">Date:</td>
            <td class="rval"><?= date('d/m/Y', strtotime($quotation['date'] ?? 'now')) ?></td>
        </tr>
        <?php if (!empty($quotation['attention'])): ?>
        <tr>
            <td class="lbl">Attention:</td>
            <td class="val"><?= htmlspecialchars($quotation['attention']) ?></td>
            <td class="rlbl">Ref:</td>
            <td class="rval"><span class="ref-pill"><?= htmlspecialchars($quotation['quotation_number'] ?? '') ?></span></td>
        </tr>
        <?php else: ?>
        <tr><td class="lbl"></td><td></td>
            <td class="rlbl">Ref:</td>
            <td class="rval"><span class="ref-pill"><?= htmlspecialchars($quotation['quotation_number'] ?? '') ?></span></td>
        </tr>
        <?php endif; ?>
        <?php if (!empty($quotation['contact_person'])): ?>
        <tr>
            <td class="lbl">Contact:</td>
            <td class="val"><?= htmlspecialchars($quotation['contact_person']) ?></td>
            <td class="rlbl">Our Contact:</td>
            <td class="rval"><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name'] ?? '') ?></td>
        </tr>
        <?php else: ?>
        <tr><td class="lbl"></td><td></td>
            <td class="rlbl">Our Contact:</td>
            <td class="rval"><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name'] ?? '') ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td class="lbl"></td><td></td>
            <td class="rlbl">Mobile No:</td>
            <td class="rval"><?= htmlspecialchars($quotation['our_contact_phone'] ?? '') ?></td>
        </tr>
        <tr>
            <td class="lbl">Address:</td>
            <td colspan="3" class="val"><?= nl2br(htmlspecialchars($quotation['address'] ?? '')) ?></td>
        </tr>
    </table>

    <!-- RE LINE -->
    <?php if (!empty($quotation['re_description'])): ?>
    <div class="re-line">RE: <?= htmlspecialchars($quotation['re_description']) ?></div>
    <?php endif; ?>

    <?php
    // ── Merge duplicate items — LOGIC UNCHANGED ──────────────
    $mergedItems = [];
    if (!empty($items)) {
        foreach ($items as $item) {
            $group = $item['generator_group'] ?? '';
            $desc  = $item['description'] ?? '';
            $unit  = $item['unit'] ?? '';
            $price = (float)($item['unit_price'] ?? 0);
            $key   = $group . '|' . $desc . '|' . $unit . '|' . $price;
            if (isset($mergedItems[$key])) {
                $mergedItems[$key]['quantity'] += (float)($item['quantity'] ?? 0);
                $mergedItems[$key]['total']     = $mergedItems[$key]['quantity'] * $price;
            } else {
                $mergedItems[$key] = [
                    'generator_group' => $group,
                    'description'     => $desc,
                    'quantity'        => (float)($item['quantity'] ?? 0),
                    'unit'            => $unit,
                    'unit_price'      => $price,
                    'total'           => (float)($item['total'] ?? 0)
                ];
            }
        }
    }
    ?>

    <!-- ITEMS TABLE -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width:26px;">#</th>
                <th style="width:22%;">Material</th>
                <th style="width:28%;">Description</th>
                <th class="r" style="width:14%;">Qty / Unit</th>
                <th class="r" style="width:17%;">Unit Price (KES)</th>
                <th class="r" style="width:17%;">Total (KES)</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $currentGroup = null;
        $groupNumber  = 0;
        $itemNumber   = 0;
        if (!empty($mergedItems)):
            foreach ($mergedItems as $item):
                $materialName = $item['generator_group'] ?? '';
                $description  = $item['description'] ?? '';
                $qty          = $item['quantity'];
                $unit         = $item['unit'];
                $unitPrice    = $item['unit_price'];
                $total        = $item['total'];

                $qtyUnit = number_format((float)$qty, 2);
                if (!empty($unit)) { $qtyUnit .= ' ' . $unit; }

                // Track group changes for numbering only
                if (!empty($materialName) && $materialName !== $currentGroup):
                    $currentGroup = $materialName;
                    $groupNumber++;
                    $itemNumber = 0;
                endif;

                $itemNumber++;
                // Detect labour/sundry rows (no unit price)
                $isLabour = ($unitPrice == 0 && $total > 0);
                $rowClass = 'item-row' . ($isLabour ? ' labour-row' : '');
        ?>
            <tr class="<?= $rowClass ?>">
                <td class="cell-no"><?= $groupNumber ?>.<?= $itemNumber ?></td>
                <td class="cell-material"><?= htmlspecialchars($materialName) ?></td>
                <td class="cell-desc"><?= htmlspecialchars($description) ?></td>
                <td class="cell-r"><?= $unitPrice > 0 ? htmlspecialchars($qtyUnit) : '—' ?></td>
                <td class="cell-r"><?= $unitPrice > 0 ? number_format((float)$unitPrice, 2) : '—' ?></td>
                <td class="cell-r"><?= number_format((float)$total, 2) ?></td>
            </tr>
        <?php
            endforeach;
        endif;
        ?>
        </tbody>
    </table>

    <!-- TOTALS -->
    <div class="totals-wrap">
        <table class="totals">
            <tr>
                <td class="tl">Sub-Total</td>
                <td class="tv">KES <?= number_format((float)($quotation['subtotal'] ?? 0), 2) ?></td>
            </tr>
            <?php if (!empty($quotation['vat_included']) && (float)($quotation['vat_amount'] ?? 0) > 0): ?>
            <tr>
                <td class="tl">VAT 16%</td>
                <td class="tv">KES <?= number_format((float)($quotation['vat_amount'] ?? 0), 2) ?></td>
            </tr>
            <?php endif; ?>
            <tr class="gt-row">
                <td class="tl" style="font-weight:800; color:#0D3B6E;">Total</td>
                <td class="tv" style="font-weight:800; color:#0D3B6E;">KES <?= number_format((float)($quotation['total'] ?? 0), 2) ?></td>
            </tr>
        </table>
    </div>

    <!-- LOWER BLOCK: Terms + Signature -->
    <div class="lower-block">

        <!-- Terms — plain labeled lines exactly like the PDF -->
        <div class="terms-list">
            <p><span class="t-key">Validity: </span><span class="t-val"><?= htmlspecialchars($quotation['validity'] ?? '1 month unless cancelled or extended in writing') ?></span></p>
            <p><span class="t-key">Payment: </span><span class="t-val"><?= htmlspecialchars($quotation['payment_terms'] ?? 'Upfront payment for routine service and repair.') ?></span></p>
            <p><span class="t-key">Warranty: </span><span class="t-val"><?= htmlspecialchars($quotation['warranty'] ?? '6 months on spares') ?></span></p>
        </div>

        <!-- Signer name above the lines -->
        <div class="signer-name"><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name'] ?? '') ?></div>

        <!-- Dual dotted signature lines -->
        <div class="sig-row">
            <div class="sig-block">
                <div class="dotted-line"></div>
                <div class="sig-caption"><?= htmlspecialchars($settings['manager_title'] ?? 'Manager') ?></div>
            </div>
            <div class="sig-block">
                <div class="dotted-line"></div>
                <div class="sig-caption">Customer Confirmation</div>
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        <?= nl2br(htmlspecialchars($settings['footer_text'] ?? 'Thank you for your business')) ?>
    </div>

</body>
</html>