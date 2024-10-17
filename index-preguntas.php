<?php
session_start();

// Si el usuario no está logeado lo enviamos al login
if (!$_SESSION['usuarioLogeado']) {
    header("Location:index.html");
    exit();
}

include("./funciones/funciones.php");

aumentarVisita();

// Obtener la configuración del juego
$confi = obtenerConfiguracion();
$totalPreguntasPorJuego = $confi['totalPreguntas'];

// Obtener las categorías que tienen al menos el número necesario de preguntas
$categorias = obtenertotalCategorias($totalPreguntasPorJuego);

if(isset($_GET['idCategoria'])){
    $_SESSION['usuario'] = "usuario";
    $_SESSION['idCategoria'] = $_GET['idCategoria'];
    header("Location: jugar.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="./css/style_juego.css">
    <title>QUIZ GAME</title>
</head>
<body>
    <div class="container" id="cantainer">
        <div class="left">
            <div class="logo">
                QUIZ GAME
            </div>
            <h2>PON A PRUEBA TUS CONOCIMIENTOS!!</h2>
        </div>
        <div class="right">
            <h3>Elige una categoría</h3>
            <div class="categorias">
                <?php while ($cat = mysqli_fetch_assoc($categorias)): ?>
                <div class="categoria">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" id="<?php echo $cat['tema'] ?>">
                        <input type="hidden" name="idCategoria" value="<?php echo $cat['tema'] ?>">
                        <a href="javascript:{}" onclick="document.getElementById('<?php echo $cat['tema'] ?>').submit(); return false;">
                            <?php echo obtenerNombreTema($cat['tema']) ?> 
                        </a>
                    </form>
                </div>
                <?php endwhile ?>
            </div>
        </div>
    </div>
</body>
</html>
