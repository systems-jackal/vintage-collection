<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class QuotationController {
    private $pdo;
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function create() {
        $stmt = $this->pdo->query("SELECT id, name FROM customers ORDER BY name");
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $this->pdo->query("SELECT MAX(quotation_number) as last FROM quotations");
        $last = $stmt->fetch(PDO::FETCH_ASSOC);
        $nextNum = 'LEH-' . date('Y') . '-' . str_pad(($last['last'] ? intval(substr($last['last'], -4)) + 1 : 1), 4, '0', STR_PAD_LEFT);
        include __DIR__ . '/../Views/quotations/create.php';
    }

    public function store() {
        // Convert customer_id to integer or null
        $customer_id = !empty($_POST['customer_id']) ? (int)$_POST['customer_id'] : null;
        $date = $_POST['date'];
        $quotation_number = $_POST['quotation_number'];
        $our_contact = $_POST['our_contact'];
        $our_contact_phone = $_POST['our_contact_phone'];
        $re_description = $_POST['re_description'];
        $validity = $_POST['validity'] ?? null;
        $payment_terms = $_POST['payment_terms'] ?? null;
        $warranty = $_POST['warranty'] ?? null;
        $vat_included = isset($_POST['vat_included']) ? true : false;

        $generator_groups = $_POST['generator_group'];
        $descriptions = $_POST['item_description'];
        $quantities = $_POST['item_quantity'];
        $units = $_POST['item_unit'];
        $prices = $_POST['item_unit_price'];

        $subtotal = 0;
        $items = [];
        foreach ($descriptions as $i => $desc) {
            if (empty($desc)) continue;
            $qty = (float)$quantities[$i];
            $price = (float)$prices[$i];
            $total = $qty * $price;
            $subtotal += $total;
            $items[] = [
                'generator_group' => $generator_groups[$i],
                'description' => $desc,
                'quantity' => $qty,
                'unit' => $units[$i],
                'unit_price' => $price,
                'total' => $total
            ];
        }
        $vat_amount = $vat_included ? $subtotal * 0.16 : 0;
        $total = $subtotal + $vat_amount;

        $stmt = $this->pdo->prepare("INSERT INTO quotations (quotation_number, customer_id, date, our_contact, our_contact_phone, re_description, validity, payment_terms, warranty, subtotal, vat_amount, vat_included, total, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$quotation_number, $customer_id, $date, $our_contact, $our_contact_phone, $re_description, $validity, $payment_terms, $warranty, $subtotal, $vat_amount, $vat_included, $total, $_SESSION['user_id']]);
        $quotation_id = $this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare("INSERT INTO quotation_items (quotation_id, generator_group, description, quantity, unit, unit_price, total) VALUES (?, ?, ?, ?, ?, ?, ?)");
        foreach ($items as $item) {
            $stmt->execute([$quotation_id, $item['generator_group'], $item['description'], $item['quantity'], $item['unit'], $item['unit_price'], $item['total']]);
        }

        header("Location: /quotations/generate-pdf?id=$quotation_id");
    }

    public function generatePDF() {
        $id = $_GET['id'];
        $stmt = $this->pdo->prepare("SELECT q.*, c.name as customer_name, c.attention, c.contact_person, c.address, c.phone, c.email FROM quotations q LEFT JOIN customers c ON q.customer_id = c.id WHERE q.id = ?");
        $stmt->execute([$id]);
        $quotation = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$quotation) die("Quotation not found");

        $stmt = $this->pdo->prepare("SELECT * FROM quotation_items WHERE quotation_id = ?");
        $stmt->execute([$id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->pdo->query("SELECT * FROM settings LIMIT 1");
        $settings = $stmt->fetch(PDO::FETCH_ASSOC);

        $html = $this->renderPDFHTML($quotation, $items, $settings);
        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("quotation_{$quotation['quotation_number']}.pdf", array("Attachment" => false));
    }

    private function renderPDFHTML($quotation, $items, $settings) {
        ob_start();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Quotation <?= htmlspecialchars($quotation['quotation_number']) ?></title>
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body {
                    font-family: 'Helvetica', 'Arial', sans-serif;
                    font-size: 11pt;
                    line-height: 1.4;
                    color: #1a1a1a;
                    background: white;
                    padding: 0.6in 0.5in;
                    margin: 0;
                }
                .header {
                    text-align: center;
                    margin-bottom: 30px;
                    border-bottom: 1px solid #e0e0e0;
                    padding-bottom: 15px;
                }
                .company-name {
                    font-size: 24pt;
                    font-weight: 600;
                    letter-spacing: 1px;
                    margin-bottom: 8px;
                    color: #2c3e50;
                }
                .company-details {
                    font-size: 9pt;
                    color: #555;
                }
                .quotation-title {
                    font-size: 18pt;
                    font-weight: 600;
                    text-align: center;
                    margin: 25px 0 20px;
                    color: #2c3e50;
                }
                .info-table {
                    width: 100%;
                    margin-bottom: 25px;
                    border-collapse: collapse;
                }
                .info-table td {
                    padding: 6px 5px;
                    vertical-align: top;
                    border: none;
                }
                .info-table .label {
                    font-weight: 600;
                    width: 110px;
                }
                .items-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0 20px;
                }
                .items-table th {
                    text-align: left;
                    padding: 10px 5px 8px 5px;
                    font-weight: 600;
                    border-bottom: 1px solid #d0d0d0;
                }
                .items-table td {
                    padding: 10px 5px;
                    border: none;
                }
                .totals {
                    width: 300px;
                    margin-left: auto;
                    margin-top: 20px;
                    margin-bottom: 35px;
                    border-collapse: collapse;
                }
                .totals td {
                    padding: 6px 0;
                    border: none;
                    text-align: right;
                }
                .totals .label {
                    padding-right: 20px;
                }
                .totals .grand-total td {
                    font-weight: bold;
                    font-size: 13pt;
                    padding-top: 10px;
                    border-top: 1px solid #aaa;
                }
                .terms {
                    margin: 30px 0 20px;
                    font-size: 9pt;
                    color: #444;
                    border-top: 1px solid #e0e0e0;
                    padding-top: 20px;
                }
                .signature {
                    margin-top: 35px;
                    display: flex;
                    justify-content: space-between;
                }
                .signature-line {
                    border-top: 1px solid #888;
                    width: 80%;
                    margin-top: 40px;
                    margin-bottom: 8px;
                }
                .signature-name {
                    font-weight: 600;
                    margin-top: 5px;
                }
                .small-note {
                    font-size: 8pt;
                    color: #777;
                    margin-top: 20px;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="company-name"><?= htmlspecialchars($settings['company_name']) ?></div>
                <div class="company-details">
                    <?= htmlspecialchars($settings['company_phone']) ?>
                    <?= $settings['company_email'] ? '| ' . htmlspecialchars($settings['company_email']) : '' ?><br>
                    <?= htmlspecialchars($settings['company_address']) ?>
                </div>
            </div>
            <div class="quotation-title">QUOTATION</div>
            <table class="info-table">
                <tr><td class="label">Customer:</td><td><strong><?= htmlspecialchars($quotation['customer_name'] ?? 'Walk-in Customer') ?></strong></td>
                    <td class="label">Date:</td><td><?= date('d/m/Y', strtotime($quotation['date'])) ?></td>
                </tr>
                <?php if ($quotation['attention']): ?>
                <tr><td class="label">Attention:</td><td><?= htmlspecialchars($quotation['attention']) ?></td>
                    <td class="label">Ref:</td><td><?= $quotation['quotation_number'] ?></td>
                </tr>
                <?php endif; ?>
                <?php if ($quotation['contact_person']): ?>
                <tr><td class="label">Contact:</td><td><?= htmlspecialchars($quotation['contact_person']) ?></td>
                    <td class="label">Our Contact:</td><td><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name']) ?> <?= $quotation['our_contact_phone'] ? '(' . htmlspecialchars($quotation['our_contact_phone']) . ')' : '' ?></td>
                </tr>
                <?php endif; ?>
                <tr><td class="label">Address:</td><td colspan="3"><?= nl2br(htmlspecialchars($quotation['address'] ?? '')) ?></td>
                </tr>
                <?php if ($quotation['re_description']): ?>
                <tr><td class="label">RE:</td><td colspan="3"><em><?= htmlspecialchars($quotation['re_description']) ?></em></td>
                </tr>
                <?php endif; ?>
            </table>
            <table class="items-table">
                <thead>
                    <tr><th style="width:35%">Description</th><th style="width:12%">Qty</th><th style="width:12%">Unit</th><th style="width:20%">Unit Price (KES)</th><th style="width:21%">Total (KES)</th></tr>
                </thead>
                <tbody>
                <?php 
                $currentGen = null;
                foreach ($items as $item):
                    if (!empty($item['generator_group']) && $item['generator_group'] !== $currentGen):
                        $currentGen = $item['generator_group'];
                ?>
                    <tr style="background:#fafafa;"><td colspan="5" style="padding: 8px 5px 4px; font-weight:600;"><?= htmlspecialchars($item['generator_group']) ?></td></tr>
                <?php endif; ?>
                <tr>
                    <td><?= htmlspecialchars($item['description']) ?></td>
                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                    <td><?= htmlspecialchars($item['unit']) ?></td>
                    <td><?= number_format($item['unit_price'], 2) ?></td>
                    <td><?= number_format($item['total'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <table class="totals">
                <tr><td class="label">Subtotal</td><td>KES <?= number_format($quotation['subtotal'], 2) ?></td></tr>
                <?php if ($quotation['vat_included']): ?>
                <tr><td class="label">VAT 16%</td><td>KES <?= number_format($quotation['vat_amount'], 2) ?></td></tr>
                <?php endif; ?>
                <tr class="grand-total"><td class="label"><strong>TOTAL</strong></td><td><strong>KES <?= number_format($quotation['total'], 2) ?></strong></td></tr>
            </table>
            <div class="terms">
                <p><strong>Validity:</strong> <?= nl2br(htmlspecialchars($quotation['validity'])) ?></p>
                <p><strong>Payment:</strong> <?= nl2br(htmlspecialchars($quotation['payment_terms'])) ?></p>
                <p><strong>Warranty:</strong> <?= nl2br(htmlspecialchars($quotation['warranty'])) ?></p>
            </div>
            <div class="signature">
                <div><div class="signature-line"></div><div class="signature-name"><?= htmlspecialchars($quotation['our_contact'] ?? $settings['manager_name']) ?></div><div><?= htmlspecialchars($settings['manager_title']) ?></div></div>
                <div><div class="signature-line"></div><div class="signature-name">Customer confirmation</div><div class="small-note">(Signature & Date)</div></div>
            </div>
            <div class="small-note"><?= nl2br(htmlspecialchars($settings['footer_text'])) ?></div>
        </body>
        </html>
        <?php
        return ob_get_clean();
    }
}
?>