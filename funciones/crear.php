<?php
    // echo $_POST['nombre']. " ";
    // echo $_POST["correo"]. " ";
    // echo $_POST["contrasenia"]. " ";

    // var_dump($_POST);


    #1 paso, establecer la conexion con la base de datos
    
        include "./conexion.php";

        

        #3 preparar los campos
        // encriptamos el texto plano que viene desde el formulario, bcrypt => hola
        // password_hash = sirve para incriptar las contrasenias 
        $contras = password_hash($_POST["password"], PASSWORD_DEFAULT );

        // para mostras la contrasenia incriptada
        // echo $_POST["contrasenia"]. "". $contras;

        #4. PASO, crear el comando sql
        $sql = "insert into usuarios(id, nombre, telefono, correo, password, fechas_creacion, id_rol)
        values('".$_POST['id']."','".$_POST['nombre']."','".$_POST["telefono"]."','".$_POST["correo"]."','".$contras."',
        '".date('Y-m-d')."','".$_POST['id_rol']."')";
        
        //mostrar el comando sql
        //echo $sql;

        #5, paso, ecutar el comando
        $resultado = mysqli_query($conn, $sql);



        if($resultado){



            header('Location: ../usuarios.php');
        }else{
            // enviar un mensaje
            //redireccionar segun el diagrama de actividades
            //manejo de sesiones 
            echo "malo";
        }


?>