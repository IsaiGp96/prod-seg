<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App - Update and Delete</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Asumiendo que tienes un archivo de CSS en el directorio css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f9;
        }

        .btn {
            padding: 5px 10px;
            color: white;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }

        .btn-danger {
            background-color: #DC3545;
        }

        .btn-info {
            background-color: #17A2B8;
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>

<body>
    <h1>CRUD App</h1>

    <h2>Lista</h2>
    <?php
    include '../../config/config.php';

    // Leer los datos existentes
    $sql = "SELECT id, name, email, age FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["age"] . "</td>
                    <td>
                        <a href='update.php?id=" . $row['id'] . "' class='btn btn-info'>Edit</a>
                        <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    </td>
                  </tr>";
        }
        echo "</table>
        <div style='text-align-last: center;'>
        <div class='text-lg-start mt-4 pt-2' style='text-align: center;'>
            <a class='form-text' href='/prod-seg/dashboard/php/rc.php'>
                <button type='button' data-mdb-button-init data-mdb-ripple-init class='btn btn-primary btn-lg' style='padding-left: 2.5rem; padding-right: 2.5rem;'>
                    Ver y/o crear registros
                </button>
            </a>
            <a class='form-text' href='/prod-seg/index.php'>
                <button type='button' data-mdb-button-init data-mdb-ripple-init class='btn btn-primary btn-lg' style='padding-left: 2.5rem; padding-right: 2.5rem;'>
                    Inicio
                </button>
            </a>
        </div>
    </div>";
    } else {
        echo "<p>No users found</p>";
    }

    $conn->close();
    ?>
</body>

</html>