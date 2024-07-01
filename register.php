<?php
require('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <link rel="stylesheet" href="style.css">
    <title>UME - Ultra Music Event</title>
</head>
<body>
<?php include("menu.php"); ?>


    <div class="register">
        <div class="register-container">
            <h2>Rejestracja</h2>
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="username">Login</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Hasło</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Zarejestruj</button>
            </form>
            <p>Posidasz konto? <a href="login.html">Zaloguj się!</a></p>
        </div>
    </div>

    <footer>
        <div class="event-info">
            <img src="./img/UME.png" alt="Logo" class="main-logo">
            <h2>Ultra Music Event</h2>
            <h3>Poznaj świat muzycznej rozpusty!</h3>
            <p>&copy;	Kacper Ziubiński</p>
        </div>

        <div class="social">
            <a href="">Strona główna</a>
            <a href="">Artyści</a>
            <a href="">Bilety</a>
            <a href="">Moje konto</a>

        </div>
    </footer>

</body>
</html>
