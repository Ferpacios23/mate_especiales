<?php
session_start();

//Si el usuario no esta logeado lo enviamos al login
if (!$_SESSION['usuarioLogeado']) {
    header("Location:index.html");
    exit();

}

include("./funciones/funciones.php");

$config = obtenerConfiguracion();

/******************************************************* */
//ACTUALIZAMOSS LA CONFIGURACION
if (isset($_GET['actualizar'])) {
    //nos conectamos a la base de datos
    include("./funciones/conexion.php");

    //tomamos los datos que vienen del formulario
    $usuario = $_GET['correo'];
    $password = $_GET['password'];
    $totalPreguntas = $_GET['totalPreguntas'];

    if( $totalPreguntas > 0){
        //Armamos el query para actualizar en la tabla configuracion
        $query = "UPDATE usuarios SET correo='$usuario', password='$password', totalPreguntas='$totalPreguntas' WHERE id='1077425015'";
        
        if (mysqli_query($conn, $query)) { //Se actualizo correctamente
            $mensaje = "La configuración se actualizo correctamente";
            header("Location: configuracion.php");
            echo "naad";
        } else {
            $mensaje = "No se pudo actualizar en la BD" . mysqli_error($conn);
        }
    }else{
        $mensaje = "No se pudo actualizar en la BD" . mysqli_error($conn);
    }

    //actualizamos en la tabla configuracion
}
//ELIMINAR PREGUNTAS
if (isset($_GET['eliminarPreguntas'])) {
    //nos conectamos a la base de datos
    include("conexion.php");
    //sentiencia para eliminar los datos de la tabla
    $query ="TRUNCATE TABLE preguntas";
    //eliminamos los datos de la tabla preguntas
    if (mysqli_query($conn, $query)) { //Se eliminó correctamente
        $mensaje = "Se eliminaron los datos de la tabla preguntas";
        header("Location: index.php");
    } else {
        $mensaje = "No se pudo eliminar en la BD" . mysqli_error($conn);
    }
}
//ELIMINAMOS LAS PREGUNTAS Y LAS CATEGORIAS
if (isset($_GET['eliminarTodo'])) {
    //nos conectamos a la base de datos
    include("conexion.php");
    //sentiencia para eliminar los datos de la tabla
    $query1 ="TRUNCATE TABLE preguntas";
    $query2 ="TRUNCATE TABLE temas";
    //eliminamos los datos de la tabla preguntas
    if (mysqli_query($conn, $query1)) { //Se eliminó correctamente
        if (mysqli_query($conn, $query2)) { //Se eliminó correctamente
            $mensaje = "Se eliminaron las preguntas y las categorias";
            header("Location: index.php");
        } else {
            $mensaje = "No se pudo eliminar las categorias en la BD" . mysqli_error($conn);
        }
    } else {
        $mensaje = "No se pudo eliminar en la BD" . mysqli_error($conn);
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
    <title>Document</title>
</head>
<body>
    <div class="contenedor">
        <header>
            <h1>QUIZ GAME</h1>
        </header>
        <div class="contenedor-info">
            <?php include("nav.php") ?>
            <div class="panel">
                <h2>Configuración del Administrador</h2>
                <hr>
                <section id="configuracion">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                        <div class="fila">
                            <label for="">Usuario:</label>
                            <input type="text" name="correo" id="" value = "<?php echo $config['correo']?>" required>
                        </div>
                        <div class="fila">
                            <label for="">Password</label>
                            <input type="text" name="password" id="" value = "<?php echo $config['password']?>" required>
                        </div>
                        <div class="fila">
                            <label for="">Total Preguntas por Juego</label>
                            <input type="number" name="totalPreguntas" id="" value = "<?php echo $config['totalPreguntas']?>" required>
                        </div>
                        <hr>
                        <input type="submit" value="Actualizar Configuracion" name="actualizar" class="btn-actualizar">
                    </form>
                </section>

                <h2>Preguntas y Categorías</h2>
                <hr>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" class="form-eliminar">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <input type="submit" value="Eliminar Preguntas (Solo se eliminaran las preguntas)" name="eliminarPreguntas" class="btn-eliminar">
                    <input type="submit" value="Eliminar Preguntas y Categorías" name="eliminarTodo" class="btn-eliminar">
                </form>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
    <script>paginaActiva(3);</script> 
</body>
</html>