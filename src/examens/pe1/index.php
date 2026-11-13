<?php
require_once "dades.php";
?>
<!doctype html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inici</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php 

include "header.php"; 

?>
<main class="contenidor">
    <section class="panell">
        <span class="etiqueta">Examen pràctic · PHP</span>
        <h1>Benvingut al Trivial</h1>
        <p class="subtitol">Una aplicació de preguntes de cultura general: quatre categories i vuit preguntes inicials.</p>
        <div class="grid">
            <div>
                <h2>Soc jugador</h2>
                <p>Registra't, inicia sessió i supera les preguntes una a una.</p>
                
                <?php if (!isset($_SESSION["usuari_actiu"])) { ?>
                    <a class="btn" href="registre.php">Crear compte</a>
                    <a class="btn btn-sec" href="login.php">Ja tinc compte</a>

                <?php } elseif ($_SESSION["usuari_actiu"]["rol"] == "jugador") { ?>
                    <a class="btn" href="joc.php">Començar a jugar</a>
                <?php } ?>
            </div>
            <div>
                <h2>Soc administrador</h2>
                <p>Gestiona el banc de preguntes: consulta, afegeix, edita i elimina.</p>
                <?php if (!isset($_SESSION["usuari_actiu"])) { ?>
                    <a class="btn btn-sec" href="login.php">Entrar com administrador</a>
                <?php } elseif ($_SESSION["usuari_actiu"]["rol"] == "admin") { ?>
                    <a class="btn btn-sec" href="admin.php">Administració</a>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<?php 

include "footer.php"; 

?>
</body>
</html>