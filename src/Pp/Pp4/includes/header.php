<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda Mercadona</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .header-principal {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            background-color: #fff;
            border-bottom: 2px solid #ddd;
        }
        .logo {
            width: 120px;
        }
        .usuario-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .foto-perfil-header {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .contenedor-principal {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }
        .tabla-productos {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .tabla-productos th, 
        .tabla-productos td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .tabla-productos th {
            background-color: #f8f8f8;
        }
        .nombre-producto {
            text-transform: capitalize;
        }
        .producto-agotado {
            background-color: #ffcccc;
            color: #990000;
        }
        .bloque-contacto {
            margin-top: 30px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fbfbfb;
            width: fit-content;
        }
        .foto-contacto {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .footer-principal {
            text-align: center;
            padding: 15px;
            background-color: #fff;
            border-top: 2px solid #ddd;
            margin-top: 30px;
            color: #666;
        }
    </style>
</head>
<body>
    <header class="header-principal">
        <div class="logo-container">
            <img src="https://logos-world.net/wp-content/uploads/2022/04/Mercadona-Symbol.png" alt="" class="logo">
        </div>

        <div class="usuario-container">
            <?php if (isset($nombre) && isset($foto)): ?>
                <h2>¡Bienvenido, <?= $nombre ?>!</h2>
                <img src="<?= $foto ?>" alt="Foto de perfil" class="foto-perfil-header">
            <?php else: ?>
                <h2>Bienvenido a nuestra tienda</h2>
            <?php endif; ?>
        </div>
    </header>