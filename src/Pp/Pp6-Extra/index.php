<?php
session_start();

include "funcions.php";
include "includes/header.php";

$tiradas = 0;

if (!isset($_SESSION["tiradas"])) {
    $_SESSION["tiradas"] = 0;
}

if (!isset($_SESSION["basura_actual"])) {
    nuevaBasura($basuras);
}
?>

<?php if (isset($_SESSION["mensaje"])): ?>
    <p><?php echo $_SESSION["mensaje"]; ?></p>
    <?php unset($_SESSION["mensaje"]); ?>
<?php endif; ?>

<p>Basura tirada: <?php echo $_SESSION["tiradas"]; ?></p>
<h2>¿Dónde tiras: <?php echo $_SESSION["basura_actual"]["titulo"]; ?>?</h2>

<?php foreach ($contenedores as $clave => $nombre): ?>
    <div class="contenedor">
        <a href="contenedores/<?php echo $clave; ?>.php"><?php echo $nombre; ?></a>
    </div>
<?php endforeach; ?>

<a href="reiniciar.php">Sacar basura</a>

<?php include "includes/footer.php"; ?>