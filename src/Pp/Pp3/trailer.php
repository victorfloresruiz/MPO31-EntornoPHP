<?php
include "pelicules.php";

$trobada = false;
if (isset($_GET["id"]) && isset($pelicules[$_GET["id"]])) {
    $pelicula = $pelicules[$_GET["id"]];
    $trobada = true;
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tràiler - Cinemes Màgic Badalona</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="cabecera">
        <h2>Cinemes Màgic Badalona</h2>
    </header>

    <main class="contenedor contenedor-trailer">

        <?php if ($trobada == false) { ?>

            <p>Pel·lícula no trobada.</p>

        <?php } else { ?>

            <h1 class="titulo-detalle" style="margin-bottom: 20px;"><?php echo $pelicula["nom"]; ?></h1>

            <div class="ratio-video">
                <iframe src="<?php echo $pelicula["trailer"]; ?>" 
                title="Tràiler de <?php echo $pelicula["nom"]; ?>" 
                allowfullscreen></iframe>
            </div>

        <?php } ?>

        <a href="index.php" class="boton-volver" style="display: inline-block; width: auto; margin-top: 15px;">Tornar a la cartellera</a>

    </main>

</body>
</html>