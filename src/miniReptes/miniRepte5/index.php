<?php

session_start();

include 'preguntas.php';

$total_habitaciones = 3;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['dificultad'])) {
        $dificultad_elegida = $_POST['dificultad'];

        if (!isset($preguntas[$dificultad_elegida])) {
            echo 'Tienes que elegir una dificultad válida';
        } else {
            $_SESSION['dificultad'] = $dificultad_elegida;
            $_SESSION['habitacion'] = 0;
            header('Location: index.php');
            exit;
        }
    }

    if (isset($_POST['respuesta']) && isset($_SESSION['dificultad'])) {
        $respuesta_ingresada = $_POST['respuesta'];
        $dificultad_actual = $_SESSION['dificultad'];
        $habitacion_actual = $_SESSION['habitacion'];

        if ($respuesta_ingresada === '') {
            echo 'Tienes que escribir una respuesta';
        } elseif ($respuesta_ingresada !== $preguntas[$dificultad_actual][$habitacion_actual]['respuesta']) {
            echo 'Respuesta incorrecta, vuelve a intentarlo';
        } else {
            $_SESSION['habitacion'] = $habitacion_actual + 1;
            header('Location: index.php');
            exit;
        }
    }
}

$dificultad = $_SESSION['dificultad'] ?? '';
$habitacion = $_SESSION['habitacion'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Escape Room</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Quiz Escape Room</h1>

    <?php if ($dificultad === '') { ?>

        <h2>Elige la dificultad</h2>

        <form action="" method="POST">
            <input type="radio" name="dificultad" value="facil" class="dificultad"> Fácil
            <input type="radio" name="dificultad" value="media" class="dificultad"> Media
            <input type="radio" name="dificultad" value="dificil" class="dificultad"> Difícil
            <button type="submit">Empezar</button>
        </form>

    <?php } elseif ($habitacion >= $total_habitaciones) { ?>

        <?php include 'final.php'; ?>

    <?php } else { ?>

        <h2>Habitación <?php echo $habitacion + 1; ?> de <?php echo $total_habitaciones; ?></h2>
        <p>Dificultad: <?php echo $dificultad; ?></p>
        <p><?php echo $preguntas[$dificultad][$habitacion]['pregunta']; ?></p>

        <form action="" method="POST">
            <input type="text" placeholder="Tu respuesta" name="respuesta" class="respuesta">
            <button type="submit">Enviar</button>
        </form>

    <?php } ?>
</body>
</html>