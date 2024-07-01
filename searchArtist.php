<?php
require('db.php');

$searchTerm = $_GET['searchTerm'];
$sql = "SELECT * FROM artists WHERE Name LIKE '%$searchTerm%'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        echo "<div class='single-artist'>";
        echo "<img src='$row->Photo' alt='{$row->Name}'>";
        echo "<div class='content'>";
        echo "<h2>$row->Name</h2>";
        echo "<p class='white-text'>$row->Description</p>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "Nie znaleziono artystów!";
}
?>
