<?php
include 'config.php';

$sql = "SELECT id, name, email, age FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Nombre " . $row["name"]. " " . $row["email"]. " " . $row["age"]. "<br>";
    }
} else {
    echo "0 results";
}
?>
