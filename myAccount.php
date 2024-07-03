<?php
    session_start();



    if (!isset($_SESSION["user_id"])) {
            header("Location: login.php");
            exit();
        }

    require("db.php");

    $user_id = $_SESSION["user_id"];

    $sql_user = "SELECT * FROM users WHERE id = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("i", $user_id);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user->num_rows > 0) {
        $user = $result_user->fetch_assoc();
    } else {
        die("User not found.");
    }

    $sql_orders = "SELECT * FROM orders WHERE user_id = ?";
    $stmt_orders = $conn->prepare($sql_orders);
    $stmt_orders->bind_param("i", $user_id);
    $stmt_orders->execute();
    $result_orders = $stmt_orders->get_result();

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
    <title>UME - Moje konto</title>
    <style>
        a{
            color: white;
        }
    </style>
</head>
<body>
    <?php include("menu.php"); ?>

    <section class="page-container">
        <h1>Moje konto</h1>
        <div class="account-info">
            <h2>Informacje o użytkowniku</h2>
            <p><strong>Login:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Adres E-mail:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        </div>

        <div class="orders">
            <h2>Moje zamówienia</h2>
            <?php if ($result_orders->num_rows > 0): ?>
                <ul class="order-list">
                    <?php while ($order = $result_orders->fetch_assoc()): ?>
                        <li class="order-item">
                            <p><strong>Numer zamówienia:</strong> <?php echo $order['id']; ?></p>
                            <p><strong>Data zamówienia:</strong> <?php echo $order['order_date']; ?></p>
                            <p><strong>Łączna kwota zamówienia:</strong> <?php echo $order['order_total']; ?> zł</p>
                            <a href="order_details.php?order_id=<?php echo $order['id']; ?>">Szczegóły zamówienia</a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Brak zamówień do wyświetlenia.</p>
            <?php endif; ?>
        </div>

        <div class="delete-account">
            <h2>Usuń konto</h2>
            <p>Uwaga: Usunięcie konta spowoduje trwałe usunięcie wszystkich danych. Czy na pewno chcesz usunąć konto?</p>
            <form action="delete_account.php" method="POST">
                <button type="submit" class="btn" onclick="return confirm('Czy na pewno chcesz usunąć konto?')">Usuń konto</button>
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
            <a href="index.html">Strona główna</a>
            <a href="artists.php">Artyści</a>
            <a href="tickets.php">Bilety</a>
            <a href="myAccount.php">Moje konto</a>
        </div>
    </footer>
</body>
</html>

<?php
$stmt_user->close();
$stmt_orders->close();
$conn->close();
?>
