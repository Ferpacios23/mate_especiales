<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style_P.css">
</head>
<body>
<div class="container">
    
    <div class="container-form">
        <a href="./login_princimal.html">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <form class="sign-in" action="./funciones/verificar_login.php" method="POST">
            <h2>Iniciar Sesión</h2>

            <span>Profesor ingrese su correo y contraseña</span>

            <div class="container-input">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text" name="ini_correo" placeholder="Correo Electrónico">
            </div>
            <div class="container-input">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" name="ini_password" placeholder="Password">
            </div> 
            
            <a href="#">¿Olvidaste tu contraseña?</a>
            
            <input class="button" type="submit" name="ingresar" placeholder="INICIAR SESIÓN"></input>
        </form>
        <?php if (isset($_GET['ingresar'])) : ?>
            <span> <?php echo $mensaje ?></span>
        <?php endif ?>
    </div>
    <div class="container-form">
        <form class="sign-up" action="./funciones/guardar_post.php" method="POST">
            <h2>Registrarse</h2>
            <span>Use su correo electrónico para registrarse</span>
            
            <div class="container-input">
                <ion-icon name="person-outline"></ion-icon>
                <input type="text" name="identificacion" class="identificacion" placeholder="Identificacion (C.C o T.I)" required>
            </div>
            <div class="container-input">
                <ion-icon name="person-outline"></ion-icon>
                <input type="text" name="nombre" placeholder="Nombre" required>
            </div>            
            <div class="container-input">
                <i class="bi bi-telephone"></i>
                <input type="text" name="telefono" placeholder="Telefono" required>
            </div>            
            <div class="container-input">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" name="correo" placeholder="Correo Electrónico" required>
            </div>
            <div class="container-input">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <input type="number" name="id_rol" value="2" style="display: none;">

            <button name="registrarse" class="button" title="submit" >REGISTRARSE</button>
        </form>
    </div> 
    <div class="container-welcome" >
        <div class="welcome-sign-up welcome">
            <h3>¡Bienvenido!</h3>
            <p>Ingrese sus tus datos personales para usar todas las funciones del sitio</p>
            <button class="button" id="btn-sign-up">Registrarse</button>
        </div>
        <div class="welcome-sign-in welcome">
            <h3>¡Hola!</h3>
            <p>Regístrese con sus datos personales para usar todas las funciones del sitio</p>
            <button class="button" id="btn-sign-in">Iniciar Sesión</button>
        </div>
    </div>
</div>
<script src="js/script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>