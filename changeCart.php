<?php
session_start();

$index = $_POST['index'];
$quantity = $_POST['quantity'];

if (isset($_SESSION["cart"][$index])) {
    if ($quantity > 0) {
        $_SESSION["cart"][$index]['quantity'] = $quantity;
        $response = array("status" => "success", "message" => "Ilość produktu zaktualizowana");
    } else {
        unset($_SESSION["cart"][$index]);
        $_SESSION["cart"] = array_values($_SESSION["cart"]);
        $response = array("status" => "success", "message" => "Produkt usunięty z koszyka");
    }
} else {
    $response = array("status" => "error", "message" => "Produkt nie znaleziony");
}

header('Content-Type: application/json');
echo json_encode($response);
