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
    "Ecommerce"
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

foreach ($horas as $horaIndividual){
    $totalHores += $horaIndividual;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panell de projectes</title>
    <style>
        
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
            <h3><span class="num">#<?php echo $i + 1; ?></span><?php echo $nomProjectes[$i]; ?></h3>
            <p>Tipus: <?php echo $tipusProjectes[$i]; ?></p>
            <p>Hores: <?php echo $horas[$i]; ?> h</p>
            <p>Prioritat: <?php echo $prioritats[$i]; ?>/10</p>
        </div>
    <?php } ?>
</div>
 
</body>
</html>