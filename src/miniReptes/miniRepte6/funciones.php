<?php
// funciones.php - Ruleta americana (versión sencilla)

define('DINERO_INICIAL', 1000);

// Lo que multiplica tu apuesta si aciertas, según el tipo de apuesta
// (el resultado incluye tu apuesta: apostar 10 a un número y ganar = 360)
define('MULTIPLICADOR_NUMERO', 36);
define('MULTIPLICADOR_CABALLO', 18);
define('MULTIPLICADOR_CUADRO', 9);
define('MULTIPLICADOR_COLOR', 2);
define('MULTIPLICADOR_PARIDAD', 2);
define('MULTIPLICADOR_MITAD', 2);
define('MULTIPLICADOR_COLUMNA', 3);
define('MULTIPLICADOR_DOCENA', 3);
define('MULTIPLICADOR_FILA', 12);


// Aquí está cada número con sus datos: color, par/impar, columna y fila.
// La fila es el grupo de 3 números que están en vertical en el tapete (1-2-3 es la fila 1, 4-5-6 la fila 2...)
// La columna es cada línea horizontal del tapete (la de abajo es la 1: 1-4-7-10...)
// El 0 y el 00 no tienen paridad, columna ni fila (por eso 'ninguna' y 0)
function obtener_numeros()
{
    $numeros = [
        '0'  => ['color' => 'verde', 'paridad' => 'ninguna', 'columna' => 0, 'fila' => 0],
        '00' => ['color' => 'verde', 'paridad' => 'ninguna', 'columna' => 0, 'fila' => 0],

        '1'  => ['color' => 'rojo',  'paridad' => 'impar', 'columna' => 1, 'fila' => 1],
        '2'  => ['color' => 'negro', 'paridad' => 'par',   'columna' => 2, 'fila' => 1],
        '3'  => ['color' => 'rojo',  'paridad' => 'impar', 'columna' => 3, 'fila' => 1],

        '4'  => ['color' => 'negro', 'paridad' => 'par',   'columna' => 1, 'fila' => 2],
        '5'  => ['color' => 'rojo',  'paridad' => 'impar', 'columna' => 2, 'fila' => 2],
        '6'  => ['color' => 'negro', 'paridad' => 'par',   'columna' => 3, 'fila' => 2],

        '7'  => ['color' => 'rojo',  'paridad' => 'impar', 'columna' => 1, 'fila' => 3],
        '8'  => ['color' => 'negro', 'paridad' => 'par',   'columna' => 2, 'fila' => 3],
        '9'  => ['color' => 'rojo',  'paridad' => 'impar', 'columna' => 3, 'fila' => 3],

        '10' => ['color' => 'negro', 'paridad' => 'par',   'columna' => 1, 'fila' => 4],
        '11' => ['color' => 'negro', 'paridad' => 'impar', 'columna' => 2, 'fila' => 4],
        '12' => ['color' => 'rojo',  'paridad' => 'par',   'columna' => 3, 'fila' => 4],

        '13' => ['color' => 'negro', 'paridad' => 'impar', 'columna' => 1, 'fila' => 5],
        '14' => ['color' => 'rojo',  'paridad' => 'par',   'columna' => 2, 'fila' => 5],
        '15' => ['color' => 'negro', 'paridad' => 'impar', 'columna' => 3, 'fila' => 5],

        '16' => ['color' => 'rojo',  'paridad' => 'par',   'columna' => 1, 'fila' => 6],
        '17' => ['color' => 'negro', 'paridad' => 'impar', 'columna' => 2, 'fila' => 6],
        '18' => ['color' => 'rojo',  'paridad' => 'par',   'columna' => 3, 'fila' => 6],

        '19' => ['color' => 'rojo',  'paridad' => 'impar', 'columna' => 1, 'fila' => 7],
        '20' => ['color' => 'negro', 'paridad' => 'par',   'columna' => 2, 'fila' => 7],
        '21' => ['color' => 'rojo',  'paridad' => 'impar', 'columna' => 3, 'fila' => 7],

        '22' => ['color' => 'negro', 'paridad' => 'par',   'columna' => 1, 'fila' => 8],
        '23' => ['color' => 'rojo',  'paridad' => 'impar', 'columna' => 2, 'fila' => 8],
        '24' => ['color' => 'negro', 'paridad' => 'par',   'columna' => 3, 'fila' => 8],

        '25' => ['color' => 'rojo',  'paridad' => 'impar', 'columna' => 1, 'fila' => 9],
        '26' => ['color' => 'negro', 'paridad' => 'par',   'columna' => 2, 'fila' => 9],
        '27' => ['color' => 'rojo',  'paridad' => 'impar', 'columna' => 3, 'fila' => 9],

        '28' => ['color' => 'negro', 'paridad' => 'par',   'columna' => 1, 'fila' => 10],
        '29' => ['color' => 'negro', 'paridad' => 'impar', 'columna' => 2, 'fila' => 10],
        '30' => ['color' => 'rojo',  'paridad' => 'par',   'columna' => 3, 'fila' => 10],

        '31' => ['color' => 'negro', 'paridad' => 'impar', 'columna' => 1, 'fila' => 11],
        '32' => ['color' => 'rojo',  'paridad' => 'par',   'columna' => 2, 'fila' => 11],
        '33' => ['color' => 'negro', 'paridad' => 'impar', 'columna' => 3, 'fila' => 11],

        '34' => ['color' => 'rojo',  'paridad' => 'par',   'columna' => 1, 'fila' => 12],
        '35' => ['color' => 'negro', 'paridad' => 'impar', 'columna' => 2, 'fila' => 12],
        '36' => ['color' => 'rojo',  'paridad' => 'par',   'columna' => 3, 'fila' => 12],
    ];

    return $numeros;
}


