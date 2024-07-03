<?php
    session_start();

$sum = 0;
$full_quantity = 0;

if ($_SESSION["cart"]) {
    foreach ($_SESSION["cart"] as $index => $item) {
        $sum += ($item['price'] * $item['quantity']);
        $full_quantity += $item['quantity'];
    }
    $_SESSION["order_total"] = $sum;
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
    <title>UME - Checkout</title>
</head>
<body>
<?php include("menu.php"); ?>


    <section class="page-container">
        <h1>Podsumowanie</h1>
        <div class="checkout-container">
            <form action="summary.php" method="POST">
                <div class="checkout-items">
                    <h2>Dane klienta</h2>
                    <div class="form-group">
                        <label for="fullname">Imię i nazwisko</label>
                        <input type="text" id="fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Adres E-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Adres</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="city">Miasto</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="post">Poczta</label>
                        <input type="text" id="post" name="post" required>
                    </div>
                    <div class="form-group">
                        <label for="zip">Kod pocztowy</label>
                        <input type="text" id="zip" name="zip" required>
                    </div>
                </div>
                <div class="checkout-summary">
                    <h2>Zawartość koszyka</h2>
                    <div class="summary-items">
                        <?php 
                        if ($_SESSION["cart"]) {
                            foreach ($_SESSION["cart"] as $index => $item): ?>
                                <div class="summary-item" data-index="<?php echo $index; ?>">
                                    <div class="summary-item-details">
                                        <h3><?php echo $item['product']; ?></h3>
                                        <p><?php echo $item['price']; ?> zł</p>
                                        <p><?php echo $item['quantity']; ?></p>
                                        <input type="hidden" name="cart[<?php echo $index; ?>][product]" value="<?php echo $item['product']; ?>">
                                        <input type="hidden" name="cart[<?php echo $index; ?>][price]" value="<?php echo $item['price']; ?>">
                                        <input type="hidden" name="cart[<?php echo $index; ?>][quantity]" value="<?php echo $item['quantity']; ?>">
                                    </div>
                                </div>
                            <?php endforeach; 
                        } else {
                            echo "<p>Koszyk jest pusty..</p>";
                        } ?>
                    </div>
                    <button type="submit" class="btn">Złóż zamówienie</button>
                </div>
            </form>
        </div>
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
