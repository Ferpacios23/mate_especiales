<?php

// include("coneccion.php");

    
            // password_hash = sirve para incriptar las contrasenias 
        // $contras = password_hash($_POST["password"], PASSWORD_DEFAULT );

        #4. PASO, crear el comando sql
        // $identificacion = isset($_POST['identificacion']) ? $_POST['identificacion'] : '';
        
        // $sql = "INSERT INTO usuarios(id,nombre, telefono, correo, password, fechas_creacion, id_rol)
        // VALUES('".$identificacion."','".$_POST['nombre']."', '".$_POST['telefono']."', '".$_POST['correo']."', '".$contras."', '".date('Y-m-d')."','".$_POST['id_rol']."')";

        #5, paso, ejecutar el comando
        // $resultado = mysqli_query($coneccion, $sql);

        //esta mysqli_fetch_array tiene problemas ocurre cuando la función mysqli_fetch_array() intenta procesar un valor false en lugar de un resultado válido de una consulta.

        // Este tipo de error generalmente indica que la consulta SQL falló, y en lugar de obtener un resultado, mysqli_query()
        // devolvió false. Para depurar esto, es importante revisar la consulta SQL y manejar correctamente los errores de la 
        // conexión o consulta.
        
        #6, paso, ejecutar  para recorrer por los roles 

        // $fila = mysqli_fetch_array($resultado); 

        // probar con el mysqli_fetch_assoc en otra ocacion
        //
        
        // if($fila['id_rol']==2){
        //     header('Location: http://localhost/proyectos/proyecto_de_la_seño_nancy/login_P.php');
        // }else
        // if($fila['id_rol']==3){
        //     header('Location: http://localhost/proyectos/proyecto_de_la_seño_nancy/login_E.php');
        // }else{
        //     header('Location: http://localhost/proyectos/proyecto_de_la_seño_nancy/index.html');
        // }



?>

