<?php
// ---------- PARTIDO 1 ----------
$p1_equipo1_nombre = "Valencia C. F.";
$p1_equipo1_escudo = "imagenes/valencia.png";
$p1_equipo1_goles  = rand(1, 7);

$p1_equipo2_nombre = "Barcelona";
$p1_equipo2_escudo = "imagenes/barça.png";
$p1_equipo2_goles  = rand(1, 7);

// ---------- PARTIDO 2 ----------
$p2_equipo1_nombre = "Real Madrid";
$p2_equipo1_escudo = "imagenes/realmadrid.png";
$p2_equipo1_goles  = rand(1, 7);

$p2_equipo2_nombre = "Sevilla";
$p2_equipo2_escudo = "imagenes/sevilla.png";
$p2_equipo2_goles  = rand(1, 7);

// ---------- PARTIDO 3 ----------
$p3_equipo1_nombre = "Atlético de Madrid";
$p3_equipo1_escudo = "imagenes/atletico.png";
$p3_equipo1_goles  = rand(1, 7);

$p3_equipo2_nombre = "Real Sociedad";
$p3_equipo2_escudo = "imagenes/realsociedad.png";
$p3_equipo2_goles  = rand(1, 7);

// ---------- PARTIDO 4 ----------
$p4_equipo1_nombre = "Villarreal";
$p4_equipo1_escudo = "imagenes/villareal.png";
$p4_equipo1_goles  = rand(1, 7);

$p4_equipo2_nombre = "Athletic Club";
$p4_equipo2_escudo = "imagenes/athletic.png";
$p4_equipo2_goles  = rand(1, 7);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Resultados de los partidos</title>
<style>
    main {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        width: 850px;
        margin: 0 auto;
    }
    .caja {
        width: 400px;
        border: 1px solid #ccc;
    }
    .header {
        background: #202124;
        color: #fff;
        padding: 15px;
    }
    .fila {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        border-bottom: 1px solid #e0e0e0;
    }
    .fila img {
        width: 45px;
        height: 45px;
        object-fit: contain;
        margin-right: 10px;
        vertical-align: middle;
    }
</style>
</head>
<body>
    <main>
 
        <!-- CAJA PARTIDO 1 -->
        <div class="caja">
            <div class="header"><?php echo $p1_equipo1_nombre . " contra " . $p1_equipo2_nombre; ?></div>
            <div class="fila">
                <div>
                    <img src="<?php echo $p1_equipo1_escudo; ?>" alt="escudo"><?php echo $p1_equipo1_nombre; ?>
                </div>
                <div><?php echo $p1_equipo1_goles; ?></div>
            </div>
            <div class="fila">
                <div>
                    <img src="<?php echo $p1_equipo2_escudo; ?>" alt="escudo"><?php echo $p1_equipo2_nombre; ?>
                </div>
                <div><?php echo $p1_equipo2_goles; ?></div>
            </div>
        </div>
 
        <!-- CAJA PARTIDO 2 -->
        <div class="caja">
            <div class="header"><?php echo $p2_equipo1_nombre . " contra " . $p2_equipo2_nombre; ?></div>
            <div class="fila">
                <div>
                    <img src="<?php echo $p2_equipo1_escudo; ?>" alt="escudo"><?php echo $p2_equipo1_nombre; ?>
                </div>
                <div><?php echo $p2_equipo1_goles; ?></div>
            </div>
            <div class="fila">
                <div>
                    <img src="<?php echo $p2_equipo2_escudo; ?>" alt="escudo"><?php echo $p2_equipo2_nombre; ?>
                </div>
                <div><?php echo $p2_equipo2_goles; ?></div>
            </div>
        </div>
 
        <!-- CAJA PARTIDO 3 -->
        <div class="caja">
            <div class="header"><?php echo $p3_equipo1_nombre . " contra " . $p3_equipo2_nombre; ?></div>
            <div class="fila">
                <div>
                    <img src="<?php echo $p3_equipo1_escudo; ?>" alt="escudo"><?php echo $p3_equipo1_nombre; ?>
                </div>
                <div><?php echo $p3_equipo1_goles; ?></div>
            </div>
            <div class="fila">
                <div>
                    <img src="<?php echo $p3_equipo2_escudo; ?>" alt="escudo"><?php echo $p3_equipo2_nombre; ?>
                </div>
                <div><?php echo $p3_equipo2_goles; ?></div>
            </div>
        </div>
 
        <!-- CAJA PARTIDO 4 -->
        <div class="caja">
            <div class="header"><?php echo $p4_equipo1_nombre . " contra " . $p4_equipo2_nombre; ?></div>
            <div class="fila">
                <div>
                    <img src="<?php echo $p4_equipo1_escudo; ?>" alt="escudo"><?php echo $p4_equipo1_nombre; ?>
                </div>
                <div><?php echo $p4_equipo1_goles; ?></div>
            </div>
            <div class="fila">
                <div>
                    <img src="<?php echo $p4_equipo2_escudo; ?>" alt="escudo"><?php echo $p4_equipo2_nombre; ?>
                </div>
                <div><?php echo $p4_equipo2_goles;?></div>
            </div>
        </div>
 
    </main>
</body>
</html>