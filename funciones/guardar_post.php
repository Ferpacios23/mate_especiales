<?php

include("conexion.php");

// Recoger los datos del formulario y asegurarse de que existen
$identificacion = isset($_POST['identificacion']) ? $_POST['identificacion'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$id_rol = isset($_POST['id_rol']) ? $_POST['id_rol'] : '';

// Validar que los campos no estén vacíos
if (empty($identificacion) || empty($nombre) || empty($telefono) || empty($correo) || empty($password) || empty($id_rol)) {
    die('Error: Todos los campos son obligatorios.');
}

// Encriptar la contraseña
$contras = password_hash($password, PASSWORD_DEFAULT);

// Crear el comando SQL usando Prepared Statements para evitar inyección SQL
$sql = "INSERT INTO usuarios (id, nombre, telefono, correo, password, fechas_creacion, id_rol)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

// Preparar la consulta
$stmt = mysqli_prepare($conn, $sql);


// Verificar si la consulta se preparó correctamente
if (!$stmt) {
    die('Error al preparar la consulta: ' . mysqli_error($conn));
}


// Crear la fecha como una variable para evitar el problema de referencia
$fecha_creacion = date('Y-m-d');

// Vincular los parámetros a la consulta
mysqli_stmt_bind_param($stmt, 'ssssssi', $identificacion, $nombre, $telefono, $correo, $contras, $fecha_creacion, $id_rol);

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt)) {
    echo "Usuario registrado correctamente";
} else {
    die('Error al registrar el usuario: ' . mysqli_error($conn));
}

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);

// Obtener el rol del usuario recién insertado
$query_rol = "SELECT id_rol FROM usuarios WHERE id = ?";
$stmt_rol = mysqli_prepare($conn, $query_rol);

if (!$stmt_rol) {
    die('Error al preparar la consulta para obtener el rol: ' . mysqli_error($conn));
}

// Vincular el parámetro (id/identificación)
mysqli_stmt_bind_param($stmt_rol, 's', $identificacion);

// Ejecutar la consulta
mysqli_stmt_execute($stmt_rol);

// Obtener el resultado
$resultado_rol = mysqli_stmt_get_result($stmt_rol);

$fila = mysqli_fetch_array($resultado_rol);

// Redirigir al usuario según su rol
if ($fila) {
    if ($fila['id_rol'] == 2) {
        header('Location: ../login_P.php');
    } elseif ($fila['id_rol'] == 3) {
        header('Location: ../login_E.php');
    } else {
        header('Location: ../index.html');
    }
} else {
    echo "Error: No se pudo obtener el rol del usuario.";
}
// Cerrar la consulta y la conexión
mysqli_stmt_close($stmt_rol);
mysqli_close($conn);

?>
