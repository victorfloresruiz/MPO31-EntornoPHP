<?php
session_start();

if (!empty($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'password') {
        session_regenerate_id(true);
        $_SESSION['usuario'] = $username;
        header('Location: index.php');
        exit;
    }
    $error = 'Nombre de usuario o contraseña inválidos.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <style>
        :root {
            --verde: #0f5132;
            --verde-claro: #198754;
            --fondo: #0d2b1e;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #222;
            background: radial-gradient(circle at top, var(--verde) 0%, var(--fondo) 70%) fixed;
        }

        .tarjeta {
            width: 100%;
            max-width: 340px;
            padding: 24px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
        }

        h1 {
            margin: 0;
            text-align: center;
            font-size: 1.6rem;
            color: var(--verde);
        }

        .subtitulo {
            margin: 6px 0 18px;
            text-align: center;
            color: #666;
        }

        .campo {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 14px;
        }
        .campo label { font-size: 0.85rem; font-weight: 600; color: #444; }

        input {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #bbb;
            border-radius: 8px;
            background: #fafafa;
        }
        input:focus {
            outline: none;
            border-color: var(--verde-claro);
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.25);
        }

        .btn {
            width: 100%;
            margin-top: 6px;
            padding: 11px 18px;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            background: var(--verde-claro);
            border: 0;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s;
        }
        .btn:hover { background: var(--verde); }

        .aviso {
            margin: 0 0 14px;
            padding: 10px 14px;
            color: #842029;
            background: #f8d7da;
            border-radius: 8px;
        }
    </style>
</head>
<body class="pagina-login">
    <form method="post" class="tarjeta login">
        <h1>Ruleta americana</h1>
        <p class="subtitulo">Inicia sesión para jugar</p>

        <?php if ($error): ?>
            <p class="aviso error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <div class="campo">
            <label for="username">Usuario</label>
            <input type="text" id="username" name="username" required autofocus>
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-principal">Entrar</button>
    </form>
</body>
</html>