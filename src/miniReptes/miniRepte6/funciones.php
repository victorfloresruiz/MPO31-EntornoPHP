<?php

define('DINERO_INICIAL', 1000);

define('MULTIPLICADOR_NUMERO', 36);
define('MULTIPLICADOR_COLOR', 2);
define('MULTIPLICADOR_PARIDAD', 2);
define('MULTIPLICADOR_MITAD', 2);
define('MULTIPLICADOR_COLUMNA', 3);
define('MULTIPLICADOR_DOCENA', 3);

function girar_ruleta()
{
    $lista = ['0', '00', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12',
              '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24',
              '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36'];

    $posicion = rand(0, 37);
    return $lista[$posicion];
}

function color_numero($numero)
{
    $rojos = [1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36];

    if ($numero == 0) {
        return 'verde';
    }
    if (in_array($numero, $rojos)) {
        return 'rojo';
    }
    return 'negro';
}

function inicializar_partida()
{
    if (!isset($_SESSION['dinero'])) {
        $_SESSION['dinero'] = DINERO_INICIAL;
    }
    if (!isset($_SESSION['historial'])) {
        $_SESSION['historial'] = [];
    }
}

function reiniciar_partida()
{
    $_SESSION['dinero'] = DINERO_INICIAL;
    $_SESSION['historial'] = [];
}

function calcular_multiplicador($tipo, $valor, $ganador, $color)
{
    if ($tipo == 'numero') {
        if ($valor === $ganador) {
            return MULTIPLICADOR_NUMERO;
        }
    }

    if ($tipo == 'color') {
        if ($valor === $color) {
            return MULTIPLICADOR_COLOR;
        }
    }

    if ($tipo == 'paridad' && $ganador != 0) {
        if ($valor == 'par' && $ganador % 2 == 0) {
            return MULTIPLICADOR_PARIDAD;
        }
        if ($valor == 'impar' && $ganador % 2 == 1) {
            return MULTIPLICADOR_PARIDAD;
        }
    }

    if ($tipo == 'mitad' && $ganador != 0) {
        if ($valor == 'bajo' && $ganador <= 18) {
            return MULTIPLICADOR_MITAD;
        }
        if ($valor == 'alto' && $ganador >= 19) {
            return MULTIPLICADOR_MITAD;
        }
    }

    if ($tipo == 'columna' && $ganador != 0) {
        $columna = $ganador % 3;
        if ($columna == 0) {
            $columna = 3;
        }
        if ($valor == $columna) {
            return MULTIPLICADOR_COLUMNA;
        }
    }

    if ($tipo == 'docena' && $ganador != 0) {
        if ($valor == 1 && $ganador <= 12) {
            return MULTIPLICADOR_DOCENA;
        }
        if ($valor == 2 && $ganador >= 13 && $ganador <= 24) {
            return MULTIPLICADOR_DOCENA;
        }
        if ($valor == 3 && $ganador >= 25) {
            return MULTIPLICADOR_DOCENA;
        }
    }

    return 0;
}

function procesar_apuesta($post)
{
    if (!isset($post['tipo']) || !isset($post['valor']) || !isset($post['apuesta'])) {
        return ['tipo' => 'error', 'mensaje' => 'Elige primero una casilla del tapete.'];
    }

    $tipos = $post['tipo'];
    $valores = $post['valor'];
    $apuestas = $post['apuesta'];

    $total = 0;
    for ($i = 0; $i < count($tipos); $i++) {
        if ($apuestas[$i] <= 0) {
            return ['tipo' => 'error', 'mensaje' => 'Todas las apuestas deben ser mayores que cero.'];
        }
        $total = $total + $apuestas[$i];
    }

    if ($total > $_SESSION['dinero']) {
        return ['tipo' => 'error', 'mensaje' => 'No tienes suficiente dinero para hacer esas apuestas.'];
    }

    $ganador = girar_ruleta();
    $color = color_numero($ganador);
    $premio = 0;

    for ($i = 0; $i < count($tipos); $i++) {
        $multiplicador = calcular_multiplicador($tipos[$i], $valores[$i], $ganador, $color);
        $premio = $premio + $apuestas[$i] * $multiplicador;
    }

    $_SESSION['dinero'] = $_SESSION['dinero'] - $total + $premio;

    if ($premio > 0) {
        $estado = 'ganada';
        $mensaje = "Has apostado $total y recibes $premio.";
    } else {
        $estado = 'perdida';
        $mensaje = "Has perdido $total.";
    }

    $nuevo = [$ganador];
    foreach ($_SESSION['historial'] as $anterior) {
        if (count($nuevo) < 12) {
            $nuevo[] = $anterior;
        }
    }
    $_SESSION['historial'] = $nuevo;

    return [
        'tipo' => $estado,
        'mensaje' => $mensaje,
        'numero' => $ganador,
        'color' => $color,
    ];
}