<?php
require_once('config.php');

$pdo = db();

$sql = '
SELECT
    p.id,
    p.nom,
    p.descripcio,
    v.nom AS videojoc,
    u.nom AS propietari
FROM personatges AS p
JOIN videojocs AS v
    ON v.id = p.videojoc_id
JOIN usuaris AS u
    ON u.id = p.usuari_id
ORDER BY p.id DESC
';

$stmt = $pdo->query($sql);
$personatges = $stmt->fetchAll();

var_dump($personatges);
?>

<!doctype html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Personatges DB</title>
</head>
<body>
    <h1>Col·lecció de personatges</h1>

    <?php foreach ($personatges as $personatge): ?>
        <article>
            <h2><?= $personatge['nom'] ?></h2>
            <p>
                Videojoc:
                <?= $personatge['videojoc'] ?>
            </p>
            <p>
                Propietari:
                <?= $personatge['propietari'] ?>
            </p>
            <p>
                <?= $personatge['descripcio'] ?>
            </p>
        </article>
        <hr>
    <?php endforeach; ?>
</body>
</html>