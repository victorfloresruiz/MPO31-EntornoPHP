
<?php

require_once "dades.php";

$missatge = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuari = $_POST["usuari"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if ($usuari == "" || $password == "" || $password2 == "") {
        $missatge = "Has d'omplir tots els camps.";
    } elseif ($password != $password2) {
        $missatge = "Les contrasenyes no coincideixen.";
    } else {

        $existeix = false;

        foreach ($_SESSION["usuaris"] as $u) {
            if ($u["usuari"] == $usuari) {
                $existeix = true;
            }
        }

        if ($existeix) {
            $missatge = "Aquest usuari ja existeix.";
        } else {

            $nouId = 1;

            foreach ($_SESSION["usuaris"] as $u) {
                if ($u["id"] >= $nouId) {
                    $nouId = $u["id"] + 1;
                }
            }

            $nouUsuari = [
                "id" => $nouId,
                "usuari" => $usuari,
                "password" => $password,
                "rol" => "jugador"
            ];

            $_SESSION["usuaris"][] = $nouUsuari;

            $missatge = "Registre correcte! Ja pots iniciar sessió.";
        }
    }
}
?>

<!doctype html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registre</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php 

include "header.php"; 

?>

<main class="contenidor">
    <section class="panell ample-mig">

        <h1>Registre de jugador</h1>

        <p class="subtitol">Crea un compte per poder jugar.</p>

        <form action="registre.php" method="post">

            <label class="camp">Nom d'usuari
                <input type="text" name="usuari" required>
            </label>

            <label class="camp">Contrasenya
                <input type="password" name="password" required>
            </label>

            <label class="camp">Repeteix la contrasenya
                <input type="password" name="password2" required>
            </label>

            <button class="btn" type="submit">Registrar-me</button>

        </form>

        <p class="nota">
            Els nous comptes han de tenir sempre el rol de jugador.
        </p>

        <?php if ($missatge != "") { ?>
            <p class="nota"><?php echo $missatge; ?></p>
        <?php } ?>

    </section>
</main>

<?php 

include "footer.php"; 

?>

</body>
</html>
