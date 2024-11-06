<?php
session_start();

// Si el usuario no está logeado, redirigir al login
if (!isset($_SESSION['usuarioLogeado'])) {
    header("Location: index.html");
    exit();
}

// Incluir las funciones necesarias
include("./funciones/funciones.php");
include("./funciones/conexion.php");

$config = obtenerConfiguracion($conn); // Obtener la configuración actual del sistema
$obtenerValorConfig = obtenerValoresDeConfiguraciones($conn);

/******************************************************* */
// ACTUALIZAMOS LA CONFIGURACIÓN
if (isset($_GET['actualizar'])) {
    // Validar y sanitizar los datos de entrada
    $usuario = mysqli_real_escape_string($conn, $_GET['correo']);
    $password = mysqli_real_escape_string($conn, $_GET['password']);
    $totalPreguntas = (int)$_GET['totalPreguntas'];
    $nuevo_tiempo = (int)$_GET['tiempo'];

    // Validar que los campos no estén vacíos y que el número de preguntas sea mayor a 0
    if (!empty($usuario) && !empty($password) && $totalPreguntas > 0 && $nuevo_tiempo > 0) {
        // Consultas preparadas para actualizar usuario y configuración
        $queryUsuario = "UPDATE usuarios SET correo=?, password=? WHERE id=1077425015";
        $queryConfig = "UPDATE configuracion SET totalPreguntas=?, tiempo_por_pregunta=? WHERE id=1";

        // Preparar y ejecutar ambas consultas
        $stmtUsuario = $conn->prepare($queryUsuario);
        $stmtUsuario->bind_param("ss", $usuario, $password);

        $stmtConfig = $conn->prepare($queryConfig);
        $stmtConfig->bind_param("ii", $totalPreguntas, $nuevo_tiempo);

        if ($stmtUsuario->execute() && $stmtConfig->execute()) {
            $mensaje = "La configuración se actualizó correctamente.";
            header("Location: configuracion.php");
            exit(); // Importante: detener el script después de la redirección
        } else {
            $mensaje = "Error al actualizar la configuración: ";
        }
    } else {
        $mensaje = "Por favor, complete todos los campos correctamente.";
    }
}

/******************************************************* */
// ELIMINAR PREGUNTAS
if (isset($_GET['eliminarPreguntas'])) {
    
    // Sentencia para eliminar las preguntas
    $queryEliminarPreguntas = "TRUNCATE TABLE preguntas";

    if (mysqli_query($conn, $queryEliminarPreguntas)) {
        $mensaje = "Se eliminaron todas las preguntas correctamente.";
        header("Location: index.php");
        exit(); // Detener el script después de la redirección
    } else {
        $mensaje = "Error al eliminar preguntas: ";
    }
}

/******************************************************* */
// ELIMINAR TODO: PREGUNTAS Y CATEGORÍAS
if (isset($_GET['eliminarTodo'])) {
    // Sentencias para eliminar preguntas y categorías
    $queryEliminarPreguntas = "TRUNCATE TABLE preguntas";
    $queryEliminarTemas = "TRUNCATE TABLE temas";

    if (mysqli_query($conn, $queryEliminarPreguntas) && mysqli_query($conn, $queryEliminarTemas)) {
        $mensaje = "Se eliminaron las preguntas y las categorías correctamente.";
        header("Location: index.php");
        exit(); // Detener el script después de la redirección
    } else {
        $mensaje = "Error al eliminar preguntas y categorías: ";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/estilo.css">
    <title>Configuración del Administrador</title>
</head>
<body>
    <div class="contenedor">
        <header>
            <h1>Mate Esp</h1>
        </header>
        <div class="contenedor-info">
            <?php include("nav.php"); ?>
            <div class="panel">
                <h2>Configuración del Administrador</h2>
                <hr>
                <section id="configuracion">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                        <div class="fila">
                            <label for="correo">Usuario:</label>
                            <input type="text" name="correo" id="correo" value="<?php echo htmlspecialchars($config['correo']); ?>" required>
                        </div>
                        <div class="fila">
                            <label for="password">Password</label>
                            <input type="text" name="password" id="password" value="<?php echo htmlspecialchars($config['password']); ?>" required>
                        </div>
                        <div class="fila">
                            <label for="totalPreguntas">Total Preguntas por Juego</label>
                            <input type="number" name="totalPreguntas" id="totalPreguntas" value="<?php echo isset($obtenerValorConfig['totalPreguntas']) ? (int)$obtenerValorConfig['totalPreguntas'] : 0; ?>" required>
                        </div>
                        <div class="fila">
                            <label for="tiempo">Tiempo de las preguntas (segundos)</label>
                            <input type="number" name="tiempo" id="tiempo" value="<?php echo isset($obtenerValorConfig['tiempo_por_pregunta']) ? (int)$obtenerValorConfig['tiempo_por_pregunta'] : 0;   ?>" required>
                        </div>
                        <hr>
                        <input type="submit" value="Actualizar Configuración" name="actualizar" class="btn-actualizar">
                    </form>
                </section>

                <h2>Preguntas y Categorías</h2>
                <hr>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="form-eliminar">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <input type="submit" value="Eliminar Preguntas (Solo se eliminarán las preguntas)" name="eliminarPreguntas" class="btn-eliminar">
                    <input type="submit" value="Eliminar Preguntas y Categorías" name="eliminarTodo" class="btn-eliminar">
                </form>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
    <script>paginaActiva(3);</script>
</body>
</html>

