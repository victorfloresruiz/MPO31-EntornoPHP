<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Mercadona</title>
</head>
<body>

    <h1>Bienvenido a la Tienda</h1>
    <p>Por favor, introduce tus datos para acceder:</p>

    <form action="index.php" method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" required><br><br>

        <label for="foto">URL de la foto de perfil:</label><br>
        <input type="text" id="foto" name="foto" placeholder="" required><br><br>

        <input type="submit" value="Entrar a la tienda">
    </form>

</body>
</html>