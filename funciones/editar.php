<?php
include "./conexion.php";

// Obtener los detalles de la artesanía para editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);  // 'i' porque id es un entero
    $stmt->execute();
    $result = $stmt->get_result();
    $artesania = $result->fetch_assoc();
    $stmt->close();
}

// Actualizar la artesanía en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $fecha_creacion = date('Y-m-d');  // Fecha actual
    $id_rol = $_POST['rol'];

    // Corregir la cadena de tipos para bind_param
    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, telefono = ?, correo = ?, fechas_creacion = ?, id_rol = ? WHERE id = ?");
    $stmt->bind_param("ssssii", $nombre, $telefono, $correo, $fecha_creacion, $id_rol, $id);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Artesanía actualizada con éxito.</div>';
        header('Location: ../Usuarios.php');
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }

    $stmt->close();
}
?>







<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/estilo.css">
    <title>Document</title>
</head>
<body>
    <div class="contenedor">
        <header>
            <h1>QUIZ GAME</h1>
        </header>
        <div class="contenedor-info">
            <?php include("../nav.php") ?>
            <div class="panel">
                <h2>editar </h2>
                <hr>
                <section id="nuevaPregunta">

                    <form action="editar.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $artesania['id']; ?>">
                        <div class="opciones">
                            <div class="opcion">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $artesania['nombre']; ?>" required>
                            </div>
                            <div class="opcion">
                                <label for="">Telefono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $artesania['telefono']; ?>" required>
                                </div>
                            <div class="opcion">
                                <label for="">correo electronico</label>
                                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $artesania['correo']; ?>" required>
                            </div>
                            <div class="opcion">
                                <label for="">rol</label>
                                <input type="number" class="form-control" id="rol" name="rol" value="<?php echo $artesania['id_rol']; ?>" required>
                            </div>
                            
                        </div>
                        <hr>
                        <input type="submit" value="Actualizar Pregunta" name="actualizar" class="btn-guardar" >
                        </form>



                </section>
            </div>
        </div>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>