<?php

if (!isset($_SESSION["libros"])) {
    $_SESSION["libros"] = [
        [
            "titulo" => "1984",
            "autor" => "George Orwell",
            "imagen" => "https://m.media-amazon.com/images/I/71sOSrd+JxL._AC_UF1000,1000_QL80_.jpg",
            "descripcion" => "Una novela sobre un futuro donde el Gran Hermano lo vigila todo."
        ],
        [
            "titulo" => "El Principito",
            "autor" => "Antoine de Saint-Exupéry",
            "imagen" => "https://m.media-amazon.com/images/I/71AVK5VIAzL._AC_UF1000,1000_QL80_.jpg",
            "descripcion" => "Un piloto conoce a un pequeño príncipe que viaja de planeta en planeta."
        ],
        [
            "titulo" => "Cien años de soledad",
            "autor" => "Gabriel García Márquez",
            "imagen" => "https://m.media-amazon.com/images/I/91i3tP7bfAL._AC_UF1000,1000_QL80_.jpg",
            "descripcion" => "La historia de la familia Buendía en el pueblo de Macondo."
        ]
    ];
}

function agregarLibro($titulo, $autor, $imagen, $descripcion) {
    $_SESSION["libros"][] = [
        "titulo" => $titulo,
        "autor" => $autor,
        "imagen" => $imagen,
        "descripcion" => $descripcion
    ];
}

function editarLibro($id, $titulo, $autor, $imagen, $descripcion) {
    if (isset($_SESSION["libros"][$id])) {
        $_SESSION["libros"][$id] = ["titulo" => $titulo, "autor" => $autor, "imagen" => $imagen, "descripcion" => $descripcion];
    }
}

function eliminarLibro($id) {
    if (isset($_SESSION["libros"][$id])) {
        unset($_SESSION["libros"][$id]);
        $_SESSION["libros"] = array_values($_SESSION["libros"]);
    }
}
?>