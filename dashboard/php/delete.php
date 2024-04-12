<?php
include '../../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Record deleted successfully'); window.location.href='main.php';</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "'); window.location.href='main.php';</script>";
    }

    $stmt->close();
} else {
    // Redirige si no hay ID proporcionado o el método no es GET
    header("Location: main.php");
    exit;
}
?>
