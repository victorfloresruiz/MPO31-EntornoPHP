<?php
require_once('config.php');

$pdo = db();

// ----------------------------------------------------
// PROCESSAR EL FORMULARI
// ----------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $videojocId = $_POST['videojoc_id'];

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

    echo '<p>Personatge creat correctament!</p>';
}

// ----------------------------------------------------
// OBTENIR VIDEOJOCS PER AL SELECT
// ----------------------------------------------------
$sql = 'SELECT id, nom FROM videojocs ORDER BY nom';
$stmt = $pdo->query($sql);
$videojocs = $stmt->fetchAll();
?>

<h1>Crear personatge</h1>

<form method="post">
    <label>
        Nom:
        <input type="text" name="nom">
    </label>
    <br><br>

    <label>
        Descripció:
        <textarea name="descripcio"></textarea>
    </label>
    <br><br>

    <label>
        Videojoc:
        <select name="videojoc_id">
            <?php foreach ($videojocs as $videojoc): ?>
                <option value="<?= $videojoc['id'] ?>">
                    <?= $videojoc['nom'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <br><br>

    <button type="submit">
        Crear personatge
    </button>
</form>