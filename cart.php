<?php
$sum = 0;
$full_quantity = 0;
session_start();
if($_SESSION["cart"]){
        foreach ($_SESSION["cart"] as $index => $item){
            $sum += ($item['price'] * $item['quantity']);
            $full_quantity += $item['quantity'];
        } 
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>UME - Zaloguj się</title>
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
        <h1>Twój koszyk</h1>
        <div class="cart-container">
            <div class="cart-items">
                    <?php 
                    if($_SESSION["cart"]){
                    foreach ($_SESSION["cart"] as $index => $item): ?>
                        <div class="cart-item" data-index="<?php echo $index; ?>">
                            <div class="cart-item-details">
                                <h3><?php echo $item['product']; ?></h3>
                                <p><?php echo $item['price']; ?> zł</p>
                            </div>
                            <div class="cart-item-quantity">
                                <label for="quantity-<?php echo $index; ?>">Qty:</label>
                                <input type="number" id="quantity-<?php echo $index; ?>" name="quantity" min="1" value="<?php echo $item['quantity']; ?>">
                            </div>
                            <button class="btn delete-btn" data-index="<?php echo $index; ?>">Usuń</button>
                        </div>
                    <?php endforeach; } else{
                        echo "<p>Koszyk jest pusty..</p>";
                    } ?>
                </div>
            <div class="cart-summary">
                <h2>Podsumowanie</h2>
                <p>Ilość: <span><?php echo $full_quantity; ?></span></p>
                <p>Podatek: <span><?php echo round(($sum * 0.23), 2);?> zł</span></p>
                <p>Suma: <span><?php echo $sum; ?> zł</span></p>
                <a href="checkout.html" class="btn">Proceed to Checkout</a>
            </div>
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
            <a href="index.html">Strona główna</a>
            <a href="artists.php">Artyści</a>
            <a href="tickets.php">Bilety</a>
            <a href="myAccount.php">Moje konto</a>
        </div>
    </footer>
</body>

<script src="./scripts/alert.js"></script>
<script src="./scripts/updateCart.js"></script>
</html>