
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
            <h1>Mate Esp</h1>
        </header>
        <div class="contenedor-info">
            <?php include("nav.php") ?>
            <div class="panel">
                <h2>registro</h2>
                <hr>
                <section id="nuevaPregunta">
                    <form action="./funciones/crear.php" method="POST">
                        
                        <div class="opciones">
                            <div class="opcion">
                                <label for="">C.C o T.I</label>
                                <input type="text" name="id" id=""  required>
                            </div>
                            <div class="opcion">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre"  required>
                            </div>
                            <div class="opcion">
                                <label for="">Telefono</label>
                                <input type="number" name="telefono" required>
                            </div>
                            <div class="opcion">
                                <label for="">correo electronico</label>
                                <input type="email" name="correo" required>
                            </div>
                            <div class="opcion">
                                <label for="">Contraseña</label>
                                <input type="password" name="password" required>
                            </div>
                        </div>
                        <div class="opcion">
                            <label for="">rol</label>
                            <select name="id_rol" id="" class="correcta">
                                <option value="1">1 : admin</option>
                                <option value="2">2 : Profesores</option>
                                <option value="3">3 : estudiantes</option>
                            </select>
                        </div>
                        <hr>
                        <input type="submit" value="Registrarse" name="actualizar" class="btn-guardar">
                    </form>
                </section>
            </div>
        </div>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>