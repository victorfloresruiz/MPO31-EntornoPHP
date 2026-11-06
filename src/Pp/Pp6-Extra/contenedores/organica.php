<?php
session_start();
include "../funciones.php";

tirar($basuras, "organica");

header("Location: ../index.php");
exit;