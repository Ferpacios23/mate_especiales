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
                <h2>Configuración de usuarios</h2>
                <main>
                    <div class="container-fluid px-4">
                        
                        <div class="card mb-4">
                            <table class="table">
                                <!-- < id="datatablesSimple"> -->
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">correo</th>
                                            <th scope="col">Fecha de registro</th>
                                            <th scope="col">rol</th>
                                            <th scope="col">Telefono</th>
                                            <th scope="col">Editar</th> 
                                            <th scope="col">Eliminar</th> 
                                        
                                        </tr>
                                    </thead>
                                    
                                    <tbody style="text-align: center;">                                          
                                    
                                    <?php
                                    
                                    $conexion=mysqli_connect("localhost","root","","mate_especiales"); 
                                    $SQL="SELECT * FROM usuarios ";
                                    $dato = mysqli_query($conexion, $SQL);

                                    if($dato -> num_rows >0){
                                        while($fila=mysqli_fetch_array($dato)){
                                        
                                    ?>
                                    <tr>
                                    <td><?php echo $fila['id']; ?></td>
                                    <td><?php echo $fila['nombre']; ?></td>
                                    <td><?php echo $fila['correo']; ?></td>
                                    <td><?php echo $fila['fechas_creacion']; ?></td>
                                    <td><?php echo $fila['id_rol']; ?></td>
                                    <td><?php echo $fila['telefono']; ?></td>

                                    <td>
                                    <a  class="btn btn-warning" href="./editarUsuarios.php ?id=<?php echo $fila['id']?>   ">Editar </a>

                                </td>
                                <td>
                                    
                                    <a class="btn btn-danger" href="./funciones/eliminar.php ?id=<?php echo $fila['id']?>   ">Eliminar</a>                                    
                                    </td>
                                    </tr>


                                    <?php
                                    }
                                    }else{

                                        ?>
                                        <tr class="text-center">
                                        <td colspan="16">No existen registros</td>
                                        </tr>

                                        
                                        <?php
                                        
                                    }

                                    ?>
                                    </tbody>

                            </table>
                        </div>
                    </div>
                    <a href="./registrar.php">
                        <h2 class="modal-title">Registrar</h2>
                    </a>
                </main>

            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>

