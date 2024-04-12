<?php
include '../../config/config.php';


// Proceso de creación de un nuevo usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $sql = "INSERT INTO users (name, email, age) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $email, $age);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        "<p>New record created successfully</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// Proceso para leer y mostrar los datos
$sql = "SELECT id, name, email, age FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
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

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1,
        h2 {
            color: #333;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="submit"] {
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block;
            width: 95%;
        }

        input[type="submit"] {
            background-color: #5c67f2;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4a54e1;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f4f4f9;
        }

        /* Estilos para el toast */
        .toast {
            visibility: hidden;
            /* Oculto por defecto */
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        .show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <h1>CRUD App</h1>
    <h2>Crear usuario</h2>
    <form method="post" action="">
        Nombre <input type="text" name="name"><br>
        Email <input type="email" name="email"><br>
        Edad <input type="number" name="age"><br>
        <input type="submit" value="Submit">
    </form>

    <!-- Elemento para el mensaje toast -->
    <div id="toast" class="toast"></div>

    <h2>Lista</h2>
    <?php
    include '../../config/config.php';

    $message = ''; // Inicializa el mensaje vacío
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $age = $_POST['age'];

        $sql = "INSERT INTO users (name, email, age) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $age);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $message = "New record created successfully";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Proceso para leer y mostrar los datos
    $sql = "SELECT id, name, email, age FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["age"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No users found</p>";
    }
    ?>

    <div style="text-align-last: center;">
        <div class='text-lg-start mt-4 pt-2' style='text-align: center;'>
            <a class='form-text' href='/sitiowww/dashboard/php/ud.php'>
                <button type='button' data-mdb-button-init data-mdb-ripple-init class='btn btn-primary btn-lg' style='padding-left: 2.5rem; padding-right: 2.5rem;'>
                    Actualizar y/o eliminar registros
                </button>
            </a>
            <a class='form-text' href='/sitiowww/index.php'>
                <button type='button' data-mdb-button-init data-mdb-ripple-init class='btn btn-primary btn-lg' style='padding-left: 2.5rem; padding-right: 2.5rem;'>
                    Inicio
                </button>
            </a>
        </div>
    </div>
    <!-- Agregar JavaScript para mostrar el toast -->
    <script>
        const message = "<?php echo $message; ?>";
        if (message.length > 0) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.className = "toast show";

            // Ocultar el toast después de 3 segundos
            setTimeout(function() {
                toast.className = toast.className.replace("show", "");
            }, 3000);
        }
    </script>
</body>

</html>