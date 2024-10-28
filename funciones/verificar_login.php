<?php
    
    session_start();  // Iniciamos la sesión para guardar datos del usuario
    include("funciones.php");
    include("conexion.php");
    $config = obtenerConfiguracion();
    
    if(!empty($_POST["ingresar"])) {
        if (empty($_POST['ini_correo']) || empty($_POST['ini_password'])) {
            echo "Por favor, rellene todos los campos.";
        } else {
            // Paso 3: Crear el comando SQL
            $sql = "SELECT * FROM usuarios WHERE correo ='" . $_POST['ini_correo'] . "'";

            // Paso 4: Ejecutar el comando SQL
            $resultado = mysqli_query($conn, $sql);

            // Paso 4.1: Obtener los datos del resultado en forma de arreglo
            $row = mysqli_fetch_assoc($resultado);

            

            // Paso 5: Verificar si el comando SQL devolvió resultados
            if ($row) {
                // Verificar la contraseña usando password_verify
                $vpwd = password_verify($_POST['ini_password'], $row['password']);

                var_dump($vpwd);
                
                

                if ($vpwd) {
                    // Si la contraseña es correcta, crear las variables de sesión
                    $_SESSION['nombre'] = $row["nombre"];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['id_rol'] = $row['id_rol'];

                    // Redirigir dependiendo del id_rol
                    if ($row['id_rol'] == 1) {
                        // Si es administrador (id_rol = 1), redirigir a admin.php
                        $_SESSION['usuarioLogeado'] = "Administrador";
                        header("Location: ../index.php");
                        exit();  // Asegurarse de detener la ejecución después de la redirección
                    }elseif ($row['id_rol'] == 2) {
                        // Si es usuario regular (id_rol = 2), redirigir a profesores.php
                        $_SESSION['usuarioLogeado'] = "Administrador";
                        header("Location:  ../index.php");
                          // Asegurarse de detener la ejecución después de la redirección
                    }
                    elseif ($row['id_rol'] == 3) {
                        // Si es usuario regular (id_rol = 3), redirigir a usuario.php
                        $_SESSION['usuarioLogeado'] = "estudiante";
                        header("Location: ../index-preguntas.php");
                         // Asegurarse de detener la ejecución después de la redirección
                    } else {
                        // Si el rol no es reconocido, redirigir a una página de error o inicio
                        header("Location: ../index.html");
                        
                    }
                } else {
                    // Contraseña incorrecta
                    echo "Las contraseñas no coinciden.";
                    header("location: ../index.html");
                }
            } else {
                // Si no se encuentra el correo en la base de datos
                echo "Correo no encontrado.";
            }
        }
    }





    
?>