// Devuelve un número al azar de la ruleta (0, 00, 1... 36)
function girar_ruleta()
{
    $numeros = obtener_numeros();
    $lista = array_keys($numeros);
    $posicion = rand(0, count($lista) - 1);
    return $lista[$posicion];
}


// Devuelve el color de un número
function color_numero($numero)
{
    $numeros = obtener_numeros();
    return $numeros[$numero]['color'];
}


// ---------------------------------------------------------------
// Caballos: apuestas a 2 números que se tocan en el tapete
// ---------------------------------------------------------------

// Devuelve la lista de todos los caballos que existen, con formato "3-6"
function obtener_caballos()
{
    // Los del 0 y el 00
    $caballos = ['0-00', '0-1', '0-2', '00-3'];

    for ($n = 1; $n <= 36; $n++) {
        // Con el de la derecha en el tapete (1-4, 2-5, 3-6...)
        if ($n + 3 <= 36) {
            $caballos[] = $n . '-' . ($n + 3);
        }
        // Con el de arriba en el tapete (1-2, 2-3, 4-5...). El 3, 6, 9... no tienen nadie arriba
        if ($n % 3 != 0) {
            $caballos[] = $n . '-' . ($n + 1);
        }
    }

    return $caballos;
}

// Devuelve el <td> fino y vacío de un caballo (por ejemplo "3-6")
function celda_caballo($valor)
{
    $texto = 'Caballo ' . str_replace('-', ' y ', $valor) . ' (x' . MULTIPLICADOR_CABALLO . ')';

    return '<td id="caballo-' . $valor . '" class="casilla fina" data-tipo="caballo"'
         . ' data-valor="' . $valor . '" data-texto="' . $texto . '"></td>';
}


// ---------------------------------------------------------------
// Cuadros: apuestas a 4 números que se juntan en una esquina del tapete
// ---------------------------------------------------------------

// Devuelve la lista de todos los cuadros, con formato "1-2-4-5"
function obtener_cuadros()
{
    $cuadros = [];

    // $n es el número de abajo a la izquierda del cuadro (el 3, 6, 9... no pueden, no tienen nadie arriba)
    for ($n = 1; $n <= 32; $n++) {
        if ($n % 3 != 0) {
            $cuadros[] = $n . '-' . ($n + 1) . '-' . ($n + 3) . '-' . ($n + 4);
        }
    }

    return $cuadros;
}

// Devuelve el <td> fino y vacío de un cuadro (por ejemplo "1-2-4-5")
function celda_cuadro($valor)
{
    $texto = 'Cuadro ' . str_replace('-', ', ', $valor) . ' (x' . MULTIPLICADOR_CUADRO . ')';

    return '<td id="cuadro-' . $valor . '" class="casilla fina" data-tipo="cuadro"'
         . ' data-valor="' . $valor . '" data-texto="' . $texto . '"></td>';
}


// ---------------------------------------------------------------
// Una función por cada apuesta.
// Si aciertas devuelven el multiplicador, si fallas devuelven 0.
// ---------------------------------------------------------------

