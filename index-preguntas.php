<?php
session_start();

// Verificar si el usuario está logueado, de lo contrario, redirigir al login
if (!isset($_SESSION['usuarioLogeado'])) {
    header("Location: index.html");
    exit();
}

// Incluir las funciones necesarias
include("./funciones/funciones.php");

// Aumentar el contador de visitas
aumentarVisita();

// Obtener la configuración del juego
$config = obtenerValoresDeConfiguraciones();
$totalPreguntasPorJuego = (int)$config['totalPreguntas'];

// Obtener las categorías que tienen el número mínimo de preguntas necesarias
$categorias = obtenertotalCategorias($totalPreguntasPorJuego);

// Redirigir al juego si se selecciona una categoría
if (isset($_GET['idCategoria'])) {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style_juego.css">
    <title>Mate Esp</title>
</head>
<body>
    <div class="container" id="container">
        <div class="left">
            <div class="logo">
                Mate Esp
            </div>
            <h2>PON A PRUEBA TUS CONOCIMIENTOS EN MATE ESPECILES!</h2>
        </div>
        <div class="right">
            <h3>Elige una categoría</h3>
            <div class="categorias">
                <?php while ($cat = mysqli_fetch_assoc($categorias)): ?>
                <div class="categoria">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="<?php echo htmlspecialchars($cat['tema']); ?>">
                        <input type="hidden" name=" idCategoria" value="<?php echo htmlspecialchars($cat['tema']); ?>">
                        <a href="javascript:{}" onclick="document.getElementById('<?php echo htmlspecialchars($cat['tema']); ?>').submit(); return false;">
                            <?php echo obtenerNombreTema($cat['tema']); ?>
                        </a>
                    </form>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>
