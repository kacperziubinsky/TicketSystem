<?php 
$host = 'localhost';
$user = 'root';
$passwd = '';
$db = 'ticketsystem';

$conn = new mysqli($host, $user, $passwd, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}