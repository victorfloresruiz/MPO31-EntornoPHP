<?php
session_start();
require_once 'funciones.php';

if (empty($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

inicializar_partida();

// Patrón Post/Redirect/Get: evita que al recargar se repita la apuesta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['accion'] ?? '') === 'reiniciar') {
        reiniciar_partida();
    } else {
        $_SESSION['resultado'] = procesar_apuesta($_POST);
    }
    header('Location: index.php');
    exit;
}

$resultado = $_SESSION['resultado'] ?? null;
unset($_SESSION['resultado']);

// Datos de cada número (color, columna, fila...) para pintar el tapete
$numeros = obtener_numeros();

// Las 3 filas de números del tapete, de arriba a abajo.
// Cada una es una columna de la ruleta: la de arriba es la 3 (3-6-9...), la del medio la 2 y la de abajo la 1
$filas_tapete = [3, 2, 1];

// Caballos que van pegados al 0 y al 00 (según la fila del tapete en la que estén)
$caballos_cero = [0 => '00-3', 2 => '0-2', 4 => '0-1'];
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
            max-width: 1100px;
            margin: 0 auto;
            padding: 24px 20px 40px;
        }

        /* Cabecera y saldo */
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

        /* Tarjetas */
        .tarjeta {
            margin-bottom: 20px;
            padding: 20px;
            background: #fff;
            border-radius: var(--radio);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
        }

        /* Tapete (la tabla donde se hace clic para apostar) */
        /* La caja deja hacer scroll hacia los lados en el móvil */
        .tapete-caja { overflow-x: auto; }

        .tapete {
            width: 100%;
            min-width: 880px;
            table-layout: fixed;
            border-collapse: separate;
            border-spacing: 3px;
            padding: 6px;
            background: var(--verde);
            border-radius: 10px;
        }
        .tapete td { padding: 0; }

        /* Anchos de las columnas especiales (las de los números se reparten el resto) */
        .tapete col.col-cero { width: 60px; }
        .tapete col.col-fina { width: 6px; }
        .tapete col.col-lado { width: 56px; }

        /* Las filas finas (entre números y debajo) */
        .fila-fina td { height: 6px; }

        .casilla {
            text-align: center;
            font-weight: 700;
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.7);
            border-radius: 6px;
            cursor: pointer;
            user-select: none;
            transition: transform 0.1s, box-shadow 0.1s;
        }
        .casilla:hover { filter: brightness(1.25); }

        /* Casillas con número (con su bola de color dentro) */
        .casilla.numero {
            padding: 4px 0;
            background: #2f7d55;
        }

        /* El 0 y el 00 */
        .casilla.cero {
            padding: 12px 4px;
            font-size: 1.3rem;
            background: #0b8a45;
        }

        /* Las casillas grandes de abajo y el "2 a 1" */
        .casilla.fuera,
        .casilla.lado {
            padding: 12px 4px;
            background: #2f7d55;
        }
        .casilla.fuera { font-size: 1rem; }
        .casilla.lado { font-size: 0.8rem; }

        /* Casillas finas y vacías (caballos y filas) */
        .casilla.fina {
            background: rgba(255, 255, 255, 0.12);
            border: 1px dashed rgba(255, 255, 255, 0.45);
            border-radius: 4px;
        }
        .casilla.fina:hover {
            background: rgba(212, 175, 55, 0.6);
            filter: none;
        }

        /* Rombos rojo y negro de la fila de abajo */
        .rombo {
            display: inline-block;
            width: 64px;
            height: 30px;
            vertical-align: middle;
            clip-path: polygon(50% 0, 100% 50%, 50% 100%, 0 50%);
        }
        .rombo.rojo { background: var(--rojo); }
        .rombo.negro { background: var(--negro); }

        /* Casilla elegida */
        .casilla.elegida {
            position: relative;
            z-index: 1;
            transform: scale(1.07);
            border-color: var(--dorado);
            box-shadow: 0 0 12px var(--dorado);
        }
        .casilla.fina.elegida {
            transform: none;
            background: var(--dorado);
        }

        /* Formularios */
        .form-apuesta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            align-items: end;
        }

        .campo { display: flex; flex-direction: column; gap: 6px; }
        .campo label { font-size: 0.85rem; font-weight: 600; color: #444; }

        .seleccion {
            padding: 10px;
            background: #f3f5f4;
            border-radius: 8px;
            min-height: 42px;
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

        /* Botones */
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
            transition: background 0.15s, transform 0.05s;
        }
        .btn:active { transform: translateY(1px); }

        .btn-principal { color: #fff; background: var(--verde-claro); }
        .btn-principal:hover { background: var(--verde); }

        .btn-secundario { color: var(--verde); background: #e8f1ec; }
        .btn-secundario:hover { background: #d3e5db; }

        .btn-peligro { color: #fff; background: #a83232; }
        .btn-peligro:hover { background: #842626; }

        .form-reinicio { margin-top: 14px; }

        /* Resultado de la tirada */
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

        /* Bolas de la ruleta */
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

        /* Avisos */
        .aviso {
            margin: 0 0 12px;
            padding: 10px 14px;
            background: #fff3cd;
            border-radius: 8px;
        }

        /* Móvil */
        @media (max-width: 600px) {
            h1 { font-size: 1.5rem; }
            .saldo { align-items: flex-start; width: 100%; }
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

    <?php if ($resultado): ?>
        <section class="resultado <?= $resultado['tipo'] ?>">
            <?php if (isset($resultado['numero'])): ?>
                <span class="bola grande <?= $resultado['color'] ?>"><?= $resultado['numero'] ?></span>
            <?php endif; ?>
            <p>
                <?php if (isset($resultado['numero'])): ?>
                    Ha salido el <strong><?= $resultado['numero'] ?></strong> (<?= $resultado['color'] ?>).
                <?php endif; ?>
                <?= $resultado['mensaje'] ?>
            </p>
        </section>
    <?php endif; ?>

    <section class="tarjeta">
        <h2>Haz clic en una casilla para apostar</h2>

        <div class="tapete-caja">
        <table class="tapete">
            <!-- Anchos de las columnas: cero | fina | (número | fina) x12 | lado -->
            <colgroup>
                <col class="col-cero">
                <col class="col-fina">
                <?php for ($c = 1; $c <= 12; $c++): ?>
                    <col>
                    <?php if ($c < 12): ?>
                        <col class="col-fina">
                    <?php endif; ?>
                <?php endfor; ?>
                <col class="col-lado">
            </colgroup>

            <!-- Las 3 filas de números, con una fila fina entre cada una (son 5 filas en total) -->
            <?php for ($r = 0; $r < 5; $r++): ?>

                <?php if ($r % 2 == 0): ?>
                    <!-- FILA CON NÚMEROS -->
                    <?php $k = $filas_tapete[intdiv($r, 2)]; ?>
                    <tr>
                        <?php if ($r == 0): ?>
                            <td id="n00" class="casilla cero"
                                data-tipo="numero" data-valor="00"
                                data-texto="Número 00 (x<?= MULTIPLICADOR_NUMERO ?>)">00</td>
                        <?php elseif ($r == 2): ?>
                            <!-- El 0 ocupa las 3 últimas filas (la del medio, la fina y la de abajo) -->
                            <td id="n0" class="casilla cero" rowspan="3"
                                data-tipo="numero" data-valor="0"
                                data-texto="Número 0 (x<?= MULTIPLICADOR_NUMERO ?>)">0</td>
                        <?php endif; ?>

                        <!-- Caballo entre el 0 / 00 y el primer número -->
                        <?= celda_caballo($caballos_cero[$r]) ?>

                        <?php for ($c = 1; $c <= 12; $c++): ?>
                            <?php $n = ($c - 1) * 3 + $k; ?>
                            <td id="n<?= $n ?>" class="casilla numero"
                                data-tipo="numero" data-valor="<?= $n ?>"
                                data-texto="Número <?= $n ?> (x<?= MULTIPLICADOR_NUMERO ?>)"><span class="bola <?= $numeros[$n]['color'] ?>"><?= $n ?></span></td>

                            <?php if ($c < 12): ?>
                                <!-- Caballo con el número de la derecha -->
                                <?= celda_caballo($n . '-' . ($n + 3)) ?>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <td id="columna<?= $k ?>" class="casilla lado"
                            data-tipo="columna" data-valor="<?= $k ?>"
                            data-texto="Columna <?= $k ?> (x<?= MULTIPLICADOR_COLUMNA ?>)">2 a 1</td>
                    </tr>

                <?php else: ?>
                    <!-- FILA FINA: caballos con el número de arriba / abajo -->
                    <?php
                    $k_arriba = $filas_tapete[intdiv($r, 2)];
                    $k_abajo = $filas_tapete[intdiv($r, 2) + 1];
                    ?>
                    <tr class="fila-fina">
                        <?php if ($r == 1): ?>
                            <!-- Caballo entre el 00 y el 0 -->
                            <?= celda_caballo('0-00') ?>
                        <?php endif; ?>

                        <td></td>

                        <?php for ($c = 1; $c <= 12; $c++): ?>
                            <?php
                            $n_abajo = ($c - 1) * 3 + $k_abajo;
                            $n_arriba = ($c - 1) * 3 + $k_arriba;
                            ?>
                            <?= celda_caballo($n_abajo . '-' . $n_arriba) ?>

                            <?php if ($c < 12): ?>
                                <!-- Esquina entre 4 números: cuadro (n, n+1, n+3, n+4) -->
                                <?= celda_cuadro($n_abajo . '-' . ($n_abajo + 1) . '-' . ($n_abajo + 3) . '-' . ($n_abajo + 4)) ?>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <td></td>
                    </tr>
                <?php endif; ?>

            <?php endfor; ?>

            <!-- Fila fina de abajo: apuesta a la fila de 3 números en vertical -->
            <tr class="fila-fina">
                <td colspan="2"></td>
                <?php for ($c = 1; $c <= 12; $c++): ?>
                    <?php $primero = ($c - 1) * 3 + 1; ?>
                    <td id="fila<?= $c ?>" class="casilla fina"
                        data-tipo="fila" data-valor="<?= $c ?>"
                        data-texto="Fila <?= $c ?>: <?= $primero ?>-<?= $primero + 1 ?>-<?= $primero + 2 ?> (x<?= MULTIPLICADOR_FILA ?>)"></td>
                    <?php if ($c < 12): ?>
                        <td></td>
                    <?php endif; ?>
                <?php endfor; ?>
                <td></td>
            </tr>

            <!-- Docenas -->
            <tr>
                <td colspan="2"></td>
                <td id="docena1" class="casilla fuera" colspan="8"
                    data-tipo="docena" data-valor="1"
                    data-texto="Primera docena, del 1 al 12 (x<?= MULTIPLICADOR_DOCENA ?>)">1ª docena</td>
                <td id="docena2" class="casilla fuera" colspan="8"
                    data-tipo="docena" data-valor="2"
                    data-texto="Segunda docena, del 13 al 24 (x<?= MULTIPLICADOR_DOCENA ?>)">2ª docena</td>
                <td id="docena3" class="casilla fuera" colspan="7"
                    data-tipo="docena" data-valor="3"
                    data-texto="Tercera docena, del 25 al 36 (x<?= MULTIPLICADOR_DOCENA ?>)">3ª docena</td>
                <td></td>
            </tr>

            <!-- 1-18, par, rojo, negro, impar, 19-36 -->
            <tr>
                <td colspan="2"></td>
                <td id="bajo" class="casilla fuera" colspan="4"
                    data-tipo="mitad" data-valor="bajo"
                    data-texto="Del 1 al 18 (x<?= MULTIPLICADOR_MITAD ?>)">1 a 18</td>
                <td id="par" class="casilla fuera" colspan="4"
                    data-tipo="paridad" data-valor="par"
                    data-texto="Par (x<?= MULTIPLICADOR_PARIDAD ?>)">Par</td>
                <td id="rojo" class="casilla fuera" colspan="4"
                    data-tipo="color" data-valor="rojo"
                    data-texto="Rojo (x<?= MULTIPLICADOR_COLOR ?>)"><span class="rombo rojo"></span></td>
                <td id="negro" class="casilla fuera" colspan="4"
                    data-tipo="color" data-valor="negro"
                    data-texto="Negro (x<?= MULTIPLICADOR_COLOR ?>)"><span class="rombo negro"></span></td>
                <td id="impar" class="casilla fuera" colspan="4"
                    data-tipo="paridad" data-valor="impar"
                    data-texto="Impar (x<?= MULTIPLICADOR_PARIDAD ?>)">Impar</td>
                <td id="alto" class="casilla fuera" colspan="3"
                    data-tipo="mitad" data-valor="alto"
                    data-texto="Del 19 al 36 (x<?= MULTIPLICADOR_MITAD ?>)">19 a 36</td>
                <td></td>
            </tr>
        </table>
        </div>
    </section>

    <?php if (!empty($_SESSION['historial'])): ?>
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
        <h2>Tu apuesta</h2>

        <?php if ($_SESSION['dinero'] > 0): ?>
            <form method="post" action="index.php" id="formulario" class="form-apuesta">
                <!-- Estos dos campos los rellena el JS al hacer clic en una casilla -->
                <input type="hidden" id="tipo" name="tipo">
                <input type="hidden" id="valor" name="valor">

                <div class="campo">
                    <label>Casilla elegida</label>
                    <div class="seleccion" id="seleccion">Todavía no has elegido ninguna.</div>
                </div>

                <div class="campo">
                    <label for="apuesta">Cantidad</label>
                    <input type="number" id="apuesta" name="apuesta" min="1"
                           max="<?= $_SESSION['dinero'] ?>" required>
                </div>

                <button type="submit" class="btn btn-principal">Apostar</button>
            </form>
        <?php else: ?>
            <p class="aviso">Te has quedado sin dinero.</p>
        <?php endif; ?>

        <form method="post" action="index.php" class="form-reinicio">
            <input type="hidden" name="accion" value="reiniciar">
            <button type="submit" class="btn btn-secundario">Reiniciar partida</button>
        </form>
    </section>

    <a href="logout.php" class="btn btn-peligro">Cerrar sesión</a>
</div>

<script>
    // Todas las casillas donde se puede hacer clic (números, caballos, docenas...)
    const casillas = document.querySelectorAll('.casilla');
    const formulario = document.querySelector('#formulario');
    const tipo = document.querySelector('#tipo');
    const valor = document.querySelector('#valor');
    const seleccion = document.querySelector('#seleccion');

    // Aquí se guarda la casilla que está elegida ahora mismo
    let elegida = null;

    // Se ejecuta al hacer clic en cualquier casilla del tapete
    function elegirCasilla() {
        // Si no hay formulario (te quedas sin dinero) no hace nada
        if (formulario == null) {
            return;
        }

        // Quitamos la marca a la casilla anterior
        if (elegida != null) {
            elegida.classList.remove('elegida');
        }

        // Marcamos la nueva
        elegida = this;
        elegida.classList.add('elegida');

        // Rellenamos el formulario con lo que has elegido
        tipo.value = this.dataset.tipo;
        valor.value = this.dataset.valor;
        seleccion.innerHTML = '<strong>' + this.dataset.texto + '</strong>';
    }

    // Le ponemos el clic a todas las casillas
    for (let i = 0; i < casillas.length; i++) {
        casillas[i].onclick = elegirCasilla;
    }

    // Antes de enviar, comprobamos que has elegido una casilla
    if (formulario != null) {
        formulario.onsubmit = function () {
            if (tipo.value == '') {
                alert('Elige primero una casilla del tapete.');
                return false;
            }
        };
    }
</script>
</body>
</html>