<?php
include "pelicules.php";
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartellera - Cinemes Màgic Badalona</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="cabecera">
        <h1>Cartellera</h1>
        <h2>Cinemes Màgic Badalona</h2>
    </header>

    <main class="contenedor">
        <div class="grilla-peliculas">

            <?php foreach ($pelicules as $id => $pelicula) { ?>
                <div class="tarjeta-pelicula">

                    <img src="<?php echo $pelicula["imatge"]; ?>" alt="<?php echo $pelicula["nom"]; ?>">

                    <div class="tarjeta-cuerpo">
                        <h3 class="titulo"><?php echo $pelicula["nom"]; ?></h3>
                        <p class="hoy">Avui</p>
                        <div>
                            <?php foreach ($pelicula["horaris"] as $hora) { ?>
                                <span class="horario"><?php echo $hora; ?></span>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="tarjeta-pie">
                        <a href="trailer.php?id=<?php echo $id; ?>" class="boton-tarjeta">▶ Veure tràiler</a>
                        <a href="detall.php?id=<?php echo $id; ?>" class="boton-tarjeta">Més informació</a>
                    </div>

                </div>
            <?php } ?>

        </div>
    </main>

</body>
</html>