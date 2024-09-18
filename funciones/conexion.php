<?
   // Datos de conexión a la base de datos
   $host = "localhost";
   $user = "root";
   $password = "";
   $database = "mate_especiales";

   // Crear la conexión
   $conexion = new mysqli($host, $user, $password, $database);

   if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
 }

?>