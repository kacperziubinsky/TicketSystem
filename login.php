<?php
session_start();

require("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];  

    $password = md5($password);

    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION["username"] = $user['username'];
        $_SESSION["role"] = $user['role'];
        $_SESSION["user_id"] = $user['id'];
        header("Location: myAccount.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }

    $stmt->close();
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


    <div class="login">
        <div class="login-container">
            <h2>Zaloguj się</h2>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Login</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Hasło</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </form>
            <p>Nie masz konta? <a href="register.html">Zarejestruj się</a></p>
        </div>
    </div>

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
