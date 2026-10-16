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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tràiler - Cinemes Màgic Badalona</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="cabecera text-center py-3">
        <h2 class="mb-0">Cinemes Màgic Badalona</h2>
    </header>

    <main class="container my-4 text-center">

        <?php if ($trobada == false) { ?>

            <p>Pel·lícula no trobada.</p>

        <?php } else { ?>

            <h1 class="titulo-detalle mb-4"><?php echo $pelicula["nom"]; ?></h1>

                        <div class="ratio ratio-16x9">
                <iframe src="<?php echo $pelicula["trailer"]; ?>?autoplay=1&mute=1"
                        title="Tràiler de <?php echo $pelicula["nom"]; ?>"
                        allow="autoplay; encrypted-media; fullscreen"
                        allowfullscreen></iframe>
            </div>

        <?php } ?>

        <a href="index.php" class="btn btn-dark mt-4">Tornar a la cartellera</a>

    </main>

</body>
</html>
