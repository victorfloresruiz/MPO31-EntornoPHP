<?php
session_start();

$usuarios = [
    ["username" => "admin", "password" => "adminpass", "role" => "admin"],
    ["username" => "reader", "password" => "readerpass", "role" => "lector"]
];

$error = "";

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["foto"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $foto = $_POST["foto"];

    $encontrado = false;

    foreach ($usuarios as $usuario) {
        if ($usuario["username"] == $username && $usuario["password"] == $password) {
            $encontrado = true;
            $_SESSION["username"] = $usuario["username"];
            $_SESSION["role"] = $usuario["role"];
            $_SESSION["photo"] = $foto;
        }
    }

    if ($encontrado) {
        header("Location: home.php");
        exit; 
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual - Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <section>
        <?php for ($i = 0; $i < 180; $i++) { ?>
            <span></span>
        <?php } ?>

        <div class="signin">
            <div class="content">
                <h2>Inicia sesión</h2>

                <form class="form" method="POST" action="login.php">
                    <div class="inputBox">
                        <input type="text" name="username" required>
                        <i>Usuario</i>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="password" required>
                        <i>Contraseña</i>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="foto" required>
                        <i>URL de la foto de perfil</i>
                    </div>

                    <?php if ($error != "") { ?>
                        <p><?php echo $error; ?></p>
                    <?php } ?>

                    <div class="inputBox">
                        <input type="submit" value="Iniciar">
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>