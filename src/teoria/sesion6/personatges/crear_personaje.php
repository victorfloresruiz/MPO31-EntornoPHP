<?php
require_once('config.php');

$pdo = db();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $descripcio = trim($_POST['descripcio'] ?? '');
    $videojocId = $_POST['videojoc_id'] ?? '';
    $imatge = trim($_POST['imatge'] ?? '');

    if ($nom === '' || $videojocId === '') {
        $error = 'El nom i el videojoc són obligatoris.';
    } else {
        $sql = '
            INSERT INTO personatges
                (usuari_id, videojoc_id, nom, descripcio, imatge)
            VALUES
                (:usuari_id, :videojoc_id, :nom, :descripcio, :imatge)
        ';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'usuari_id'   => 1,
            'videojoc_id' => $videojocId,
            'nom'         => $nom,
            'descripcio'  => $descripcio,
            'imatge'      => $imatge !== '' ? $imatge : null
        ]);

        header('Location: index.php');
        exit;
    }
}

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
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
        <label>
            Nom:
            <input type="text" name="nom" required value="<?= $_POST['nom'] ?? '' ?>">
        </label>

        <label>
            URL de la imatge (opcional):
            <input type="url" name="imatge" placeholder="https://exemple.com/imatge.jpg" value="<?= $_POST['imatge'] ?? '' ?>">
        </label>

        <label>
            Descripció:
            <textarea name="descripcio" rows="4" cols="40"><?= $_POST['descripcio'] ?? '' ?></textarea>
        </label>

        <label>
            Videojoc:
            <select name="videojoc_id" required>
                <?php foreach ($videojocs as $videojoc): ?>
                    <option value="<?= $videojoc['id'] ?>">
                        <?= $videojoc['nom'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <button type="submit">Crear personatge</button>
    </form>
</body>
</html>