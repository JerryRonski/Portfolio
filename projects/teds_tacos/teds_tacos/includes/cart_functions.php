<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['qty'])) {
    $id = (string) trim($_POST['id']);
    $qty = (int) $_POST['qty'];

    // initialize cart if needed
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // add or update quantity
    if ($qty > 0) {
        $_SESSION['cart'][$id] = $qty;
    } else {
        unset($_SESSION['cart'][$id]);
    }



    echo json_encode([
        'success' => true,
        'cart' => $_SESSION['cart']
    ]);
    exit;
}
?>