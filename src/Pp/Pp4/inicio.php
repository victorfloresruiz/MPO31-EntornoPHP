<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Mercadona</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .contenedor-inicio {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .formulario-inicio label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        .formulario-inicio input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        .btn-enviar {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background-color: #00875a;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-enviar:hover {
            background-color: #006644;
        }
    </style>
</head>
<body>

    <main class="contenedor-inicio">
        <h1>Bienvenido a la Tienda</h1>
        <p>Por favor, introduce tus datos para acceder:</p>

        <form action="index.php" method="POST" class="formulario-inicio">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>

            <label for="foto">URL de la foto de perfil:</label>
            <input type="text" id="foto" name="foto" placeholder="https://ejemplo.com/foto.jpg" required>

            <input type="submit" value="Entrar a la tienda" class="btn-enviar">
        </form>
    </main>

</body>
</html>