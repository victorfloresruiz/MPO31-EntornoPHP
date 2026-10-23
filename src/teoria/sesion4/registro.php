<?php

session_start();

//solo acepta POST
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    $_SESSION['nombreuser'] = $_POST['nombre'];
}else{
    header('Location: login.php');
    exit;
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
        <input type="text" placeholder="Tu contraseña" name="contraseña" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>