function apuesta_numero($valor, $ganador)
{
    // strcmp compara como texto, así el 0 y el 00 no se confunden
    if (strcmp($valor, $ganador) == 0) {
        return MULTIPLICADOR_NUMERO;
    }
    return 0;
}

function apuesta_caballo($valor, $ganador)
{
    // "3-6" se convierte en la lista ['3', '6']
    $numeros_apostados = explode('-', $valor);

    // El true del final compara estricto, así el 0 y el 00 no se confunden
    if (in_array((string) $ganador, $numeros_apostados, true)) {
        return MULTIPLICADOR_CABALLO;
    }
    return 0;
}

function apuesta_cuadro($valor, $ganador)
{
    $numeros_apostados = explode('-', $valor);

    if (in_array((string) $ganador, $numeros_apostados, true)) {
        return MULTIPLICADOR_CUADRO;
    }
    return 0;
}

function apuesta_color($valor, $ganador)
{
    $numeros = obtener_numeros();
    if ($numeros[$ganador]['color'] == $valor) {
        return MULTIPLICADOR_COLOR;
    }
    return 0;
}

function apuesta_paridad($valor, $ganador)
{
    $numeros = obtener_numeros();
    if ($numeros[$ganador]['paridad'] == $valor) {
        return MULTIPLICADOR_PARIDAD;
    }
    return 0;
}

// 'bajo' = del 1 al 18, 'alto' = del 19 al 36
function apuesta_mitad($valor, $ganador)
{
    $numero = (int) $ganador;

    if ($valor == 'bajo' && $numero >= 1 && $numero <= 18) {
        return MULTIPLICADOR_MITAD;
    }
    if ($valor == 'alto' && $numero >= 19 && $numero <= 36) {
        return MULTIPLICADOR_MITAD;
    }
    return 0;
}

function apuesta_columna($valor, $ganador)
{
    $numeros = obtener_numeros();
    if ($numeros[$ganador]['columna'] == $valor) {
        return MULTIPLICADOR_COLUMNA;
    }
    return 0;
}

// Docena 1 = del 1 al 12, docena 2 = del 13 al 24, docena 3 = del 25 al 36
function apuesta_docena($valor, $ganador)
{
    $numero = (int) $ganador;

    // El 0 y el 00 no están en ninguna docena
    if ($numero == 0) {
        return 0;
    }

    $docena = ceil($numero / 12);
    if ($docena == $valor) {
        return MULTIPLICADOR_DOCENA;
    }
    return 0;
}

function apuesta_fila($valor, $ganador)
{
    $numeros = obtener_numeros();
    if ($numeros[$ganador]['fila'] == $valor) {
        return MULTIPLICADOR_FILA;
    }
    return 0;
}


// ---------------------------------------------------------------
// Opciones del formulario (tipos de apuesta y lo que se puede elegir)
// ---------------------------------------------------------------
function opciones_apuesta()
{
    // Todos los números, incluido el 0 y el 00
    $lista_numeros = [];
    foreach (obtener_numeros() as $numero => $datos) {
        $lista_numeros[$numero] = $numero;
    }

    // Todos los caballos
    $lista_caballos = [];
    foreach (obtener_caballos() as $caballo) {
        $lista_caballos[$caballo] = $caballo;
    }

    // Todos los cuadros
    $lista_cuadros = [];
    foreach (obtener_cuadros() as $cuadro) {
        $lista_cuadros[$cuadro] = $cuadro;
    }

    // Las 12 filas (grupos de 3 números en vertical)
    $lista_filas = [];
    for ($i = 1; $i <= 12; $i++) {
        $primero = ($i - 1) * 3 + 1;
        $lista_filas[$i] = "Fila $i ($primero-" . ($primero + 1) . "-" . ($primero + 2) . ")";
    }

    $opciones = [
        'numero'  => ['etiqueta' => 'Número (x' . MULTIPLICADOR_NUMERO . ')',
                      'valores'  => $lista_numeros],
        'caballo' => ['etiqueta' => 'Caballo (x' . MULTIPLICADOR_CABALLO . ')',
                      'valores'  => $lista_caballos],
        'cuadro'  => ['etiqueta' => 'Cuadro (x' . MULTIPLICADOR_CUADRO . ')',
                      'valores'  => $lista_cuadros],
        'color'   => ['etiqueta' => 'Color (x' . MULTIPLICADOR_COLOR . ')',
                      'valores'  => ['rojo' => 'Rojo', 'negro' => 'Negro']],
        'paridad' => ['etiqueta' => 'Par / Impar (x' . MULTIPLICADOR_PARIDAD . ')',
                      'valores'  => ['par' => 'Par', 'impar' => 'Impar']],
        'mitad'   => ['etiqueta' => '1-18 / 19-36 (x' . MULTIPLICADOR_MITAD . ')',
                      'valores'  => ['bajo' => '1 a 18', 'alto' => '19 a 36']],
        'columna' => ['etiqueta' => 'Columna (x' . MULTIPLICADOR_COLUMNA . ')',
                      'valores'  => [1 => 'Columna 1', 2 => 'Columna 2', 3 => 'Columna 3']],
        'docena'  => ['etiqueta' => 'Docena (x' . MULTIPLICADOR_DOCENA . ')',
                      'valores'  => [1 => 'Docena 1', 2 => 'Docena 2', 3 => 'Docena 3']],
        'fila'    => ['etiqueta' => 'Fila (x' . MULTIPLICADOR_FILA . ')',
                      'valores'  => $lista_filas],
    ];

    return $opciones;
}


