<?php
//Función para obtener el registro de os usuarios del sitio
function obtenerConfiguracion() {
    include("conexion.php"); // Incluye la conexión a la base de datos

    // Comprobar si existe algún registro en la tabla de usuarios
    $query = "SELECT COUNT(*) AS total FROM usuarios";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($conn)); // Manejar error si falla la consulta
    }

    $row = mysqli_fetch_assoc($result);

    // Si no hay usuarios, insertar uno predeterminado
    if ($row['total'] == '0') {
        $query = "INSERT INTO usuarios (id, nombre, telefono, correo, password, fechas_creacion, totalPreguntas, id_rol) 
                  VALUES (NULL, 'admin', '0000000000', 'admin@gmail.com', '" . password_hash('admin', PASSWORD_DEFAULT) . "', '" . date('Y-m-d') . "', 4, 1)";
        
        if (mysqli_query($conn, $query)) {
            echo "Usuario administrador predeterminado creado correctamente.";
        } else {
            echo "Error al insertar en la base de datos: " . mysqli_error($conn);
        }
    }

    // Selecciona el registro del usuario administrador (id = 1)
    $query = "SELECT * FROM usuarios WHERE id_rol = '1'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error al seleccionar el usuario: ' . mysqli_error($conn));
    }

    $config = mysqli_fetch_assoc($result); // Devuelve la configuración del usuario
    return $config;
}

//Función para obtener el registro de la configuración del sitio

function obtenerValoresDeConfiguraciones(){
    include("conexion.php");
    // Comprobar si existe algún registro en la tabla de usuarios
    $query = "SELECT COUNT(*) AS total FROM configuracion";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($conn)); // Manejar error si falla la consulta
    }

    $row = mysqli_fetch_assoc($result);

     // Si no hay configuracion, insertar uno predeterminado
     if ($row['total'] == '0') {
        $query = "INSERT INTO configuracion (id, totalPreguntas, tiempo_por_pregunta) 
                  VALUES ( 1 , 10, 100)";
        
        if (mysqli_query($conn, $query)) {
            echo "Usuario administrador predeterminado creado correctamente.";
        } else {
            echo "Error al insertar en la base de datos: " . mysqli_error($conn);
        }
    }

    // Selecciona el registro del usuario administrador (id = 1077425015)
    $query = "SELECT * FROM configuracion WHERE id = '1'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error al seleccionar el configuracion: ' . mysqli_error($conn));
    }

    $config = mysqli_fetch_assoc($result); // Devuelve la configuración
    return $config;
}


//Esta función agrega un nuevo tema a la tabla temas
function agregarNuevoTema($tema) {
    include("conexion.php"); // Incluye la conexión a la base de datos

    // Insertar un nuevo tema
    $query = "INSERT INTO temas (id, nombre) VALUES (NULL, '$tema')";

    // Ejecutar la consulta
    if (mysqli_query($conn, $query)) {
        $mensaje = "El tema fue agregado correctamente";
        header("Location: index.php"); // Redirigir al index después de insertar
    } else {
        $mensaje = "No se pudo insertar en la BD: " . mysqli_error($conn);
    }

    return $mensaje;
}
//Obtiene todos los registros de la tabla temas
function obtenerTodosLosTemas(){
    include("conexion.php");
    $query = "SELECT * FROM temas";
    $result = mysqli_query($conn, $query);
    return $result;
}
//Obtiene el nombre del tema basado en el ID.
function obtenerNombreTema($id){
    include("conexion.php");
    $query = "SELECT * FROM temas WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $tema = mysqli_fetch_array($result);
    
    return $tema['nombre'];
}
//Obtiene todas las preguntas de la tabla preguntas.
function obetenerTodasLasPreguntas()
{
    include("conexion.php");
    $query = "SELECT * FROM preguntas";
    $result = mysqli_query($conn, $query);
    return $result;
}
//Obtiene una pregunta específica basada en el ID.
function obtenerPreguntaPorId($id){
    include("conexion.php");
    $query = "SELECT * FROM preguntas WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $pregunta = mysqli_fetch_array($result);
    return $pregunta;
}
//Cuenta el número total de preguntas en la base de datos.
function obtenerTotalPreguntas(){
    include("conexion.php");
    //Añadimos un alias AS total para identificar mas facil
    $query = "SELECT COUNT(*) AS total FROM preguntas";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);  
    return $row['total'];
}
//Obtiene el total de preguntas por tema.
function totalPreguntasPorCategoria($tema){
    include("conexion.php");
    $query = "SELECT COUNT(*) AS total FROM preguntas WHERE tema = '$tema'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);  
    return $row['total'];
}
//Obtiene todas las categorías y la cantidad de preguntas por categoría.
function obtenerCategorias(){
    include("conexion.php");
    //ACOntamos la cantidad de cada categoria
    $query = "SELECT tema, COUNT(DISTINCT tema) FROM preguntas GROUP BY tema";
    $result = mysqli_query($conn, $query);
    return $result;
}
//Obtiene las categorías que tienen al menos una cantidad mínima de preguntas.
function obtenertotalCategorias($totalPreguntasPorJuego){
    include("conexion.php");
    // Contamos la cantidad de preguntas por cada categoría y filtramos
    $query = "SELECT tema, COUNT(id) AS total_preguntas 
              FROM preguntas 
              GROUP BY tema 
              HAVING total_preguntas >= $totalPreguntasPorJuego"; // Filtrar categorías con suficientes preguntas
    $result = mysqli_query($conn, $query);
    return $result;
}
//Obtiene los IDs de preguntas asociadas a una categoría.
function obtenerIdsPreguntasPorCategoria($tema){
    include("conexion.php");
    $query = "SELECT id FROM preguntas WHERE tema = $tema";
    $result = mysqli_query($conn, $query);
    return $result;
}
//
function aumentarVisita(){
    include("conexion.php");
    //Selecciono el registro de la estadistica
    $query = "SELECT * FROM estadisticas  WHERE id='1'";
    $result = mysqli_query($conn, $query);
    $estadistica = mysqli_fetch_assoc($result);
    $visitas = $estadistica['visitas'];
    $visitas = $visitas + 1;

    $query = "UPDATE estadisticas SET visitas = '$visitas' WHERE id='1'";
    $result = mysqli_query($conn, $query);
}
function aumentarRespondidas(){
    include("conexion.php");
    //Selecciono el registro de la estadistica
    $query = "SELECT * FROM estadisticas  WHERE id='1'";
    $result = mysqli_query($conn, $query);
    $estadistica = mysqli_fetch_assoc($result);
    $respondidas = $estadistica['respondidas'];
    $respondidas = $respondidas + 1;

    $query = "UPDATE estadisticas SET respondidas = '$respondidas' WHERE id='1'";
    $result = mysqli_query($conn, $query);
}
function aumentarCompletados(){
    include("conexion.php");
    //Selecciono el registro de la estadistica
    $query = "SELECT * FROM estadisticas  WHERE id='1'";
    $result = mysqli_query($conn, $query);
    $estadistica = mysqli_fetch_assoc($result);
    $completados = $estadistica['completados'];
    $completados = $completados + 1;

    $query = "UPDATE estadisticas SET completados = '$completados' WHERE id='1'";
    $result = mysqli_query($conn, $query);
}
