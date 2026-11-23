<?php
require('config.php');

try {
    $pdo = db();
    echo 'todo bien';
} catch (PDOException $e) {
    die('ERROR DE CONEXIÓ AMB LA BASE DE DADES: ' . $e->getMessage());
}

$sql = "SELECT * FROM videojocs";
$stmt = $pdo->query($sql);

// fetchAll convierte el resultado en un array
$videojocs = $stmt->fetchAll();
?>

<pre>
<?php var_dump($stmt); ?>
</pre>

<pre>
<?php var_dump($videojocs); ?>
</pre>

<?php
foreach ($videojocs as $video) {
    echo $video['nom'] . ' - ' . $video['genere'] . '<br>';
}
?>
