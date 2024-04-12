<?php
include '../../config/config.php';

// Procesa el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    // Actualiza el registro en la base de datos
    $sql = "UPDATE users SET name = ?, email = ?, age = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $name, $email, $age, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Record updated successfully'); window.location.href='ud.php';</script>";
    } else {
        echo "<script>alert('Error updating record or no changes made: " . $stmt->error . "'); window.location.href='ud.php';</script>";
    }
    $stmt->close();
}

// Recupera el registro existente para editar
$id = $_GET['id'] ?? ''; // Usamos el operador de fusión null para PHP 7 o superior
if ($id) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        die('User not found');
    }
} else {
    die('ID not provided');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            width: 300px;
            margin: auto;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Actualizar usuairo</h1>
    <form method="post" action="">
        Nombre <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>"><br>
        Email <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br>
        Edad <input type="number" name="age" value="<?php echo $user['age']; ?>"><br>
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <input type="submit" value="Update">
    </form>
</body>
</html>
