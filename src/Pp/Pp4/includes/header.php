<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda Mercadona</title>
</head>
<body>
    <header class="header-principal">
        <div class="logo-container">
            <img src="assets/logomercadona.jpg" alt="" class="logo">
        </div>

        <div class="usuario-container">
            <?php
            if (isset($_POST['nombre']) && isset($_POST['foto'])) {
                $nombreUsuario = $_POST['nombre'];
                $fotoUsuario = $_POST['foto'];

                echo "<h2>¡Bienvenido, " . $nombreUsuario . "!</h2>";
                echo "<img src='" . $fotoUsuario . "' alt='' class='foto-perfil-header'>";
            } else {
                echo "<h2>Bienvenido a nuestra tienda</h2>";
            }
            ?>
        </div>
    </header>