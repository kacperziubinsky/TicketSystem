<?php
    session_start();

if (!isset($_SESSION["user_id"])) {
    die("You must be logged in to place an order.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars(trim($_POST["fullname"]));
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $address = htmlspecialchars(trim($_POST["address"]));
    $city = htmlspecialchars(trim($_POST["city"]));
    $post = htmlspecialchars(trim($_POST["post"]));
    $zip = htmlspecialchars(trim($_POST["zip"]));

    if (empty($fullname) || empty($email) || empty($address) || empty($city) || empty($post) || empty($zip)) {
        die("Please fill out all required fields.");
    }

    if (!isset($_SESSION["order_total"])) {
        die("Order total not found.");
    }
    $order_total = $_SESSION["order_total"];

    require("db.php");

    $sql_insert_order = "INSERT INTO orders (user_id, order_total, fullname, email, address, city, post, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert_order = $conn->prepare($sql_insert_order);
    $user_id = $_SESSION["user_id"];
    $stmt_insert_order->bind_param("idssssss", $user_id, $order_total, $fullname, $email, $address, $city, $post, $zip);
    $full_quantity = 0;
    $sum = 0;
    if ($stmt_insert_order->execute()) {
        $order_id = $stmt_insert_order->insert_id;

        foreach ($_POST["cart"] as $index => $item) {
            $product_name = $item['product'];
            $price = $item['price'];
            $quantity = $item['quantity'];
            $full_quantity += $item['quantity'];
            $sum += $price * $quantity;

            $sql_insert_item = "INSERT INTO order_items (order_id, product_name, price, quantity) VALUES (?, ?, ?, ?)";
            $stmt_insert_item = $conn->prepare($sql_insert_item);
            $stmt_insert_item->bind_param("isdi", $order_id, $product_name, $price, $quantity);

            $stmt_insert_item->execute();
            $stmt_insert_item->close();
        }

        $_SESSION["cart"] = [];

    } else {
        echo "Error inserting order: " . $stmt_insert_order->error;
    }

    $stmt_insert_order->close();
    $conn->close();
} else {
    header("Location: checkout.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>UME - Podsumowanie zamówienia</title>
</head>
<body>
<?php include("menu.php"); ?>


    <section class="page-container">
        <h1>Podsumowanie zamówienia</h1>
        <div class="summary-container">
            <h2>Dane klienta</h2>
            <p>Imię i nazwisko: <?php echo $fullname; ?></p>
            <p>Adres E-mail: <?php echo $email; ?></p>
            <p>Adres: <?php echo $address; ?></p>
            <p>Miasto: <?php echo $city; ?></p>
            <p>Poczta: <?php echo $post; ?></p>
            <p>Kod pocztowy: <?php echo $zip; ?></p>

            <h2>Zawartość koszyka</h2>
            <div class="summary-items">
                <?php
                foreach ($_POST["cart"] as $index => $item) {
                    ?>
                    <div class="summary-item" data-index="<?php echo $index; ?>">
                        <div class="summary-item-details">
                            <h3><?php echo htmlspecialchars($item['product']); ?></h3>
                            <p><?php echo $item['price']; ?> zł</p>
                            <p><?php echo $item['quantity']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="summary-totals">
                <p>Ilość: <span><?php echo $full_quantity; ?></span></p>
                <p>Podatek (23%): <span><?php echo round(($sum * 0.23), 2); ?> zł</span></p>
                <p>Suma: <span><?php echo $sum; ?> zł</span></p>
            </div>
        </div>
        <a href="myAccount.php" class="btn">Moje konto</a>

    </section>

    <footer>
        <div class="event-info">
            <img src="./img/UME.png" alt="Logo" class="main-logo">
            <h2>Ultra Music Event</h2>
            <h3>Poznaj świat muzycznej rozpusty!</h3>
            <p>&copy; Kacper Ziubiński</p>
        </div>

        <div class="social">
            <a href="index.php">Strona główna</a>
            <a href="artist.php">Artyści</a>
            <a href="tickets.php">Bilety</a>
            <a href="myAccount.php">Moje konto</a>
        </div>
    </footer>
</body>
</html>
