
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

$id = "";
$categoria = "";
$enunciat = "";
$opcio_0 = "";
$opcio_1 = "";
$opcio_2 = "";
$opcio_3 = "";
$correcta = "0";
$missatge = "";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $trobada = false;

    foreach ($_SESSION["preguntes"] as $p) {
        if ($p["id"] == $id) {
            $trobada = true;
            $categoria = $p["categoria"];
            $enunciat = $p["pregunta"];
            $opcio_0 = $p["opcions"][0];
            $opcio_1 = $p["opcions"][1];
            $opcio_2 = $p["opcions"][2];
            $opcio_3 = $p["opcions"][3];
            $correcta = $p["correcta"];
        }
    }

    if (!$trobada) {
        header("Location: admin.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $categoria = $_POST["categoria"];
    $enunciat = $_POST["pregunta"];
    $opcio_0 = $_POST["opcio_0"];
    $opcio_1 = $_POST["opcio_1"];
    $opcio_2 = $_POST["opcio_2"];
    $opcio_3 = $_POST["opcio_3"];
    $correcta = $_POST["correcta"];

    if ($categoria == "" || $enunciat == "" || $opcio_0 == "" || $opcio_1 == "" || $opcio_2 == "" || $opcio_3 == "") {
        $missatge = "Has d'omplir tots els camps.";
    } elseif (!in_array($categoria, $_SESSION["categories"]) || !in_array($correcta, ["0", "1", "2", "3"], true)) {
        $missatge = "Les dades no són correctes.";
    } else {

        $novaPregunta = [
            "categoria" => $categoria,
            "pregunta" => $enunciat,
            "opcions" => [$opcio_0, $opcio_1, $opcio_2, $opcio_3],
            "correcta" => $correcta
        ];

        if ($id != "") {
            $trobada = false;

            foreach ($_SESSION["preguntes"] as $clau => $p) {
                if ($p["id"] == $id) {
                    $novaPregunta["id"] = $p["id"];
                    $_SESSION["preguntes"][$clau] = $novaPregunta;
                    $trobada = true;
                }
            }

            if (!$trobada) {
                $missatge = "No s'ha trobat la pregunta.";
            } else {
                header("Location: admin.php");
                exit();
            }

        } else {

            $nouId = 1;

            foreach ($_SESSION["preguntes"] as $p) {
                if ($p["id"] >= $nouId) {
                    $nouId = $p["id"] + 1;
                }
            }

            $novaPregunta["id"] = $nouId;
            $_SESSION["preguntes"][] = $novaPregunta;

            header("Location: admin.php");
            exit();
        }
    }
}
?>

<!doctype html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pregunta</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php 

include "header.php"; 

?>

<main class="contenidor">
    <section class="panell ample-mig">

        <h1>Crear o editar pregunta</h1>

        <p class="subtitol">
            El mateix formulari pot servir per a les dues operacions.
        </p>

        <?php if ($missatge != "") { ?>
            <p class="nota"><?php echo $missatge; ?></p>
        <?php } ?>

        <form action="pregunta.php" method="post">

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label class="camp">Categoria
                <select name="categoria" required>
                    <option value="">Selecciona una categoria</option>

                    <?php foreach ($_SESSION["categories"] as $c) { ?>
                        <option value="<?php echo $c; ?>" <?php if ($categoria == $c) echo "selected"; ?>>
                            <?php echo $c; ?>
                        </option>
                    <?php } ?>

                </select>
            </label>

            <label class="camp">Enunciat
                <textarea name="pregunta" required><?php echo $enunciat; ?></textarea>
            </label>

            <label class="camp">Opció A
                <input type="text" name="opcio_0" value="<?php echo $opcio_0; ?>" required>
            </label>

            <label class="camp">Opció B
                <input type="text" name="opcio_1" value="<?php echo $opcio_1; ?>" required>
            </label>

            <label class="camp">Opció C
                <input type="text" name="opcio_2" value="<?php echo $opcio_2; ?>" required>
            </label>

            <label class="camp">Opció D
                <input type="text" name="opcio_3" value="<?php echo $opcio_3; ?>" required>
            </label>

            <label class="camp">Resposta correcta
                <select name="correcta" required>
                    <option value="0" <?php if ($correcta == "0") echo "selected"; ?>>A</option>
                    <option value="1" <?php if ($correcta == "1") echo "selected"; ?>>B</option>
                    <option value="2" <?php if ($correcta == "2") echo "selected"; ?>>C</option>
                    <option value="3" <?php if ($correcta == "3") echo "selected"; ?>>D</option>
                </select>
            </label>

            <div class="accions">
                <button class="btn" type="submit">Guardar pregunta</button>
                <a class="btn btn-sec" href="admin.php">Cancel·lar</a>
            </div>

        </form>

    </section>
</main>

<?php 

include "footer.php"; 

?>

</body>
</html>
