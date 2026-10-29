<?php
include __DIR__ . '/dades.php';

$titolPagina = "Gestor d'encàrrecs";
$missatge = "";
$esError = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accio = $_POST["accio"];

    if ($accio === "afegir") {
        $titol = $_POST["titol"];
        $client = $_POST["client"];
        $hores = $_POST["hores"];
        $estat = $_POST["estat"];
        $etiquetes = $_POST["etiquetes"];

        if ($titol === "" || $client === "" || $hores === "" || $etiquetes === "") {
            $missatge = "Has d'omplir tots els camps.";
            $esError = true;
        } elseif ($hores <= 0) {
            $missatge = "Les hores han de ser més grans que 0.";
            $esError = true;
        } else {
            $encarrecs[] = [
                "titol" => $titol,
                "client" => $client,
                "hores" => $hores,
                "estat" => $estat,
                "etiquetes" => [$etiquetes]
            ];

            $missatge = "L'encàrrec s'ha afegit correctament. Recorda que només existirà durant aquesta resposta.";
        }
    }

    if ($accio === "eliminar") {
        $idEliminar = $_POST["id"];
        $llistaNova = [];

        foreach ($encarrecs as $numero => $encarrec) {
            if ($numero != $idEliminar) {
                $llistaNova[] = $encarrec;
            }
        }

        $encarrecs = $llistaNova;
        $missatge = "L'encàrrec s'ha eliminat correctament.";
    }
}

$totalEncarrecs = count($encarrecs);
$sumaHores = 0;

foreach ($encarrecs as $encarrec) {
    $sumaHores = $sumaHores + $encarrec["hores"];
}

include __DIR__ . '/includes/header.php';
?>

<section class="banner">
    <div>
        <p class="banner-subtitulo">AGÈNCIA WEB · TAULER DE PROJECTES</p>
        <h1>Gestor d'encàrrecs</h1>
        <p>Consulta la feina de l'equip, revisa les hores previstes i registra encàrrecs nous.</p>
    </div>
    <a class="boton boton-naranja" href="#formulari">+ Nou encàrrec</a>
</section>

<?php if ($missatge !== ""): ?>
    <?php if ($esError): ?>
        <p class="mensaje mensaje-error"><?= $missatge ?></p>
    <?php else: ?>
        <p class="mensaje mensaje-bien"><?= $missatge ?></p>
    <?php endif; ?>
<?php endif; ?>

<section class="datos-resumen">
    <div class="cuadro">
        <span>Total d'encàrrecs</span>
        <strong><?= $totalEncarrecs ?></strong>
    </div>
    <div class="cuadro">
        <span>Hores estimades</span>
        <strong><?= $sumaHores ?> h</strong>
    </div>
</section>

<h2>Llistat d'encàrrecs</h2>

<section class="lista-encargos">
    <?php foreach ($encarrecs as $numero => $encarrec): ?>
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
        <article class="encargo">
            <div class="encargo-cabecera">
                <span class="insignia <?= $claseInsignia ?>"><?= $encarrec["estat"] ?></span>
                <span class="horas"><?= $encarrec["hores"] ?> h</span>
            </div>
            <h3><?= $encarrec["titol"] ?></h3>
            <p>Client: <strong><?= $encarrec["client"] ?></strong></p>
            <p class="encargo-etiquetas"><?= $etiquetesText ?></p>
            <div class="encargo-botones">
                <a class="boton boton-azul" href="detall.php?id=<?= $numero ?>">Veure detall</a>
                <form method="post" action="index.php">
                    <input type="hidden" name="accio" value="eliminar">
                    <input type="hidden" name="id" value="<?= $numero ?>">
                    <button class="boton boton-rojo" type="submit">Eliminar</button>
                </form>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<section class="caja-formulario" id="formulari">
    <h2>Afegir un encàrrec</h2>
    <p>Emplena totes les dades.</p>
    <p>Les dades no es desen entre peticions, tal com demana el repte.</p>

    <form method="post" action="index.php">
        <input type="hidden" name="accio" value="afegir">

        <label for="titol">Títol</label>
        <input type="text" id="titol" name="titol" placeholder="Ex.: Redisseny d'una botiga">

        <label for="client">Client</label>
        <input type="text" id="client" name="client" placeholder="Nom del client">

        <label for="hores">Hores estimades</label>
        <input type="number" id="hores" name="hores">

        <label for="etiquetes">Etiquetes</label>
        <input type="text" id="etiquetes" name="etiquetes" placeholder="PHP, Docker, Responsive">

        <label for="estat">Estat</label>
        <select id="estat" name="estat">
            <option value="Pendent">Pendent</option>
            <option value="En procés">En procés</option>
            <option value="Acabat">Acabat</option>
        </select>

        <button class="boton boton-naranja boton-ancho" type="submit">Afegir encàrrec</button>
    </form>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>