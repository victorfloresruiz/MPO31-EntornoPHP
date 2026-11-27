<?php
require 'includes/db.php';

// Consulta amb JOIN per tenir el nom de la categoria i del propietari
$sql = 'SELECT anuncis.titol, anuncis.descripcio, anuncis.preu,
               categories.nom AS categoria,
               usuaris.nom AS propietari
        FROM anuncis
        JOIN categories ON anuncis.categoria_id = categories.id
        JOIN usuaris ON anuncis.usuari_id = usuaris.id
        ORDER BY anuncis.id DESC';

$stmt = $pdo->query($sql);
$anuncis = $stmt->fetchAll();

require 'includes/header.php';
?>

<?php if (isset($_GET['publicat'])) { ?>
    <p class="avis avis-ok">L'anunci s'ha publicat correctament.</p>
<?php } ?>

<h1>Productes de segona mà</h1>
<p class="subtitol">Anuncis disponibles: <?php echo count($anuncis); ?></p>

<?php if (count($anuncis) == 0) { ?>
    <p class="buit">Encara no hi ha cap anunci.</p>
<?php } ?>

<section class="graella">
    <?php foreach ($anuncis as $anunci) { ?>
        <article class="targeta">
            <div class="targeta-imatge">Sense fotografia</div>
            <div class="targeta-cos">
                <span class="categoria"><?php echo htmlspecialchars($anunci['categoria']); ?></span>
                <h2><?php echo htmlspecialchars($anunci['titol']); ?></h2>
                <p class="preu"><?php echo $anunci['preu']; ?> €</p>
                <p class="descripcio"><?php echo htmlspecialchars($anunci['descripcio']); ?></p>
                <p class="propietari">Publicat per <?php echo htmlspecialchars($anunci['propietari']); ?></p>
            </div>
        </article>
    <?php } ?>
</section>

<?php require 'includes/footer.php'; ?>