<?php
require_once('config.php');

$pdo = db();

$sql = '
SELECT
    p.id,
    p.nom,
    p.descripcio,
    p.imatge,
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
?>
<!doctype html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Personatges DB</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Col·lecció de personatges</h1>
    <p><a href="crear_personaje.php">+ Crear nou personatge</a></p>

    <?php if (empty($personatges)): ?>
        <p>Encara no hi ha cap personatge creat.</p>
    <?php else: ?>
        <?php foreach ($personatges as $personatge): ?>
            <article>
                <h2>
                    <a href="detalle_personaje.php?id=<?= $personatge['id'] ?>">
                        <?= $personatge['nom'] ?>
                    </a>
                </h2>

                <?php if (!empty($personatge['imatge'])): ?>
                    <img src="<?= $personatge['imatge'] ?>" alt="<?= $personatge['nom'] ?>">
                <?php endif; ?>

                <p><strong>Videojoc:</strong> <?= $personatge['videojoc'] ?></p>
                <p><strong>Propietari:</strong> <?= $personatge['propietari'] ?></p>
                
                <div>
                    <a href="detalle_personaje.php?id=<?= $personatge['id'] ?>">Veure detall</a> |
                    <a href="editar_personaje.php?id=<?= $personatge['id'] ?>">Editar</a> |
                    
                    <form action="eliminar_personaje.php" method="post" style="display: inline;" onsubmit="return confirm('Segur que vols eliminar aquest personatge?');">
                        <input type="hidden" name="id" value="<?= $personatge['id'] ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>