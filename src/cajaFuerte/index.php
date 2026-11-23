<?php
// Definimos las variables iniciales
$numero_papel = 3;
$respuesta1_correcta = "Jason";
$respuesta2_correcta = "Creeper";

$resultado = null;
$mensaje_extra = "";

// Comprobamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recogemos lo que haya escrito el usuario (quitando espacios a los lados)
    $resp1_usuario = trim($_POST['respuesta1'] ?? '');
    $resp2_usuario = trim($_POST['respuesta2'] ?? '');

    // Calculamos la longitud (número de letras) de cada respuesta
    // Usamos mb_strlen por si se introducen tildes o la letra ñ
    $letras_resp1 = mb_strlen($resp1_usuario, 'UTF-8');
    $letras_resp2 = mb_strlen($resp2_usuario, 'UTF-8');

    // Sumamos las letras de ambas respuestas + el número de papel (3)
    $resultado = $letras_resp1 + $letras_resp2 + $numero_papel;

    // Comprobación opcional para darle un toque extra si acierta las palabras exactas
    if (strcasecmp($resp1_usuario, $respuesta1_correcta) == 0 && strcasecmp($resp2_usuario, $respuesta2_correcta) == 0) {
        $mensaje_extra = "¡Ambas respuestas son correctas! (5 + 7 + 3)";
    } else {
        $mensaje_extra = "Cálculo realizado con las letras que has introducido ($letras_resp1 + $letras_resp2 + $numero_papel).";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivinanzas - Número 3</title>
    <style>
        /* Estilos generales */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1e1e2f 0%, #2a2a40 100%);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Contenedor principal */
        .contenedor {
            background-color: #2f2f46;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            max-width: 550px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Título principal */
        h1 {
            text-align: center;
            font-size: 2.2rem;
            color: #00d2ff;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 30px;
            border-bottom: 2px solid rgba(0, 210, 255, 0.3);
            padding-bottom: 15px;
        }

        /* Bloques de preguntas */
        .pregunta-box {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #00d2ff;
        }

        .pregunta-texto {
            font-size: 1.1rem;
            margin-bottom: 12px;
            line-height: 1.5;
            color: #e0e0e0;
        }

        /* Inputs de texto */
        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 2px solid #444466;
            background-color: #1e1e2f;
            color: #fff;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #00d2ff;
        }

        /* Botón de enviar */
        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(90deg, #00d2ff 0%, #3a7bd5 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-top: 10px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 210, 255, 0.4);
        }

        /* Caja del resultado */
        .resultado-box {
            margin-top: 25px;
            padding: 20px;
            background-color: rgba(0, 255, 136, 0.1);
            border: 1px solid #00ff88;
            border-radius: 10px;
            text-align: center;
            animation: aparecer 0.4s ease-out;
        }

        .resultado-numero {
            font-size: 2.5rem;
            font-weight: bold;
            color: #00ff88;
            margin: 10px 0;
        }

        .resultado-detalle {
            font-size: 0.9rem;
            color: #b0b0cc;
        }

        @keyframes aparecer {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="contenedor">
        <!-- Título pedido -->
        <h1>numero <?php echo $numero_papel; ?></h1>

        <form method="POST" action="">
            <!-- Adivinanza 1 -->
            <div class="pregunta-box">
                <p class="pregunta-texto">
                    <strong>1:</strong> "Soy el protagonista de GTA VI y vivo en una película"
                </p>
                <input type="text" name="respuesta1" placeholder="Escribe la respuesta" value="<?php echo htmlspecialchars($_POST['respuesta1'] ?? ''); ?>" required>
            </div>

            <!-- Adivinanza 2 -->
            <div class="pregunta-box">
                <p class="pregunta-texto">
                    <strong>2:</strong> "Mmmmmmmm. Cuidado, si te acercas exploto, ¿Cómo me llaman?"
                </p>
                <input type="text" name="respuesta2" placeholder="Escribe la respuesta" value="<?php echo htmlspecialchars($_POST['respuesta2'] ?? ''); ?>" required>
            </div>

            <button type="submit">Calcular Resultado</button>
        </form>

        <!-- Mostrar el resultado si ya se envió el formulario -->
        <?php if ($resultado !== null): ?>
            <div class="resultado-box">
                <p>El resultado total es:</p>
                <div class="resultado-numero"><?php echo $resultado; ?></div>
                <p class="resultado-detalle"><?php echo $mensaje_extra; ?></p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>