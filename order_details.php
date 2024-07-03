<?php
session_start();
require('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['order_id'];

$sql = "SELECT * FROM order_items WHERE order_id = $id";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Order Items</title>
    <style>
        a{
            color:white;
        }
    </style>
</head>
<body>
<header>
    <img src="./img/UME.png" alt="Logo" class="main-logo">
    <nav class="main-nav">
        <li><a class="menu-item" href="index.html">Strona Główna</a></li>
        <li><a class="menu-item" href="artists.php">Artyści</a></li>
        <li><a class="menu-item" href="tickets.php">Bilety</a></li>
        <li><a class="menu-item" href="myAccount.php">Moje konto</a></li>
    </nav>
    <a href="tickets.php" class="btn">Zarezerwuj teraz!</a>
</header>

<section class="page-container">
    <h1>Szczegóły zamówienia : <? echo $id; ?></h1>
    <table class="order-items-table">
        <thead>
            <tr>
                <th>Nazwa</th>
                <th>Cena</th>
                <th>Ilość</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No items found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="myAccount.php">Moje konto</a>
</section>

<footer>
    <div class="event-info">
        <img src="./img/UME.png" alt="Logo" class="main-logo">
        <h2>Ultra Music Event</h2>
        <h3>Poznaj świat muzycznej rozpusty!</h3>
        <p>&copy; Kacper Ziubiński</p>
    </div>
    <div class="social">
        <a href="index.html">Strona główna</a>
        <a href="artists.php">Artyści</a>
        <a href="tickets.php">Bilety</a>
        <a href="myAccount.php">Moje konto</a>
    </div>
</footer>
</body>
</html>
