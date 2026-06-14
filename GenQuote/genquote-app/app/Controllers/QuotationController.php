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
        $customer_id = !empty($_POST['customer_id']) ? (int)$_POST['customer_id'] : null;
        $date = $_POST['date'];
        $quotation_number = $_POST['quotation_number'];
        $our_contact = $_POST['our_contact'];
        $our_contact_phone = $_POST['our_contact_phone'];
        $re_description = $_POST['re_description'];
        $validity = $_POST['validity'] ?? null;
        $payment_terms = $_POST['payment_terms'] ?? null;
        $warranty = $_POST['warranty'] ?? null;
        $vat_included = isset($_POST['vat_included']) ? 1 : 0;

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

        // Load the separate PDF template file
        ob_start();
        include __DIR__ . '/../Views/pdf/quotation_template.php';
        $html = ob_get_clean();

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("quotation_{$quotation['quotation_number']}.pdf", array("Attachment" => false));
    }
}
?>