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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detall - Cinemes Màgic Badalona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="cabecera text-center py-3">
        <h2 class="mb-0">Cinemes Màgic Badalona</h2>
    </header>

    <main class="container my-4">

        <?php if ($trobada == false) { ?>

            <p>Pel·lícula no trobada.</p>
            <a href="index.php" class="btn btn-dark">Tornar a la cartellera</a>

        <?php } else { ?>

            <h1 class="titulo-detalle"><?php echo $pelicula["nom"]; ?></h1>
            <hr>

            <div class="row">

                                <div class="col-md-4 mb-4">
                    <img src="<?php echo $pelicula["imatge"]; ?>" class="img-fluid mb-3" alt="<?php echo $pelicula["nom"]; ?>">
                    <a href="trailer.php?id=<?php echo $id; ?>" class="btn btn-outline-dark w-100 mb-2">▶ Tràiler</a>
                    <a href="index.php" class="btn btn-dark w-100">Tornar a la cartellera</a>
                </div>

                                <div class="col-md-8">
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
                        <div id="carrusel" class="carousel slide mt-4" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($pelicula["imatges_extra"] as $posicio => $imatge) { ?>
                                    <?php
                                    $classe = "carousel-item";
                                    if ($posicio == 0) {
                                        $classe = "carousel-item active";
                                    }
                                    ?>
                                    <div class="<?php echo $classe; ?>">
                                        <img src="<?php echo $imatge; ?>" class="d-block w-100" alt="Imatge extra">
                                    </div>
                                <?php } ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carrusel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carrusel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    <?php } ?>

                </div>
            </div>

        <?php } ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
