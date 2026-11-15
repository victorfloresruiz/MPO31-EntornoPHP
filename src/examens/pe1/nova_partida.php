<?php
require_once "dades.php";

unset($_SESSION["partida"]);

header("Location: joc.php");
exit();
?>