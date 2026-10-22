<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Vamos al Mercadona</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        h1 {
            color: #2e7d32;
        }
        form {
            background-color: white;
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            text-align: left;
        }
        input[type="text"] {
            width: 100%;
            padding: 6px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Vamos al Mercadona</h1>
    <h2>Introduce tus datos</h2>

    <form action="index.php" method="POST">
        <p>
            <label>Nombre:</label><br>
            <input type="text" name="nombre" required>
        </p>
        <p>
            <label>Teléfono:</label><br>
            <input type="text" name="telefono" required>
        </p>
        <p>
            <label>URL de la foto de perfil:</label><br>
            <input type="text" name="foto" required>
        </p>
        <p>
            <input type="submit" value="Entrar a la tienda">
        </p>
    </form>
</body>
</html>