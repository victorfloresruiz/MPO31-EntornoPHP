<?php
session_start();
require "functions.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$esAdmin = false;
if ($_SESSION["role"] == "admin") {
    $esAdmin = true;
}

$libros = $_SESSION["libros"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Virtual - Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <img src="<?php echo $_SESSION["photo"]; ?>" alt="Foto de perfil">
        <div>
            <h4>👋 Bienvenido, <?php echo $_SESSION["username"]; ?></h4>
            <?php if ($esAdmin) { ?>
                <p>Admin</p>
            <?php } else { ?>
                <p>Lector</p>
            <?php } ?>
        </div>
        <a href="logout.php">Cerrar sesión</a>
    </header>

    <h1>Biblioteca Virtual</h1>
    <p>Disfruta explorando nuestra colección de libros</p>

    <?php if ($esAdmin) { ?>
        <p>
            <a href="add_edit_book.php">➕ Agregar Nuevo Libro</a>
        </p>
    <?php } ?>

    <main>
        <?php foreach ($libros as $id => $libro) { ?>
            <article>
                <img src="<?php echo $libro["imagen"]; ?>" alt="Portada de <?php echo $libro["titulo"]; ?>">
                <h3><?php echo $libro["titulo"]; ?></h3>
                <p><strong>Autor:</strong> <?php echo $libro["autor"]; ?></p>
                <p><?php echo $libro["descripcion"]; ?></p>

                <?php if ($esAdmin) { ?>
                    <p>
                        <a href="add_edit_book.php?id=<?php echo $id; ?>">Editar</a>
                        <a href="delete_book.php?id=<?php echo $id; ?>">Eliminar</a>
                    </p>
                <?php } ?>
            </article>
        <?php } ?>
    </main>
</body>
</html>