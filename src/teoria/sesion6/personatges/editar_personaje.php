<?php
require_once('config.php');

$pdo = db();
$error = '';

// 1. Comprobar que recibimos un ID válido por la URL
$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    header('Location: index.php');
    exit;
}

// 2. Procesar el formulario cuando se envía (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $descripcio = trim($_POST['descripcio'] ?? '');
    $videojocId = $_POST['videojoc_id'] ?? '';

    if ($nom === '' || $videojocId === '') {
        $error = 'El nom i el videojoc són obligatoris.';
    } else {
        $sql = '
            UPDATE personatges
            SET nom = :nom,
                descripcio = :descripcio,
                videojoc_id = :videojoc_id
            WHERE id = :id
        ';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nom'         => $nom,
            'descripcio'  => $descripcio,
            'videojoc_id' => $videojocId,
            'id'          => $id
        ]);

        header('Location: index.php');
        exit;
    }
}

// 3. Obtener los datos actuales del personaje
$stmt = $pdo->prepare('SELECT * FROM personatges WHERE id = :id');
$stmt->execute(['id' => $id]);
$personatge = $stmt->fetch();

if (!$personatge) {
    header('Location: index.php');
    exit;
}

// 4. Obtener los videojuegos para el <select>
$stmt = $pdo->query('SELECT id, nom FROM videojocs ORDER BY nom');
$videojocs = $stmt->fetchAll();

// Si hubo error al enviar, mantenemos lo que escribió el usuario; si no, usamos los datos de la BD
$nomActual = $_POST['nom'] ?? $personatge['nom'];
$descripcioActual = $_POST['descripcio'] ?? $personatge['descripcio'];
$videojocActual = $_POST['videojoc_id'] ?? $personatge['videojoc_id'];
?>
<!doctype html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Editar personatge</title>
</head>
<body>
    <h1>Editar personatge</h1>
    <p><a href="index.php">&larr; Tornar al llistat</a></p>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>
            Nom:<br>
            <input type="text" name="nom" required value="<?= htmlspecialchars($nomActual) ?>">
        </label>
        <br><br>

        <label>
            Descripció:<br>
            <textarea name="descripcio" rows="4" cols="40"><?= htmlspecialchars($descripcioActual) ?></textarea>
        </label>
        <br><br>

        <label>
            Videojoc:<br>
            <select name="videojoc_id" required>
                <?php foreach ($videojocs as $videojoc): ?>
                    <option value="<?= $videojoc['id'] ?>" <?= ($videojoc['id'] == $videojocActual) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($videojoc['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <br><br>

        <button type="submit">Desar canvis</button>
    </form>
</body>
</html>