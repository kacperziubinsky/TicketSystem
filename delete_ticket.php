<?php
    require("db.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM tickets WHERE ID = $id";

    if ($conn->query($sql) === TRUE) {
        header("location:adminPanel.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }