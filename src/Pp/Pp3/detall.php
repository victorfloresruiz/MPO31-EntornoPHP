<?php
include "pelicules.php";

$trobada = false;
if (isset($_GET["id"]) && isset($pelicules[$_GET["id"]])) {
    $id = $_GET["id"];
    $pelicula = $pelicules[$id];
    $trobada = true;
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detall - Cinemes Màgic Badalona</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


    <header class="cabecera">
        <h2>Cinemes Màgic Badalona</h2>
    </header>

    <main class="contenedor">

        <?php if ($trobada == false) { ?>

            <p>Pel·lícula no trobada.</p>
            <a href="index.php" class="boton-volver" style="display: inline-block; width: auto; margin-top: 15px;">Tornar a la cartellera</a>

        <?php } else { ?>

            <h1 class="titulo-detalle"><?php echo $pelicula["nom"]; ?></h1>
            <hr class="linea-divisora">

            <div class="contenedor-detalle">

                <!-- Columna lateral (Imagen y Botones) -->
                <div class="columna-lateral">
                    <img src="<?php echo $pelicula["imatge"]; ?>" class="imagen-detalle" alt="<?php echo $pelicula["nom"]; ?>">
                    <a href="trailer.php?id=<?php echo $id; ?>" class="boton-trailer">▶ Tràiler</a>
                    <a href="index.php" class="boton-volver">Tornar a la cartellera</a>
                </div>

                <!-- Columna principal (Información) -->
                <div class="columna-principal">
                    <p><?php echo $pelicula["sinopsi"]; ?></p>
                    <p><strong>Durada:</strong> <?php echo $pelicula["durada"]; ?></p>
                    <p><strong>Director:</strong> <?php echo $pelicula["director"]; ?></p>

                    <p>
                        <strong>Actors:</strong>
                        <?php foreach ($pelicula["repartiment"] as $actor) { ?>
                            <span class="actor"><?php echo $actor; ?></span>
                        <?php } ?>
                    </p>

                    <p><strong>Qualificació:</strong> <?php echo $pelicula["qualificacio"]; ?></p>
                    <p><strong>Gènere:</strong> <?php echo $pelicula["genere"]; ?></p>

                    <?php if (isset($pelicula["valoracio"])) { ?>
                        <p>
                            <strong>Valoració:</strong>
                            <span class="estrellas">
                                <?php foreach ([1, 2, 3, 4, 5] as $numero) {
                                    if ($numero <= $pelicula["valoracio"]) {
                                        echo "★";
                                    } else {
                                        echo "☆";
                                    }
                                } ?>
                            </span>
                            (<?php echo $pelicula["valoracio"]; ?>/5)
                        </p>
                    <?php } ?>

                    <div class="barra-horarios">
                        <span class="etiqueta-horarios">HORARIS</span>
                        <?php foreach ($pelicula["horaris"] as $hora) { ?>
                            <span class="horario"><?php echo $hora; ?></span>
                        <?php } ?>
                    </div>

                    <?php if (isset($pelicula["imatges_extra"])) { ?>
                        <div class="galeria-imagenes">
                            <?php foreach ($pelicula["imatges_extra"] as $imatge) { ?>
                                <img src="<?php echo $imatge; ?>" class="imagen-extra" alt="Imatge extra de <?php echo $pelicula["nom"]; ?>">
                            <?php } ?>
                        </div>
                    <?php } ?>

                </div>

            </div>

        <?php } ?>

    </main>

</body>
</html>