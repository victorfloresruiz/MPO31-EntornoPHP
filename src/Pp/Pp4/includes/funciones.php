<?php
function generarTablaProductos($productos) {
    echo "<style>
        table.productos {
            border-collapse: collapse;
            margin: 0 auto;
            width: 70%;
        }
        table.productos th {
            background-color: #2e7d32;
            color: white;
            padding: 8px;
        }
        table.productos td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        table.productos tr.agotado {
            color: red;
        }
    </style>";

    echo "<table class='productos'>";
    echo "<tr>";
    echo "<th>Producto</th>";
    echo "<th>Categoría</th>";
    echo "<th>Precio</th>";
    echo "<th>Disponibilidad</th>";
    echo "</tr>";

    foreach ($productos as $producto) {
        $clase = $producto["disponibilidad"] ? "" : "agotado";
        $texto = $producto["disponibilidad"] ? "En stock" : "Agotado";

        echo "<tr class='" . $clase . "'>";
        echo "<td>" . ucfirst($producto["nombre"]) . "</td>";
        echo "<td>" . $producto["categoria"] . "</td>";
        echo "<td>" . number_format($producto["precio"], 2, ",", ".") . " €</td>";
        echo "<td>" . $texto . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

function muestraInfoContacto($nombre, $telefono, $foto) {
    echo "<style>
        div.contacto {
            border: 2px solid #2e7d32;
            border-radius: 8px;
            background-color: white;
            padding: 10px;
            margin: 20px auto;
            width: 300px;
            text-align: center;
        }
        div.contacto h3 {
            color: #2e7d32;
        }
    </style>";

    echo "<div class='contacto'>";
    echo "<h3>Información de contacto</h3>";
    echo "<p>Nombre: " . $nombre . "</p>";
    echo "<p>Teléfono: " . $telefono . "</p>";
    echo "<img src='" . $foto . "' alt='Foto de perfil' width='100'>";
    echo "</div>";
}
?>