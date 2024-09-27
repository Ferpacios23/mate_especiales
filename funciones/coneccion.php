<?php
// Datos de conexión
$host = "localhost";
$user = "root";
$password = "";
$database = "mate_especiales";

// Crear la conexión
$coneccion = new mysqli($host, $user, $password, $database);

// Verificar la conexión
if ($coneccion->connect_error) {
    die("Error de conexión: " . $coneccion->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.<br>";
}
?>