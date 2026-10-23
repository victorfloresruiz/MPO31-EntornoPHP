<?php

session_start();

if(!isset($_SESSION['nombreuser'])){
    header('Location: login.php');
    exit;
}

$_SESSION['alumnes'] = ['Joan', 'Miguel', 'David', 'Pedro'];

?>

<p>Hola <?= $_SESSION['nombreuser']; ?></p>

<pre>
    <?= var_dump($_SESSION['alumnes']); ?>
</pre>

<?php

array_push($_SESSION['alumnes'], 'Jonathan');

?>

<pre>
    <?= var_dump($_SESSION['alumnes']); ?>
</pre>