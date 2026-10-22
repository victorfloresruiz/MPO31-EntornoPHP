<?php
$nombre = "";
$telefono = "";
$foto = "";

if (isset($_POST["nombre"])) {
    $nombre = $_POST["nombre"];
}
if (isset($_POST["telefono"])) {
    $telefono = $_POST["telefono"];
}
if (isset($_POST["foto"])) {
    $foto = $_POST["foto"];
}

require "includes/funciones.php";
require "data/productos.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vamos al Mercadona</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }
        h2 {
            text-align: center;
            color: #2e7d32;
        }
    </style>
</head>
<body>
    <?php include "includes/header.php"; ?>

    <h2>Lista de productos</h2>
    <?php generarTablaProductos($productos); ?>

    <?php muestraInfoContacto($nombre, $telefono, $foto); ?>

    <?php include "includes/footer.php"; ?>
</body>
</html>