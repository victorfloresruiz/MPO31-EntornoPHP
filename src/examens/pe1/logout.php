<?php
session_start();

if (isset($_POST["accio"]) && $_POST["accio"] == "reiniciar") {
    session_destroy();
} else {
    unset($_SESSION["usuari_actiu"]);
    unset($_SESSION["partida"]);
}

header("Location: login.php");
exit();
?>