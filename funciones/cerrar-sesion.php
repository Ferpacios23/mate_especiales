

<?php
    session_start();  // Inicia la sesión para tener acceso a los datos de la sesión actual.

    session_destroy(); // Destruye todos los datos asociados a la sesión, cerrando efectivamente la sesión del usuario.

    header("Location: ../index.html"); // Redirige al usuario a la página de inicio o login (en este caso, un archivo HTML externo).
    exit(); // Asegura que el código posterior no se ejecute después de la redirección.
?>
