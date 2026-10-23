<?php

session_start();

if(!isset($_SESSION['name'])){
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
    <div>
        <p>Hola <?= $_SESSION['nombreuser']; ?></p>
    </div>

    <a href="logout.php">CERRAR SESION</a>
</body>
</html>
