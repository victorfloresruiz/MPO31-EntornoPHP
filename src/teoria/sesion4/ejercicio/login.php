<?php

session_start();

$nombre_correcto = 'Victor';
$contraseña_correcta = password_hash('1234', PASSWORD_DEFAULT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_ingresado = $_POST['nombre'] ?? '';
    $contraseña_ingresada = $_POST['contraseña'] ?? '';

    if ($nombre_ingresado !== $nombre_correcto || !password_verify($contraseña_ingresada, $contraseña_correcta)) {
        echo'Tu usuario o contraseña son incorrectos';
    } else {
        $_SESSION['nombreuser'] = $nombre_ingresado;
        header('Location: home.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" placeholder="Tu nombre" name="nombre" required>
        <input type="password" placeholder="Tu contraseña" name="contraseña" required>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>