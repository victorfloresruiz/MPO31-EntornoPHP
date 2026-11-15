<?php

require_once "dades.php";

if (!isset($_SESSION["usuari_actiu"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION["usuari_actiu"]["rol"] != "admin") {
    header("Location: joc.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $id = $_POST["eliminar"];

    foreach ($_SESSION["preguntes"] as $clau => $p) {
        if ($p["id"] == $id) {
            unset($_SESSION["preguntes"][$clau]);
        }
    }

    $_SESSION["preguntes"] = array_values($_SESSION["preguntes"]);

    header("Location: admin.php");
    exit();
}
?>
<!doctype html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administració</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<?php

include "includes/header.php";

?>
<main class="contenidor">
    <section class="panell">
        <div class="navegacio">
            <div>
                <h1>Gestió de preguntes</h1>
                <p class="subtitol">Banc de preguntes del Trivial</p>
            </div>
            <a class="btn" href="pregunta.php">+ Nova pregunta</a>
        </div>

        <div class="taula-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Categoria</th>
                        <th>Enunciat</th>
                        <th>Accions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION["preguntes"] as $p) { ?>

                        <tr>
                            <td><?php echo $p["id"]; ?></td>
                            <td><?php echo $p["categoria"]; ?></td>
                            <td><?php echo $p["pregunta"]; ?></td>
                            <td>
                                <a class="btn btn-sec" href="pregunta.php?id=<?php echo $p["id"]; ?>">Editar</a>
                                <form action="admin.php" method="post">
                                    <input type="hidden" name="eliminar" value="<?php echo $p["id"]; ?>">
                                    <button class="btn btn-perill" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <p class="nota">Total de preguntes: <?php echo count($_SESSION["preguntes"]); ?></p>

        <hr>

        <h2>Reiniciar aplicació</h2>
        <p class="nota">S'esborraran els usuaris registrats i les preguntes creades.</p>

        <form action="logout.php" method="post">
            <input type="hidden" name="accio" value="reiniciar">
            <button class="btn btn-perill" type="submit">Reiniciar aplicació</button>
        </form>
    </section>
</main>
<?php

include "includes/footer.php";

?>
</body>
</html>