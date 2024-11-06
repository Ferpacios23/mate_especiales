<?php
session_start();


//Si el usuario no esta logeado lo enviamos al index
if (!$_SESSION['usuario']) {
    header("Location:index.html");
    exit();

}
//Aumentamos la estadistica
include("./funciones/funciones.php");
aumentarCompletados();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="./css/style_juego.css">
    <title>Mate Esp</title>
</head>
<body>

    <div class="container-final" id="container-final">
        <div class="info">
            <h2>RESULTADO FINAL</h2>
            <div class="estadistica">
                <div class="acierto">
                    <span class="correctas numero"> <?php echo $_SESSION['correctas'] ?></span>
                    CORRECTAS
                </div>
                <div class="acierto">
                    <span class="incorrectas numero"> <?php echo $_SESSION['incorrectas'] ?></span>
                    INCORRECTAS
                </div>
            </div>
            <div class="score">
                <div class="box">
                    <div class="chart" data-percent="<?php echo number_format($_SESSION['score'], decimals: 2); ?>">
                       <?php echo number_format($_SESSION['score'], decimals: 2); ?>%
                    </div>
                    <h2>Puntuación</h2>
                </div>
            </div>

            <a href="./funciones/cerrar-sesion.php">Salir</a>
            <a href="./index-preguntas.php">volver</a>

        </div>
    </div>
    <script src="./js/juego.js"></script>
</body>
</html>