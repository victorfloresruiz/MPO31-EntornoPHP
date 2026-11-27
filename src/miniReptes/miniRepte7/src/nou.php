<?php
require 'includes/db.php';

// De moment tots els anuncis són de l'usuari demo (id 1)
$usuari_id = 1;

// Carreguem les categories per al <select>
$stmt = $pdo->query('SELECT id, nom FROM categories ORDER BY nom');
$categories = $stmt->fetchAll();

$error = '';
$titol = '';
$descripcio = '';
$preu = '';
$categoria_id = '';

// Si s'ha enviat el formulari
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titol = trim($_POST['titol']);
    $descripcio = trim($_POST['descripcio']);
    $preu = $_POST['preu'];
    $categoria_id = $_POST['categoria_id'];

    // Validació
    if ($titol == '' || $descripcio == '' || $preu == '' || $categoria_id == '') {
        $error = 'Tots els camps són obligatoris.';
    } elseif (!is_numeric($preu) || $preu <= 0) {
        $error = 'El preu ha de ser un número positiu.';
    } else {
        // Guardem l'anunci
        $sql = 'INSERT INTO anuncis (titol, descripcio, preu, categoria_id, usuari_id)
                VALUES (?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titol, $descripcio, $preu, $categoria_id, $usuari_id]);

        header('Location: index.php?publicat=1');
        exit;
    }
}

require 'includes/capcalera.php';
?>

<div class="formulari-caixa">
    <h1>Publicar un anunci</h1>
    <p class="subtitol">Tots els camps són obligatoris.</p>

    <?php if ($error != '') { ?>
        <p class="avis avis-error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post" action="nou.php">
        <label for="titol">Títol</label>
        <input type="text" id="titol" name="titol" maxlength="120" required
               value="<?php echo htmlspecialchars($titol); ?>">

        <label for="descripcio">Descripció</label>
        <textarea id="descripcio" name="descripcio" rows="5" maxlength="2000" required><?php echo htmlspecialchars($descripcio); ?></textarea>

        <label for="preu">Preu (€)</label>
        <input type="number" id="preu" name="preu" min="0.01" max="999999.99" step="0.01" required
               value="<?php echo htmlspecialchars($preu); ?>">

        <label for="categoria_id">Categoria</label>
        <select id="categoria_id" name="categoria_id" required>
            <option value="">-- Tria una categoria --</option>
            <?php foreach ($categories as $categoria) { ?>
                <option value="<?php echo $categoria['id']; ?>"
                    <?php if ($categoria['id'] == $categoria_id) { echo 'selected'; } ?>>
                    <?php echo htmlspecialchars($categoria['nom']); ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit" class="boto">Publicar</button>
    </form>
</div>

<?php require 'includes/peu.php'; ?>