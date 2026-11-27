<?php
require_once('config.php');

$pdo = db();
$error = '';

// ----------------------------------------------------
// PROCESSAR EL FORMULARI
// ----------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $descripcio = trim($_POST['descripcio'] ?? '');
    $videojocId = $_POST['videojoc_id'] ?? '';

    if ($nom === '' || $videojocId === '') {
        $error = 'El nom i el videojoc són obligatoris.';
    } else {
        $sql = '
            INSERT INTO personatges
                (usuari_id, videojoc_id, nom, descripcio)
            VALUES
                (:usuari_id, :videojoc_id, :nom, :descripcio)
        ';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'usuari_id'   => 1,
            'videojoc_id' => $videojocId,
            'nom'         => $nom,
            'descripcio'  => $descripcio
        ]);

        // Redirigir al llistat per evitar reenviaments del formulari
        header('Location: index.php');
        exit;
    }
}

// ----------------------------------------------------
// OBTENIR VIDEOJOCS PER AL SELECT
// ----------------------------------------------------
$sql = 'SELECT id, nom FROM videojocs ORDER BY nom';
$stmt = $pdo->query($sql);
$videojocs = $stmt->fetchAll();
?>
<!doctype html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Crear personatge</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Crear personatge</h1>
    <p><a href="index.php">&larr; Tornar al llistat</a></p>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= ($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>
            Nom:<br>
            <input type="text" name="nom" required value="<?= ($_POST['nom'] ?? '') ?>">
        </label>
        <br><br>

        <label>
            Descripció:<br>
            <textarea name="descripcio" rows="4" cols="40"><?= ($_POST['descripcio'] ?? '') ?></textarea>
        </label>
        <br><br>

        <label>
            Videojoc:<br>
            <select name="videojoc_id" required>
                <?php foreach ($videojocs as $videojoc): ?>
                    <option value="<?= $videojoc['id'] ?>">
                        <?= ($videojoc['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <br><br>

        <button type="submit">Crear personatge</button>
    </form>
</body>
</html>