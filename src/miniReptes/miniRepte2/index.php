<?php
$nomProjectes = [
    "Landing per a clínica dental",
    "Catàleg de productes artesans",
    "Blog corporatiu escola",
    "Auditoria responsive",
    "Fitxa de servei amb CTA",
    "Galeria de projectes",
    "Botiga online bàsica",
    "Optimització d'imatges"
];

$tipusProjectes = [
    "Web",
    "Ecommerce",
    "CMS",
    "Qualitat",
    "Web",
    "CMS",
    "Ecommerce",
    "Web"
];

$horas = [6, 4, 3, 5, 2, 4, 8, 3];

$prioritats = [7, 5, 2, 8, 4, 3, 9, 6];

$tecnologies = ["HTML", "CSS", "PHP", "Docker", "WordPress", "Shopify"];

//TOTALES
$totalProjectes = 8;
$totalTecnologies = 6;
 
$totalHores = 0;
foreach ($horas as $horaIndividual) {
    $totalHores += $horaIndividual;
}
 
$totalAlta = 0;
foreach ($prioritats as $prioritat) {
    if ($prioritat >= 7) {
        $totalAlta++;
    }
}
    

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panell de projectes</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0; 
            padding: 0; }
 
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(180deg, #f4f7ff, #ffffff);
            color: #16204a;
            padding: 32px;
            max-width: 1200px;
            margin: 0 auto;
        }
 
        /* Capçalera */
        header { 
            margin-bottom: 28px; 
        }
        header h1 { 
            font-size: 2rem; 
        }
        header p { 
            color: #6b7390; 
            margin-top: 4px; 
        }
 
        h2 { 
            font-size: 1.5rem; 
            margin: 36px 0 16px; }
 
        /* Totals de dalt */
        .totals {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
        .total {
            padding: 22px;
            border-radius: 16px;
            border-left: 6px solid transparent;
        }
        .total strong { 
            display: block; 
            font-size: 2.2rem; 
            line-height: 1; 
            margin-bottom: 6px; 
        }
        .total span { font-size: .95rem;
            color: #4a5175; 
        }
 
        .blau { 
            background: #e3eeff; 
        }
        .rosa { 
            background: #fde0e2; 
        }
        .verd { 
            background: #d9f4e3; 
        }
        .lila { 
            background: #ece6ff; 
        }
 
        /* Targetes */
        .contenidor {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
        .targeta {
            background: #fff;
            border-radius: 16px;
            padding: 18px;
        }
        .targeta h3 {
            font-size: 1rem;
            line-height: 1.3;
            margin-bottom: 14px;
        }
        .targeta h3 .num { 
            color: #6b7390; 
            margin-right: 6px; 
        }
        .targeta p {
            margin: 8px 0;
            font-size: .92rem;
            color: #555b7a;
        }

        .alta{
            background-color: red;
        }

        .baja {
            background-color: green;
        }

        .media {
            background-color: orange;
        }
    </style>
</head>
<body>
 
<header>
    <h1>Panell intern de projectes</h1>
    <p>Agència digital · Gestió de projectes d'estudi</p>
</header>
 
<!-- TOTALS DE DALT -->
<div class="totals">
    <div class="total blau">
        <strong><?php echo $totalProjectes; ?></strong>
        <span>Projectes</span>
    </div>
    <div class="total rosa">
        <strong><?php echo $totalAlta; ?></strong>
        <span>Prioritat alta</span>
    </div>
    <div class="total verd">
        <strong><?php echo $totalHores; ?> h</strong>
        <span>Hores estimades</span>
    </div>
    <div class="total lila">
        <strong><?php echo $totalTecnologies; ?></strong>
        <span>Tecnologies</span>
    </div>
</div>
 
<!-- TARGETES -->
<h2>Projectes actius</h2>
<div class="contenidor">
    <?php for ($i = 0; $i < $totalProjectes; $i++) { ?>
        <div class="targeta">
            <?php echo $prioritat?>
            <?php if(){}?>
            <h3><span class="num">#<?php echo $i + 1; ?></span><?php echo $nomProjectes[$i]; ?></h3>
            <p>Tipus: <?php echo $tipusProjectes[$i]; ?></p>
            <p>Hores: <?php echo $horas[$i]; ?> h</p>
            <p>Prioritat: <?php echo $prioritats[$i]; ?>/10</p>
        </div>
    <?php } ?>
</div>
 
</body>
</html>