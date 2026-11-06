<?php
session_start();
include "../funciones.php";

tirar($basuras, "vidrio");

header("Location: ../index.php");
exit;