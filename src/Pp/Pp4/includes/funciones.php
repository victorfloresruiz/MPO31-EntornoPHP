<?php

function generarTablaProductos($productos) {
    ?>
    <table class="tabla-productos">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <?php 
                    $estadoTexto = $producto['disponibilidad'] ? "En stock" : "Agotado";
                    $claseFila = $producto['disponibilidad'] ? "" : "producto-agotado";
                ?>
                <tr class="<?= $claseFila ?>">
                    <td class="nombre-producto"><?= $producto['nombre'] ?></td>
                    <td><?= $producto['categoria'] ?></td>
                    <td><?= number_format($producto['precio'], 2, ',', '.') ?> €</td>
                    <td><?= $estadoTexto ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
}

function muestraInfoContacto($nombre, $telefono, $foto) {
    ?>
    <div class="bloque-contacto">
        <h3>Datos de contacto del cliente</h3>
        <img src="<?= $foto ?>" alt="Foto de <?= $nombre ?>" class="foto-contacto">
        <p><strong>Nombre:</strong> <?= $nombre ?></p>
        <p><strong>Teléfono:</strong> <?= $telefono ?></p>
    </div>
    <?php
}

?>