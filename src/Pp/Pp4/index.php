<?php
require_once "data/productos.php";
require_once "includes/funciones.php";

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 'Invitado';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : 'No facilitado';
$foto = isset($_POST['foto']) ? $_POST['foto'] : '';

include "includes/header.php";
?>

<main class="contenedor-principal">
    <h2>Catálogo de Productos</h2>
    
    <?php
    generarTablaProductos($productos);

    muestraInfoContacto($nombre, $telefono, $foto);
    ?>
</main>

<?php
include "includes/footer.php";
?>