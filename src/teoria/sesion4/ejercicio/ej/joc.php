<?php
require_once "dades.php";

if (!isset($_SESSION["usuari_actiu"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION["usuari_actiu"]["rol"] != "jugador") {
    header("Location: admin.php");
    exit();
}

$idJugador = $_SESSION["usuari_actiu"]["id"];

if (!isset($_SESSION["partida"]) || $_SESSION["partida"]["idJugador"] != $idJugador) {
    $_SESSION["partida"] = [
        "idJugador" => $idJugador,
        "preguntes" => array_values($_SESSION["preguntes"]),
        "posicio" => 0,
        "punts" => 0
    ];
}

$missatge = "";

if (isset($_SESSION["missatgeJoc"])) {
    $missatge = $_SESSION["missatgeJoc"];
    unset($_SESSION["missatgeJoc"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["resposta"])) {
    $posicio = $_SESSION["partida"]["posicio"];
    $total = count($_SESSION["partida"]["preguntes"]);

    if ($posicio < $total) {
        $preguntaActual = $_SESSION["partida"]["preguntes"][$posicio];
        $resposta = $_POST["resposta"];

        if (!in_array($resposta, ["0", "1", "2", "3"], true)) {
            $missatge = "Resposta no vàlida.";
        } elseif ($resposta == $preguntaActual["correcta"]) {
            $_SESSION["partida"]["punts"]++;
            $_SESSION["partida"]["posicio"]++;
            $missatge = "Correcte! Has guanyat un punt.";
        } else {
            $missatge = "Resposta incorrecta! Torna-ho a intentar.";
        }
    }

    $_SESSION["missatgeJoc"] = $missatge;

    header("Location: joc.php");
    exit();
}

$posicio = $_SESSION["partida"]["posicio"];
$punts = $_SESSION["partida"]["punts"];
$total = count($_SESSION["partida"]["preguntes"]);

$acabat = false;

if ($posicio >= $total) {
    $acabat = true;
}

if (!$acabat) {
    $preguntaActual = $_SESSION["partida"]["preguntes"][$posicio];
}
?>

<!doctype html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trivial</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php 

include "header.php"; 

?>

<main class="contenidor">
    <section class="panell">

        <h1>Hola, <?php echo $_SESSION["usuari_actiu"]["usuari"]; ?>!</h1>

        <p class="subtitol">Respon la pregunta i continua avançant.</p>

        <?php if ($total == 0) { ?>

            <h2>No hi ha preguntes disponibles.</h2>

        <?php } elseif (!$acabat) { ?>

            <div class="estadistiques">
                <p>Puntuació: <?php echo $punts; ?> punts</p>
                <p>Progrés: <?php echo $posicio + 1; ?> de <?php echo $total; ?></p>
                <p>Pendents: <?php echo $total - $posicio; ?></p>
            </div>

            <span class="etiqueta">
                <?php echo $preguntaActual["categoria"]; ?>
            </span>

            <h2 style="margin-top: 15px">
                <?php echo $preguntaActual["pregunta"]; ?>
            </h2>

            <form method="post" action="joc.php">

                <?php foreach ($preguntaActual["opcions"] as $clau => $opcio) { ?>

                    <label class="resposta">
                        <input type="radio" name="resposta" value="<?php echo $clau; ?>" required>
                        <?php echo $opcio; ?>
                    </label>

                <?php } ?>

                <button class="btn" type="submit">Comprovar resposta</button>

            </form>

            <?php if ($missatge != "") { ?>
                <div class="alerta">
                    <?php echo $missatge; ?>
                </div>
            <?php } ?>

        <?php } else { ?>

            <h2>Partida acabada!</h2>

            <p>
                Has aconseguit <?php echo $punts; ?> punts de <?php echo $total; ?>.
            </p>

            <a class="btn" href="nova_partida.php">Començar una partida nova</a>

        <?php } ?>

    </section>
</main>

<?php 

include "footer.php"; 

?>

</body>
</html>