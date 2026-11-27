<?php
require_once('config.php');

$pdo = db();
$error = '';

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $descripcio = trim($_POST['descripcio'] ?? '');
    $videojocId = $_POST['videojoc_id'] ?? '';
    $imatge = trim($_POST['imatge'] ?? '');

    if ($nom === '' || $videojocId === '') {
        $error = 'El nom i el videojoc són obligatoris.';
    } else {
        $sql = '
            UPDATE personatges
            SET nom = :nom,
                descripcio = :descripcio,
                videojoc_id = :videojoc_id,
                imatge = :imatge
            WHERE id = :id
        ';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nom'         => $nom,
            'descripcio'  => $descripcio,
            'videojoc_id' => $videojocId,
            'imatge'      => $imatge !== '' ? $imatge : null,
            'id'          => $id
        ]);

        header('Location: index.php');
        exit;
    }
}

$stmt = $pdo->prepare('SELECT * FROM personatges WHERE id = :id');
$stmt->execute(['id' => $id]);
$personatge = $stmt->fetch();

if (!$personatge) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->query('SELECT id, nom FROM videojocs ORDER BY nom');
$videojocs = $stmt->fetchAll();

$nomActual = $_POST['nom'] ?? $personatge['nom'];
$descripcioActual = $_POST['descripcio'] ?? $personatge['descripcio'];
$videojocActual = $_POST['videojoc_id'] ?? $personatge['videojoc_id'];
$imatgeActual = $_POST['imatge'] ?? $personatge['imatge'];
?>
<!doctype html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Editar personatge</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar personatge</h1>
    <p><a href="index.php">&larr; Tornar al llistat</a></p>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
        <label>
            Nom:
            <input type="text" name="nom" required value="<?= $nomActual ?>">
        </label>

        <label>
            URL de la imatge (opcional):
            <input type="url" name="imatge" placeholder="https://exemple.com/imatge.jpg" value="<?= $imatgeActual ?>">
        </label>

        <label>
            Descripció:
            <textarea name="descripcio" rows="4" cols="40"><?= $descripcioActual ?></textarea>
        </label>

        <label>
            Videojoc:
            <select name="videojoc_id" required>
                <?php foreach ($videojocs as $videojoc): ?>
                    <option value="<?= $videojoc['id'] ?>" <?= ($videojoc['id'] == $videojocActual) ? 'selected' : '' ?>>
                        <?= $videojoc['nom'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <button type="submit">Desar canvis</button>
    </form>
</body>
</html>