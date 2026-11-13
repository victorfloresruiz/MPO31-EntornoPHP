<?php

require_once "dades.php";

$missatge = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuari = $_POST["usuari"];
    $password = $_POST["password"];
    $trobat = false;

    foreach ($_SESSION["usuaris"] as $u) {
        if ($u["usuari"] == $usuari && $password == $u["password"]) {
            $trobat = true;

            $_SESSION["usuari_actiu"] = [
                "id" => $u["id"],
                "usuari" => $u["usuari"],
                "rol" => $u["rol"]
            ];

            if ($u["rol"] == "admin") {
                header("Location: admin.php");
            } else {
                header("Location: joc.php");
            }

            exit();
        }
    }

    if (!$trobat) {
        $missatge = "Usuari o contrasenya incorrectes.";
    }
}
?>

<!doctype html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php 

include "header.php"; 

?>

<main class="contenidor">
    <section class="panell ample-mig">
        <h1>Iniciar sessió</h1>
        <p class="subtitol">Entra al teu compte del Trivial.</p>

        <form action="login.php" method="post">

            <label class="camp">Nom d'usuari
                <input type="text" name="usuari" required>
            </label>

            <label class="camp">Contrasenya
                <input type="password" name="password" required>
            </label>

            <button class="btn" type="submit">Entrar</button>

        </form>

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