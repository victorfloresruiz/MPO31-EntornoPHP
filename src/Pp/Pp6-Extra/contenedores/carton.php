<?php
session_start();
include "../funciones.php";

tirar($basuras, "carton");

header("Location: ../index.php");
exit;