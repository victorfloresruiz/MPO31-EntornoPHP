<?php
include __DIR__ . '/dades.php';

$titolPagina = "Detall de l'encàrrec";
$id = "";
$encarrec = null;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if (is_numeric($id) && array_key_exists($id, $encarrecs)) {
    $encarrec = $encarrecs[$id];
}

include __DIR__ . '/includes/header.php';
?>

<p><a class="enlace-volver" href="index.php">← Tornar al gestor</a></p>

<?php if ($encarrec === null): ?>

    <p class="mensaje mensaje-error">L'encàrrec que busques no existeix o l'id no és vàlid.</p>

<?php else: ?>

    <?php
    $claseInsignia = "insignia-pendiente";

    if ($encarrec["estat"] === "Acabat") {
        $claseInsignia = "insignia-acabado";
    }

    if ($encarrec["estat"] === "En procés") {
        $claseInsignia = "insignia-proceso";
    }

    $etiquetesText = "";

    foreach ($encarrec["etiquetes"] as $posicio => $etiqueta) {
        if ($posicio > 0) {
            $etiquetesText = $etiquetesText . ", ";
        }
        $etiquetesText = $etiquetesText . $etiqueta;
    }
    ?>

    <section class="ficha">
        <div class="ficha-cabecera">
            <div>
                <p class="banner-subtitulo">DETALL DE L'ENCÀRREC #<?= $id ?></p>
                <h1><?= $encarrec["titol"] ?></h1>
                <p>Projecte encarregat per <strong><?= $encarrec["client"] ?></strong></p>
            </div>
            <span class="insignia <?= $claseInsignia ?>"><?= $encarrec["estat"] ?></span>
        </div>
        <div class="ficha-datos">
            <div class="dato">
                <span>Client</span>
                <strong><?= $encarrec["client"] ?></strong>
            </div>
            <div class="dato">
                <span>Hores estimades</span>
                <strong><?= $encarrec["hores"] ?> hores</strong>
            </div>
            <div class="dato">
                <span>Estat</span>
                <strong><?= $encarrec["estat"] ?></strong>
            </div>
            <div class="dato">
                <span>Etiquetes</span>
                <strong><?= $etiquetesText ?></strong>
            </div>
        </div>
    </section>

<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>