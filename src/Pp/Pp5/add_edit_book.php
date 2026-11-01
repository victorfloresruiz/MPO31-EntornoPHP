<?php
session_start();
require "functions.php";

// Restricción de acceso: solo admin
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION["role"] != "admin") {
    header("Location: home.php");
    exit;
}

$editando = false;
$id = "";
$titulo = "";
$autor = "";
$imagen = "";
$descripcion = "";
$error = "";

if (isset($_GET["id"]) && isset($_SESSION["libros"][$_GET["id"]])) {
    $editando = true;
    $id = $_GET["id"];
    $titulo = $_SESSION["libros"][$id]["titulo"];
    $autor = $_SESSION["libros"][$id]["autor"];
    $imagen = $_SESSION["libros"][$id]["imagen"];
    $descripcion = $_SESSION["libros"][$id]["descripcion"];
}

// Al enviar el formulario
if (isset($_POST["titulo"])) {
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $imagen = $_POST["imagen"];
    $descripcion = $_POST["descripcion"];

    if ($titulo == "" || $autor == "") {
        $error = "El título y el autor son obligatorios";
    } else {
        if ($editando) {
            editarLibro($id, $titulo, $autor, $imagen, $descripcion);
        } else {
            agregarLibro($titulo, $autor, $imagen, $descripcion);
        }
        header("Location: home.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Virtual</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div>
            <h4>Bienvenido, <?php echo $_SESSION["username"]; ?></h4>
            <p>Admin</p>
        </div>
        <a href="home.php">Volver a la Biblioteca</a>
    </header>

    <h2><?php echo $editando ? "Editar libro" : "Agregar nuevo libro"; ?></h2>

    <form method="POST">
        <?php if ($error != "") { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>

        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?php echo $titulo; ?>">

        <label>Autor:</label><br>
        <input type="text" name="autor" value="<?php echo $autor; ?>">

        <label>URL de la imagen:</label><br>
        <input type="text" name="imagen" value="<?php echo $imagen; ?>">

        <label>Descripción:</label><br>
        <textarea name="descripcion"><?php echo $descripcion; ?></textarea>

        <input type="submit" value="<?php echo $editando ? "Guardar cambios" : "Agregar libro"; ?>">
    </form>
</body>
</html>