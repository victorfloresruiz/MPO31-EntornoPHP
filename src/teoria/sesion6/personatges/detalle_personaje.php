<?php
require_once('config.php');

$pdo = db();

// 1. Comprobar que recibimos un ID válido por la URL
$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    header('Location: index.php');
    exit;
}

// 2. Obtener todos los datos del personaje seleccionado
$sql = '
SELECT
    p.id,
    p.nom,
    p.descripcio,
    v.nom AS videojoc,
    v.genere AS genere_videojoc,
    u.nom AS propietari
FROM personatges AS p
JOIN videojocs AS v
    ON v.id = p.videojoc_id
JOIN usuaris AS u
    ON u.id = p.usuari_id
WHERE p.id = :id
';

$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$personatge = $stmt->fetch();

// Si el personaje no existe en la base de datos, volver al listado
if (!$personatge) {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title><?= ($personatge['nom']) ?> - Detall</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p><a href="index.php">&larr; Tornar al llistat</a></p>

    <h1><?= ($personatge['nom']) ?></h1>

    <p><strong>Videojoc:</strong> <?= ($personatge['videojoc']) ?> (<?= ($personatge['genere_videojoc']) ?>)</p>
    <p><strong>Propietari:</strong> <?= ($personatge['propietari']) ?></p>

    <h3>Descripció:</h3>
    <p>
        <?php if (!empty($personatge['descripcio'])): ?>
            <?= nl2br(($personatge['descripcio'])) ?>
        <?php else: ?>
            <em>Sense descripció.</em>
        <?php endif; ?>
    </p>

    <hr>
    <p>
        <a href="editar_personaje.php?id=<?= $personatge['id'] ?>">Editar aquest personatge</a>
    </p>
</body>
</html>