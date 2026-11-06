<?php
session_start();

include "funciones.php";
include "includes/header.php";

$tiradas = 0;

if (!isset($_SESSION["tiradas"])) {
    $_SESSION["tiradas"] = 0;
}

if (!isset($_SESSION["basura_actual"])) {
    nuevaBasura($basuras);
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7f6;
        color: #333;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    p {
        font-size: 1.1rem;
        margin: 15px 0;
    }

    h2 {
        color: #2c3e50;
        margin-top: 20px;
    }

    /* Grid para organizar los contenedores */
    .contenedores {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        max-width: 800px;
        margin: 30px auto;
        padding: 0 10px;
    }

    /* Tarjeta de cada contenedor */
    .contenedor {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #ffffff;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 15px;
        width: 130px;
        text-decoration: none;
        color: #333;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .contenedor:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .contenedor img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .contenedor span {
        font-weight: bold;
        font-size: 1rem;
    }

    /* Botón de reiniciar / sacar basura */
    a[href="reiniciar.php"] {
        display: inline-block;
        margin: 20px 0 40px;
        padding: 10px 20px;
        background-color: #e74c3c;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: background-color 0.2s ease;
    }

    a[href="reiniciar.php"]:hover {
        background-color: #c0392b;
    }
</style>

<?php if (isset($_SESSION["mensaje"])): ?>
    <p><?php echo $_SESSION["mensaje"]; ?></p>
    <?php unset($_SESSION["mensaje"]); ?>
<?php endif; ?>

<p>Basura tirada: <?php echo $_SESSION["tiradas"]; ?></p>
<h2>¿Dónde tiras: <?php echo $_SESSION["basura_actual"]["titulo"]; ?>?</h2>

<div class="contenedores">
    <?php foreach ($contenedores as $clave => $datos): ?>
        <a class="contenedor <?php echo $clave; ?>" href="tirar.php?tipo=<?php echo $clave; ?>">
            <img src="<?php echo $datos["img"]; ?>" alt="<?php echo $datos["nombre"]; ?>">
            <span><?php echo $datos["nombre"]; ?></span>
        </a>
    <?php endforeach; ?>
</div>

<a href="reiniciar.php">Sacar basura</a>

<?php include "includes/footer.php"; ?>