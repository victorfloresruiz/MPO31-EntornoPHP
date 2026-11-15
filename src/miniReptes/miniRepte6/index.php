<?php
session_start();
require_once 'funciones.php';

if (empty($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

inicializar_partida();

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['reiniciar'])) {
        reiniciar_partida();
    } else {
        $resultado = procesar_apuesta($_POST);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruleta americana</title>
    <style>
        :root {
            --verde: #0f5132;
            --verde-claro: #198754;
            --dorado: #d4af37;
            --rojo: #c0392b;
            --negro: #1c1c1c;
            --fondo: #0d2b1e;
            --radio: 12px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #222;
            background: radial-gradient(circle at top, var(--verde) 0%, var(--fondo) 70%) fixed;
        }

        .contenedor {
            max-width: 1000px;
            margin: 0 auto;
            padding: 24px 20px 40px;
        }

        .cabecera {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        h1, h2 { margin: 0; }
        h1 { color: var(--dorado); font-size: 2rem; letter-spacing: 1px; }
        h2 { color: var(--verde); font-size: 1.15rem; margin-bottom: 14px; }

        .saldo {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            padding: 10px 18px;
            color: #fff;
            background: rgba(0, 0, 0, 0.35);
            border: 1px solid var(--dorado);
            border-radius: var(--radio);
        }
        .saldo span { font-size: 0.8rem; opacity: 0.8; }
        .saldo strong { font-size: 1.6rem; color: var(--dorado); }

        .tarjeta {
            margin-bottom: 20px;
            padding: 20px;
            background: #fff;
            border-radius: var(--radio);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
        }

        .tapete-caja { overflow-x: auto; }

        .tapete {
            width: 100%;
            min-width: 760px;
            table-layout: fixed;
            border-collapse: separate;
            border-spacing: 3px;
            padding: 6px;
            background: var(--verde);
            border-radius: 10px;
        }
        .tapete td { padding: 0; }

        .casilla {
            text-align: center;
            font-weight: 700;
            color: #fff;
            background: #2f7d55;
            border: 2px solid rgba(255, 255, 255, 0.7);
            border-radius: 6px;
            cursor: pointer;
            user-select: none;
            transition: transform 0.1s, box-shadow 0.1s;
        }
        .casilla:hover { filter: brightness(1.25); }

        .casilla.numero { padding: 4px 0; }
        .casilla.cero { padding: 12px 4px; font-size: 1.3rem; background: #0b8a45; }
        .casilla.fuera, .casilla.lado { padding: 12px 4px; }
        .casilla.lado { font-size: 0.8rem; }

        .rombo {
            display: inline-block;
            width: 64px;
            height: 30px;
            vertical-align: middle;
            clip-path: polygon(50% 0, 100% 50%, 50% 100%, 0 50%);
        }
        .rombo.rojo { background: var(--rojo); }
        .rombo.negro { background: var(--negro); }

        .casilla.elegida {
            position: relative;
            z-index: 1;
            transform: scale(1.07);
            border-color: var(--dorado);
            box-shadow: 0 0 12px var(--dorado);
        }

        .linea {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 10px;
            padding: 10px;
            background: #f3f5f4;
            border-radius: 8px;
        }
        .linea input { width: 120px; }

        .aviso {
            margin: 0 0 12px;
            padding: 10px 14px;
            background: #fff3cd;
            border-radius: 8px;
        }

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
            display: inline-block;
            padding: 11px 18px;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s;
        }
        .btn-principal { color: #fff; background: var(--verde-claro); }
        .btn-principal:hover { background: var(--verde); }
        .btn-secundario { color: var(--verde); background: #e8f1ec; }
        .btn-secundario:hover { background: #d3e5db; }
        .btn-peligro { color: #fff; background: #a83232; }
        .btn-peligro:hover { background: #842626; }

        .form-reinicio { margin-top: 14px; }

        .resultado {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
            padding: 16px 20px;
            color: #fff;
            border-radius: var(--radio);
            border-left: 6px solid;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
        }
        .resultado p { margin: 0; font-size: 1.05rem; }
        .resultado.ganada { background: #146c43; border-color: #7be0a8; }
        .resultado.perdida { background: #7a2530; border-color: #f1949f; }
        .resultado.error { background: #8a6d1d; border-color: #ffe08a; }

        .bola {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            font-weight: 700;
            color: #fff;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.7);
        }
        .bola.grande { width: 64px; height: 64px; font-size: 1.5rem; flex-shrink: 0; }
        .bola.rojo { background: var(--rojo); }
        .bola.negro { background: var(--negro); }
        .bola.verde { background: var(--verde-claro); }

        .historial { display: flex; flex-wrap: wrap; gap: 8px; }

        @media (max-width: 600px) {
            h1 { font-size: 1.5rem; }
            .saldo { align-items: flex-start; width: 100%; }
            .linea { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
<div class="contenedor">

    <header class="cabecera">
        <h1>Ruleta americana</h1>
        <div class="saldo">
            <span>Dinero disponible</span>
            <strong><?= $_SESSION['dinero'] ?> €</strong>
        </div>
    </header>

    <?php if ($resultado != null): ?>
        <section class="resultado <?= $resultado['tipo'] ?>">
            <?php if (isset($resultado['numero'])): ?>
                <span class="bola grande <?= $resultado['color'] ?>"><?= $resultado['numero'] ?></span>
                <p>Ha salido el <strong><?= $resultado['numero'] ?></strong> (<?= $resultado['color'] ?>). <?= $resultado['mensaje'] ?></p>
            <?php else: ?>
                <p><?= $resultado['mensaje'] ?></p>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <section class="tarjeta">
        <h2>Haz clic en las casillas para apostar</h2>

        <div class="tapete-caja">
        <table class="tapete">
            <?php for ($k = 3; $k >= 1; $k--): ?>
                <tr>
                    <?php if ($k == 3): ?>
                        <td class="casilla cero" data-tipo="numero" data-valor="00"
                            data-texto="Número 00 (x<?= MULTIPLICADOR_NUMERO ?>)">00</td>
                    <?php endif; ?>
                    <?php if ($k == 2): ?>
                        <td class="casilla cero" rowspan="2" data-tipo="numero" data-valor="0"
                            data-texto="Número 0 (x<?= MULTIPLICADOR_NUMERO ?>)">0</td>
                    <?php endif; ?>

                    <?php for ($c = 0; $c < 12; $c++): ?>
                        <?php $n = $c * 3 + $k; ?>
                        <td class="casilla numero" data-tipo="numero" data-valor="<?= $n ?>"
                            data-texto="Número <?= $n ?> (x<?= MULTIPLICADOR_NUMERO ?>)"><span class="bola <?= color_numero($n) ?>"><?= $n ?></span></td>
                    <?php endfor; ?>

                    <td class="casilla lado" data-tipo="columna" data-valor="<?= $k ?>"
                        data-texto="Columna <?= $k ?> (x<?= MULTIPLICADOR_COLUMNA ?>)">2 a 1</td>
                </tr>
            <?php endfor; ?>

            <tr>
                <td></td>
                <td class="casilla fuera" colspan="4" data-tipo="docena" data-valor="1"
                    data-texto="Primera docena, del 1 al 12 (x<?= MULTIPLICADOR_DOCENA ?>)">1ª docena</td>
                <td class="casilla fuera" colspan="4" data-tipo="docena" data-valor="2"
                    data-texto="Segunda docena, del 13 al 24 (x<?= MULTIPLICADOR_DOCENA ?>)">2ª docena</td>
                <td class="casilla fuera" colspan="4" data-tipo="docena" data-valor="3"
                    data-texto="Tercera docena, del 25 al 36 (x<?= MULTIPLICADOR_DOCENA ?>)">3ª docena</td>
                <td></td>
            </tr>

            <tr>
                <td></td>
                <td class="casilla fuera" colspan="2" data-tipo="mitad" data-valor="bajo"
                    data-texto="Del 1 al 18 (x<?= MULTIPLICADOR_MITAD ?>)">1 a 18</td>
                <td class="casilla fuera" colspan="2" data-tipo="paridad" data-valor="par"
                    data-texto="Par (x<?= MULTIPLICADOR_PARIDAD ?>)">Par</td>
                <td class="casilla fuera" colspan="2" data-tipo="color" data-valor="rojo"
                    data-texto="Rojo (x<?= MULTIPLICADOR_COLOR ?>)"><span class="rombo rojo"></span></td>
                <td class="casilla fuera" colspan="2" data-tipo="color" data-valor="negro"
                    data-texto="Negro (x<?= MULTIPLICADOR_COLOR ?>)"><span class="rombo negro"></span></td>
                <td class="casilla fuera" colspan="2" data-tipo="paridad" data-valor="impar"
                    data-texto="Impar (x<?= MULTIPLICADOR_PARIDAD ?>)">Impar</td>
                <td class="casilla fuera" colspan="2" data-tipo="mitad" data-valor="alto"
                    data-texto="Del 19 al 36 (x<?= MULTIPLICADOR_MITAD ?>)">19 a 36</td>
                <td></td>
            </tr>
        </table>
        </div>
    </section>

    <?php if (count($_SESSION['historial']) > 0): ?>
        <section class="tarjeta">
            <h2>Últimos números</h2>
            <div class="historial">
                <?php foreach ($_SESSION['historial'] as $n): ?>
                    <span class="bola <?= color_numero($n) ?>"><?= $n ?></span>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="tarjeta">
        <h2>Tus apuestas</h2>

        <form method="post" action="index.php">
            <div id="lista"></div>
            <p id="vacio" class="aviso">Todavía no has elegido ninguna casilla.</p>
            <button type="submit" class="btn btn-principal">Apostar</button>
        </form>

        <form method="post" action="index.php" class="form-reinicio">
            <input type="hidden" name="reiniciar" value="1">
            <button type="submit" class="btn btn-secundario">Reiniciar partida</button>
        </form>
    </section>

    <a href="logout.php" class="btn btn-peligro">Cerrar sesión</a>
</div>

<script>
    const casillas = document.querySelectorAll('.casilla');
    const lista = document.querySelector('#lista');
    const vacio = document.querySelector('#vacio');

    function elegirCasilla() {
        if (this.classList.contains('elegida')) {
            this.classList.remove('elegida');
            lista.removeChild(this.fila);
        } else {
            this.classList.add('elegida');

            const fila = document.createElement('div');
            fila.className = 'linea';
            fila.innerHTML = '<span>' + this.dataset.texto + '</span>'
                + '<input type="hidden" name="tipo[]" value="' + this.dataset.tipo + '">'
                + '<input type="hidden" name="valor[]" value="' + this.dataset.valor + '">'
                + '<input type="number" name="apuesta[]" min="1" placeholder="Cantidad" required>';

            lista.appendChild(fila);
            this.fila = fila;
        }

        if (lista.children.length == 0) {
            vacio.style.display = 'block';
        } else {
            vacio.style.display = 'none';
        }
    }

    for (let i = 0; i < casillas.length; i++) {
        casillas[i].onclick = elegirCasilla;
    }
</script>
</body>
</html>