<?php
require("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $targetDir = "img/";
    $fileName = basename($_FILES["photo"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
                $sql = "INSERT INTO artists (Name, Photo, Description) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $name, $fileName, $description);

                if ($stmt->execute()) {
                    echo "Artist added successfully.";
                } else {
                    echo "Error adding artist: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Only JPG, JPEG, PNG, GIF files are allowed.";
        }
    } else {
        echo "File is not an image.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
