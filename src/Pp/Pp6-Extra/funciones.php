<?php

$contenedores = [
    "carton" => [
        "nombre" => "Cartón",
        "img"    => "imagenes/azul.png"
    ],
    "organica" => [
        "nombre" => "Orgánica",
        "img"    => "imagenes/rojo.png"
    ],
    "plastico" => [
        "nombre" => "Plástico",
        "img"    => "imagenes/amarillo.png"
    ],
    "vidrio" => [
        "nombre" => "Vidrio",
        "img"    => "imagenes/verde.png"
    ]
];


$basuras = [
    ["id" => 1, "titulo" => "Botella de plástico", "contenedor" => "plastico"],
    ["id" => 2, "titulo" => "Lata de refresco",    "contenedor" => "plastico"],
    ["id" => 3, "titulo" => "Caja de cartón",      "contenedor" => "carton"],
    ["id" => 4, "titulo" => "Papel de periódico",  "contenedor" => "carton"],
    ["id" => 5, "titulo" => "Botella de vidrio",   "contenedor" => "vidrio"],
    ["id" => 6,  "titulo" => "Envase de yogur",   "contenedor" => "plastico"],
    ["id" => 7,  "titulo" => "Bolsa de plástico", "contenedor" => "plastico"],
    ["id" => 8,  "titulo" => "Cartón de leche",   "contenedor" => "carton"],
    ["id" => 9, "titulo" => "Lata de conservas", "contenedor" => "plastico"],
    ["id" => 10, "titulo" => "Cáscara de plátano",  "contenedor" => "organica"],
];

function nuevaBasura($basuras){
    $_SESSION["basura_actual"] = $basuras[array_rand($basuras)];
}

function tirar($basuras, $contenedor){
    if($_SESSION["basura_actual"]["contenedor"] == $contenedor){
        $_SESSION["mensaje"] = "¡Correcto! Has tirado la basura en el contenedor correcto.";
        $_SESSION["tiradas"]++;
        nuevaBasura($basuras);
    } else {
        $_SESSION["mensaje"] = "¡Incorrecto! Vuelve a intentarlo.";
    }
}

?>