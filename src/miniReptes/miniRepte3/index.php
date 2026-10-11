<?php
$conceptes = [
    [
        "titol" => "Variables",
        "bloc" => "PHP",
        "explicacio" => "Sirven para guardar datos. En PHP empiezan con $.",
        "codi" => "\$nom = \"Albert\";",
        "destacat" => true
    ],
    [
        "titol" => "If / else",
        "bloc" => "PHP",
        "explicacio" => "Hace que el programa elija un camino u otro según una condición.",
        "codi" => "if (\$edat >= 18) {\n  echo \"Mayor\";\n}",
        "destacat" => true
    ],
    [
        "titol" => "Foreach",
        "bloc" => "PHP",
        "explicacio" => "Recorre todos los elementos de un array uno a uno.",
        "codi" => "foreach (\$noms as \$nom) {\n  echo \$nom;\n}",
        "destacat" => false
    ],
    [
        "titol" => "Variables JS",
        "bloc" => "JavaScript",
        "explicacio" => "Guardan datos en JavaScript. Se crean con let o const.",
        "codi" => "let edat = 20;",
        "destacat" => false
    ],
    [
        "titol" => "Funciones",
        "bloc" => "JavaScript",
        "explicacio" => "Un trozo de código que podemos reutilizar cuando queramos.",
        "codi" => "function saludar() {\n  alert(\"Hola\");\n}",
        "destacat" => true
    ],
    [
        "titol" => "Eventos",
        "bloc" => "JavaScript",
        "explicacio" => "Hacen que la página reaccione cuando el usuario hace algo, como un clic.",
        "codi" => "boton.onclick = saludar;",
        "destacat" => false
    ],
    [
        "titol" => "Etiquetas semánticas",
        "bloc" => "HTML/CSS",
        "explicacio" => "Etiquetas como header, main y footer que indican qué parte es cada cosa.",
        "codi" => "<header>...</header>\n<main>...</main>",
        "destacat" => true
    ],
    [
        "titol" => "Flexbox",
        "bloc" => "HTML/CSS",
        "explicacio" => "Sirve para colocar elementos en fila o columna fácilmente.",
        "codi" => ".caja {\n  display: flex;\n}",
        "destacat" => false
    ],
    [
        "titol" => "Media queries",
        "bloc" => "HTML/CSS",
        "explicacio" => "Cambian el estilo según el ancho de pantalla, así se ve bien en móvil.",
        "codi" => "@media (max-width: 600px) {\n  ...\n}",
        "destacat" => true
    ],
    [
        "titol" => "Imagen",
        "bloc" => "Docker",
        "explicacio" => "Es la plantilla a partir de la cual se crea un contenedor.",
        "codi" => "docker pull nginx",
        "destacat" => false
    ],
    [
        "titol" => "Contenedor",
        "bloc" => "Docker",
        "explicacio" => "Es una imagen en marcha, donde se ejecuta nuestra aplicación.",
        "codi" => "docker run nginx",
        "destacat" => false
    ],
    [
        "titol" => "Docker compose",
        "bloc" => "Docker",
        "explicacio" => "Arranca varios servicios a la vez con un solo fichero.",
        "codi" => "docker compose up -d",
        "destacat" => true
    ]
];

$blocsUtilitzats = ["PHP", "JavaScript", "HTML/CSS", "Docker"];

$totalConceptes = count($conceptes);

$totalDestacats = 0;
$totalPHP = 0;
$totalJS = 0;
$totalHTML = 0;
$totalDocker = 0;

foreach ($conceptes as $concepte) {
    if ($concepte["destacat"]) {
        $totalDestacats++;
    }

    if ($concepte["bloc"] == "PHP") {
        $totalPHP++;
    } elseif ($concepte["bloc"] == "JavaScript") {
        $totalJS++;
    } elseif ($concepte["bloc"] == "HTML/CSS") {
        $totalHTML++;
    } else {
        $totalDocker++;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chuleta digital DAW2</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Chuleta digital DAW2</h1>
    <p>Los conceptos clave del curso, en un solo sitio.</p>
</header>

<h2>Conceptos</h2>
<div class="contenidor">
    <?php for ($i = 0; $i < $totalConceptes; $i++) {

        if ($conceptes[$i]["bloc"] == "PHP") {
            $color = "php";
        } elseif ($conceptes[$i]["bloc"] == "JavaScript") {
            $color = "js";
        } elseif ($conceptes[$i]["bloc"] == "HTML/CSS") {
            $color = "html";
        } else {
            $color = "docker";
        }

        if ($i % 2 == 0) {
            $par = "par";
        } else {
            $par = "impar";
        }
    ?>
        <div class="targeta <?php echo $color; ?> <?php echo $par; ?>">
            <p class="bloc"><?php echo $conceptes[$i]["bloc"]; ?></p>
            <h3><?php echo $conceptes[$i]["titol"]; ?></h3>
            <p><?php echo $conceptes[$i]["explicacio"]; ?></p>
            <pre><?php echo htmlspecialchars($conceptes[$i]["codi"]); ?></pre>
            <?php if ($conceptes[$i]["destacat"]) { ?>
                <p class="estrella">⭐ Concepto destacado</p>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<h2>Resumen</h2>
<div class="resum">
    <div class="caja">
        <p>Total de conceptos: <strong><?php echo $totalConceptes; ?></strong></p>
        <p>Conceptos destacados: <strong><?php echo $totalDestacats; ?></strong></p>
    </div>

    <div class="caja">
        <p>Conceptos por bloc:</p>
        <p>PHP: <?php echo $totalPHP; ?></p>
        <p>JavaScript: <?php echo $totalJS; ?></p>
        <p>HTML/CSS: <?php echo $totalHTML; ?></p>
        <p>Docker: <?php echo $totalDocker; ?></p>
    </div>

    <div class="caja">
        <p>Blocs utilizados:</p>
        <?php foreach ($blocsUtilitzats as $b) { ?>
            <p>• <?php echo $b; ?></p>
        <?php } ?>
    </div>
</div>

</body>
</html>
