<?php
$temp = 40;

echo($temp);
echo "<h2>Hola daw 2 estamos a $temp grados</h2>";

if(isset($_POST("Nombre")))
    echo "<p>hola " . $_POST["Nombre"] . "</p>"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method = "post">
        <input type="text" name="nombre">
        <button>Enviar</button>
    </form>
</body>
</html>