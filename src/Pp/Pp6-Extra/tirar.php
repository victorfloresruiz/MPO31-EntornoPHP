<?php
session_start();
include "funciones.php";

if (isset($_GET["tipo"])) {
    $contenedorElegido = $_GET["tipo"];
    tirar($basuras, $contenedorElegido);
}

header("Location: index.php");
exit;