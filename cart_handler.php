<?php
session_start();

// Inicializo shportën nëse nuk ekziston ende
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Kontrollo nëse kërkesa është POST për të shtuar artikull në shportë
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? 0;

    if ($name && $price) {
        // Shto produktin në shportë
        $_SESSION['cart'][] = [
            'name' => $name,
            'price' => $price
        ];

        // Kthe përgjigje JSON me sukses dhe numrin e artikujve në shportë
        echo json_encode([
            'success' => true,
            'cart_count' => count($_SESSION['cart'])
        ]);
        exit;
    }
}

// Nëse nuk është POST ose mungojnë të dhënat, kthe përgjigje gabimi JSON
echo json_encode(['success' => false]);
