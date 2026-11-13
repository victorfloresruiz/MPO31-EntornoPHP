
<?php

session_start();

$categories = [ "Geografia", "Història", "Ciència i natura", "Art i cultura" ];

$preguntes = [
    [ "id" => 1, "categoria" => "Geografia", "pregunta" => "Quin és el continent amb més superfície?", "opcions" => [ "Europa", "Àsia", "Àfrica", "Amèrica del Sud" ], "correcta" => 1 ],
    [ "id" => 2, "categoria" => "Geografia", "pregunta" => "Quina és la capital del Canadà?", "opcions" => [ "Toronto", "Vancouver", "Ottawa", "Mont-real" ], "correcta" => 2 ],
    [ "id" => 3, "categoria" => "Història", "pregunta" => "En quin any va començar la Revolució Francesa?", "opcions" => [ "1776", "1789", "1812", "1848" ], "correcta" => 1 ],
    [ "id" => 4, "categoria" => "Història", "pregunta" => "Quin poble va construir Machu Picchu?", "opcions" => [ "Maies", "Asteques", "Romans", "Inques" ], "correcta" => 3 ],
    [ "id" => 5, "categoria" => "Ciència i natura", "pregunta" => "Quin planeta és conegut com el planeta vermell?", "opcions" => [ "Venus", "Mart", "Júpiter", "Mercuri" ], "correcta" => 1 ],
    [ "id" => 6, "categoria" => "Ciència i natura", "pregunta" => "Quin gas és el més abundant a l'atmosfera terrestre?", "opcions" => [ "Oxigen", "Diòxid de carboni", "Nitrogen", "Hidrogen" ], "correcta" => 2 ],
    [ "id" => 7, "categoria" => "Art i cultura", "pregunta" => "Qui va pintar La nit estelada?", "opcions" => [ "Pablo Picasso", "Claude Monet", "Salvador Dalí", "Vincent van Gogh" ], "correcta" => 3 ],
    [ "id" => 8, "categoria" => "Art i cultura", "pregunta" => "Qui va escriure El petit príncep?", "opcions" => [ "Jules Verne", "Antoine de Saint-Exupéry", "Victor Hugo", "Albert Camus" ], "correcta" => 1 ]
];

$usuaris = [
    [ "id" => 1, "usuari" => "admin", "password" => "admin123", "rol" => "admin" ],
    [ "id" => 2, "usuari" => "jugador", "password" => "jugador123", "rol" => "jugador" ]
];

if (!isset($_SESSION["preguntes"])) {
    $_SESSION["preguntes"] = $preguntes;
}

if (!isset($_SESSION["usuaris"])) {
    $_SESSION["usuaris"] = $usuaris;
}

if (!isset($_SESSION["categories"])) {
    $_SESSION["categories"] = $categories;
}

?>
