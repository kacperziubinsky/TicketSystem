<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $post = htmlspecialchars($_POST['post']);
    $zip = htmlspecialchars($_POST['zip']);
    $cart = $_POST['cart'];
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
                $sum = 0;
                $full_quantity = 0;
                foreach ($cart as $index => $item): 
                    $sum += ($item['price'] * $item['quantity']);
                    $full_quantity += $item['quantity'];
                ?>
                    <div class="summary-item" data-index="<?php echo $index; ?>">
                        <div class="summary-item-details">
                            <h3><?php echo htmlspecialchars($item['product']); ?></h3>
                            <p><?php echo htmlspecialchars($item['price']); ?> zł</p>
                            <p><?php echo htmlspecialchars($item['quantity']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="summary-totals">
                <p>Ilość: <span><?php echo $full_quantity; ?></span></p>
                <p>Podatek: <span><?php echo round(($sum * 0.23), 2);?> zł</span></p>
                <p>Suma: <span><?php echo $sum; ?> zł</span></p>
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
</html>
