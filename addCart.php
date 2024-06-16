<?php
session_start();

$product = $_POST['product'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}

$productExists = false;

foreach ($_SESSION["cart"] as &$item) {
    if ($item['product'] === $product) {
        $item['quantity'] += $quantity;
        $productExists = true;
        break;
    }
}

if (!$productExists) {
    $item = array(
        "product" => $product,
        "quantity" => $quantity,
        "price" => $price
    );

    $_SESSION["cart"][] = $item;
}

$response = array("status" => "success", "message" => "Produkt dodany do koszyka");
header('Content-Type: application/json');
echo json_encode($response);
