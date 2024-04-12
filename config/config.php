<?php
$host = 'localhost';
$dbname = 'testdb';
$username = 'root';
$password = ''; // en XAMPP, el usuario root generalmente no tiene contraseña

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
