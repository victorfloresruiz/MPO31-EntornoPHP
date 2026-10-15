<?php
include "pelicules.php";
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cartellera - Cinemes Màgic Badalona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="cabecera text-center py-4">
        <h1>Cartellera</h1>
        <h2>Cinemes Màgic Badalona</h2>
    </header>

    <main class="container my-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">

            <?php foreach ($pelicules as $id => $pelicula) { ?>
                <div class="col">
                    <div class="card tarjeta-pelicula h-100">

                        <img src="<?php echo $pelicula["imatge"]; ?>" class="card-img-top" alt="<?php echo $pelicula["nom"]; ?>">

                        <div class="card-body">
                            <h5 class="titulo"><?php echo $pelicula["nom"]; ?></h5>
                            <p class="hoy">Avui</p>
                            <div>
                                <?php foreach ($pelicula["horaris"] as $hora) { ?>
                                    <span class="horario"><?php echo $hora; ?></span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <a href="trailer.php?id=<?php echo $id; ?>" class="boton-tarjeta">▶ Veure tràiler</a>
                            <a href="detall.php?id=<?php echo $id; ?>" class="boton-tarjeta">Més informació</a>
                        </div>

                    </div>
                </div>
            <?php } ?>

        </div>
    </main>

</body>
</html>
