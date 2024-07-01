<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'guest';
}
?>

<header>
    <img src="./img/UME.png" alt="Logo" class="main-logo">
    <nav class="main-nav">
        <li><a class="menu-item" href="index.php">Strona Główna</a></li>
        <li><a class="menu-item" href="artists.php">Artyści</a></li>
        <li><a class="menu-item" href="tickets.php">Bilety</a></li>
        <li><a class="menu-item" href="myAccount.php">Moje konto</a></li>
        
        <?php 
        if($_SESSION['role'] == 'admin') {
            echo "<li><a class='menu-item' href='adminPanel.php'>Administracja</a></li>";
        }
        ?>

        <?php 
        if($_SESSION['role'] != 'guest') {
            echo "<li><a class='menu-item' href='cart.php'>Koszyk</a></li>";
            echo "<li><a class='menu-item' href='logout.php'>Wyloguj</a></li>";
        } else {
            echo "<li><a class='menu-item' href='login.php'>Zaloguj</a></li>";
        }
        ?>
        
    </nav>
    <a href="tickets.php" class="btn">Zarezerwuj teraz!</a>
</header>
