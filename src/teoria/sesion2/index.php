<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    
</body>
</html>

<?php

    #condicional simple if else

    $edat = 24;
    if ($edat >= 18){
        echo("Ets major d'edat");
    }else{
        echo("Ets menor");
    }

    $asignatures = 10;
    if($asignatures <= 10){
        echo("Suspendes");
    }else{
        echo("Apruebas");
    }

?>

    <!--sintaxis alternativa-->

    <?php if($edat >= 18):?>
        <p>Eres mayor de edad</p>
        <?php else:?>
            <p>Eres menor de edad</p>
            <?php endif;?>

    <?php $numero = 1?>

    <?php if($numero % 2 == 0):?>
        <p>Es par</p>
        <?php else:?>
            <p>Es inpar</p>
            <?php endif;?>

<?php    
    if($numero == 0){
        echo("Es cero");
    }else if($numero % 2 != 0){
        echo("Es inpar");
    }else{
        echo("Es par");
    }
?>

<!--for-->

<?php for($i = 50; $i <= 500; $i = $i+2):?>
    <div>Caixa <?= $i ?></div>
    <?php endfor; ?>

<!--for each-->

<?php $lista = [1,2,3,4];?>

<?php foreach($lista as $elemento){
    echo($elemento);
}?>
    