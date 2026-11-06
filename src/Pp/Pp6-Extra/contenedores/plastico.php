<?php
session_start();
include "../funciones.php";

tirar($basuras, "plastico");

header("Location: ../index.php");
exit;