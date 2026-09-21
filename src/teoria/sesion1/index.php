<?php
    date_default_timezone_set('Europe/Madrid');

    $nombre = "Victor ";
    $apellidos = "Flores Ruiz";
    $edad = 20;
    $curso = "Desarrollo de aplicaciones web";
    $escuela = "FPLlefià";

    function miNombre($nom, $cognoms) {
        echo '<h1>' . $nom . $cognoms . '</h1>';
    }

    function miFecha() {
        echo date("d/m/Y");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    *{
        padding: 0px;
        margin: 0px;
        font-family: Arial, Helvetica, sans-serif;
    }

    header{
        background-color: black;
        padding: 40px;
        gap: 200px;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    header h1{
        color: white;
    }

    main{
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 200px;
        padding: 156px 50px;
    }

    .nombre{
        flex-direction: column;
    }

    .nombre img{
        width: 250px;
        height: 250px;
        border-radius: 50%;
        padding-bottom: 15px;
    }

    .descripcion p{
        max-width: 600px;
        font-size: 20px;
        line-height: 30px;
    }

    footer{
        background-color: black;
        justify-content: center;
        align-items: center;
        display: flex;
        color: white;
        padding-bottom: 100px;
    }

    footer div{
        flex-direction: column;
        display: flex;
        align-items: center;
    }

    footer h1{
        font-size: 20px;
        padding-bottom: 10px;
        padding-top: 20px;
    }
</style>

<body>
    <header>
        <img src="https://www.fpllefia.com/images/logollefia_blanco.png" alt="">
        <h1>Módulo 7 - Práctica 1. Mi primera aplicación en PHP</h1>
    </header>

    <main>
        <div class = "nombre">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTWWZRdPnDNGKs8Y3Ekahkob15yiA2oJHBES7EBEN3f8QFY-nBbnyXFtE&s=10" alt="">
            <?php 
                miNombre($nombre, $apellidos);
            ?>
        </div>

        <div class = "descripcion">
            <?php 
                echo('<p>Hola, me llamo ' . $nombre . 'y tengo ' . $edad . ' años. Actualmente estoy cursando ' . $curso . ' en la escuela ' . $escuela . '. Soy una persona muy sociable y fácil de tratar. En mi tiempo libre disfruto mucho de los deportes, en especial del fútbol, además de ver películas y jugar a los videojuegos con amigos. Me apasiona el mundo de la tecnología, por lo que siempre me mantengo curioso y con ganas de aprender cosas nuevas. Mi objetivo principal es seguir desarrollándome tanto a nivel personal como profesional dentro del ámbito del desarrollo web y afrontar nuevos retos. ')
            ?>
        </div>
    </main>

    <footer>
        <div>
            <?= miNombre($nombre, $apellidos);?>
            <p>La fecha de hoy es: <?php miFecha(); ?></p>
        </div>
    </footer>

    <?php
        phpinfo();
    ?>
    
</body>
</html>