// ---------------------------------------------------------------
// Partida
// ---------------------------------------------------------------
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


// Recibe el formulario, juega la tirada y devuelve el resultado para mostrarlo
function procesar_apuesta($post)
{
    $tipo = '';
    $valor = '';
    $apuesta = 0;

    if (isset($post['tipo']))    { $tipo = $post['tipo']; }
    if (isset($post['valor']))   { $valor = $post['valor']; }
    if (isset($post['apuesta'])) { $apuesta = (int) $post['apuesta']; }

    // Comprobaciones
    if ($apuesta <= 0) {
        return ['tipo' => 'error', 'mensaje' => 'La apuesta debe ser mayor que cero.'];
    }
    if ($apuesta > $_SESSION['dinero']) {
        return ['tipo' => 'error', 'mensaje' => 'No tienes suficiente dinero para hacer esa apuesta.'];
    }

    $opciones = opciones_apuesta();
    if (!isset($opciones[$tipo]) || !isset($opciones[$tipo]['valores'][$valor])) {
        return ['tipo' => 'error', 'mensaje' => 'La apuesta seleccionada no es válida.'];
    }

    // Tirada
    $ganador = girar_ruleta();
    $color = color_numero($ganador);

    // Según el tipo de apuesta llamamos a su función (devuelve el multiplicador o 0)
    $multiplicador = 0;
    if ($tipo == 'numero') {
        $multiplicador = apuesta_numero($valor, $ganador);
    } elseif ($tipo == 'caballo') {
        $multiplicador = apuesta_caballo($valor, $ganador);
    } elseif ($tipo == 'cuadro') {
        $multiplicador = apuesta_cuadro($valor, $ganador);
    } elseif ($tipo == 'color') {
        $multiplicador = apuesta_color($valor, $ganador);
    } elseif ($tipo == 'paridad') {
        $multiplicador = apuesta_paridad($valor, $ganador);
    } elseif ($tipo == 'mitad') {
        $multiplicador = apuesta_mitad($valor, $ganador);
    } elseif ($tipo == 'columna') {
        $multiplicador = apuesta_columna($valor, $ganador);
    } elseif ($tipo == 'docena') {
        $multiplicador = apuesta_docena($valor, $ganador);
    } elseif ($tipo == 'fila') {
        $multiplicador = apuesta_fila($valor, $ganador);
    }

    // Primero se resta la apuesta, y si has ganado se suma apuesta x multiplicador
    $_SESSION['dinero'] = $_SESSION['dinero'] - $apuesta;

    if ($multiplicador > 0) {
        $premio = $apuesta * $multiplicador;
        $_SESSION['dinero'] = $_SESSION['dinero'] + $premio;
        $estado = 'ganada';
        $mensaje = "¡Felicidades! Tu apuesta se multiplica por $multiplicador y recibes $premio.";
    } else {
        $estado = 'perdida';
        $mensaje = "Has perdido $apuesta.";
    }

    // Guardamos el número en el historial (máximo 12)
    array_unshift($_SESSION['historial'], $ganador);
    $_SESSION['historial'] = array_slice($_SESSION['historial'], 0, 12);

    return [
        'tipo'    => $estado,
        'mensaje' => $mensaje,
        'numero'  => $ganador,
        'color'   => $color,
    ];
}