<?php

session_start();

echo "Hola sesion";

$_SESSION['edat'] = 19;

echo $_SESSION['edat'];

echo $_SESSION['name'];

?>