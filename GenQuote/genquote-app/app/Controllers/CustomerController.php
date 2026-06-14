<?php
class CustomerController {
    private $pdo;
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->query("SELECT * FROM customers ORDER BY name");
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . '/../Views/customers/index.php';
    }

    public function create() {
        include __DIR__ . '/../Views/customers/create.php';
    }

    public function store() {
        $name = $_POST['name'];
        $attention = $_POST['attention'];
        $contact_person = $_POST['contact_person'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $stmt = $this->pdo->prepare("INSERT INTO customers (name, attention, contact_person, phone, email, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $attention, $contact_person, $phone, $email, $address]);
        header('Location: /customers');
    }
}