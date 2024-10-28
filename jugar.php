<?php
session_start();

// Si el usuario no está logueado, lo enviamos al index
if (!$_SESSION['usuario']) {
    header("Location:index.html");
    exit();
}

include("./funciones/conexion.php");
include("./funciones/funciones.php");

// Obtener el tiempo configurado para la cuenta regresiva
$query = "SELECT tiempo_por_pregunta FROM configuracion WHERE id = 1";
$result = mysqli_query($conn, $query);
$configuracion = mysqli_fetch_assoc($result);
$tiempo_por_pregunta = $configuracion['tiempo_por_pregunta'];

$confi = obtenerValoresDeConfiguraciones();
$totalPreguntasPorJuego = $confi['totalPreguntas'];

// Lógica para avanzar en el cuestionario
if (isset($_GET['siguiente'])) { // Ya está jugando
    // Aumentar estadísticas de respondidas
    aumentarRespondidas();

    // Verificar si la respuesta es correcta
    if (isset($_GET['respuesta']) && $_SESSION['respuesta_correcta'] == $_GET['respuesta']) {
        $_SESSION['correctas']++;
    }

    // Avanzar a la siguiente pregunta
    $_SESSION['numPreguntaActual']++;

    // Si quedan preguntas, cargamos la siguiente
    if ($_SESSION['numPreguntaActual'] < $totalPreguntasPorJuego) {
        $preguntaActual = obtenerPreguntaPorId($_SESSION['idPreguntas'][$_SESSION['numPreguntaActual']]);
        $_SESSION['respuesta_correcta'] = $preguntaActual['correcta'];
    } else {
        // Fin del juego, calcular resultados y redirigir
        $_SESSION['incorrectas'] = $totalPreguntasPorJuego - $_SESSION['correctas'];
        $_SESSION['nombreCategoria'] = obtenerNombreTema($_SESSION['idCategoria']);
        $_SESSION['score'] = ($_SESSION['correctas'] * 100) / $totalPreguntasPorJuego;
        header("Location: final.php");
        exit();
    }
} else { // Si es la primera vez que juega, inicializar partida
    $_SESSION['correctas'] = 0;
    $_SESSION['numPreguntaActual'] = 0;
    $_SESSION['preguntas'] = obtenerIdsPreguntasPorCategoria($_SESSION['idCategoria']);
    $_SESSION['idPreguntas'] = array();

    // Guardamos los IDs de las preguntas y desordenamos
    foreach ($_SESSION['preguntas'] as $idPregunta) {
        array_push($_SESSION['idPreguntas'], $idPregunta['id']);
    }
    
    shuffle($_SESSION['idPreguntas']);

    // Cargamos la primera pregunta
    $preguntaActual = obtenerPreguntaPorId($_SESSION['idPreguntas'][0]);
    $_SESSION['respuesta_correcta'] = $preguntaActual['correcta'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZ GAME</title>
    <link rel="stylesheet" href="./css/style_juego.css">
</head>
<body>
    <div class="container-juego" id="container-juego">
        <header class="header">
            <div class="categoria">
                <?php echo obtenerNombreTema($preguntaActual['tema']) ?>
            </div>
            <a href="index-preguntas.php">Quizgame.com</a>
        </header>
        <div class="info">
            <div class="estadoPregunta">
                Pregunta <span class="numPregunta"><?php echo $_SESSION['numPreguntaActual'] + 1?></span> de <?php echo $totalPreguntasPorJuego ?>
            </div>
            <h3>
                <?php echo $preguntaActual['pregunta'] ?>
            </h3>
            <div class="timer">
                Tiempo restante: <span id="countdown"><?php echo $tiempo_por_pregunta; ?></span> segundos
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" id="questionForm">
                <div class="opciones">
                    <label for="respuesta1" onclick="seleccionar(this)" class="op1">
                        <p><?php echo $preguntaActual['opcion_a'] ?></p>
                        <input type="radio" name="respuesta" value="A" id="respuesta1">
                    </label>
                    <label for="respuesta2" onclick="seleccionar(this)" class="op2">
                        <p><?php echo $preguntaActual['opcion_b'] ?></p>
                        <input type="radio" name="respuesta" value="B" id="respuesta2">
                    </label>
                    <label for="respuesta3" onclick="seleccionar(this)" class="op3">
                        <p><?php echo $preguntaActual['opcion_c'] ?></p>
                        <input type="radio" name="respuesta" value="C" id="respuesta3">
                    </label>
                    <label for="respuesta4" onclick="seleccionar(this)" class="op4">
                        <p><?php echo $preguntaActual['opcion_d'] ?></p>
                        <input type="radio" name="respuesta" value="D" id="respuesta4">
                    </label>
                </div>
                <div class="boton">
                    <input type="submit" value="Siguiente" name="siguiente" >
                    <input type="hidden" name="siguiente" value="1">
                </div>
            </form>
        </div>
    </div>
    <script src="./js/juego.js"></script>
    <script>
    window.onload = function() {
        let countdownElement = document.getElementById('countdown');
        let timeLeft = <?php echo $tiempo_por_pregunta; ?>;  // Tiempo recuperado desde PHP
        let countdownInterval = setInterval(function() {
            timeLeft--;
            countdownElement.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                // Enviar automáticamente el formulario si el tiempo termina sin selección
                document.getElementById('questionForm').submit();
            }
        }, 1000);  // Intervalo de 1 segundo
    };
    </script>
</body>
</html>
