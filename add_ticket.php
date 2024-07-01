<?php
    require("db.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("INSERT INTO `tickets` (`Name`, `Included`, `Price`) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $name, $description, $price); 

        if ($stmt->execute()) {
            header("Location: adminPanel.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid request.";
    }

    $conn->close();
?>
