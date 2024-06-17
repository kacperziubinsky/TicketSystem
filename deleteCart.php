<?php
session_start();

$index = $_POST['index'];

if (isset($_SESSION["cart"][$index])) {
    unset($_SESSION["cart"][$index]);
    $_SESSION["cart"] = array_values($_SESSION["cart"]);

    $response = array("status" => "success", "message" => "Produkt usunięty z koszyka");
} else {
    $response = array("status" => "error", "message" => "Produkt nie znaleziony");
}

header('Content-Type: application/json');
echo json_encode($response);

