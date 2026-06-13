<?php
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');

// Get IPv4 address (ignore IPv6)
$ipv4 = null;
$records = dns_get_record($host, DNS_A);
if (!empty($records)) {
    $ipv4 = $records[0]['ip'];
}
if (!$ipv4) {
    // Fallback: try gethostbyname (may still return IPv6, but better than nothing)
    $ipv4 = gethostbyname($host);
    if ($ipv4 === $host) {
        die("Could not resolve IPv4 for $host");
    }
}

// Use hostaddr to force IPv4 connection (still uses SSL)
try {
    $pdo = new PDO(
        "pgsql:hostaddr=$ipv4;port=$port;dbname=$dbname;sslmode=require",
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage() . " (Resolved IP: $ipv4)");
}
?>