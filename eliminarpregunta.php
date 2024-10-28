<?php
//Si el usuario no esta logeado lo enviamos al login
if (!$_SESSION['usuarioLogeado']) {
    header("Location:index.html");
    exit();
}

    include("./funciones/conexion.php");
    $id = $_GET['idPregunta '];

    $query = "DELETE FROM preguntas WHERE id = '$id'";
    mysqli_query($conn, $query);
?>
<script>
    window.location.href = 'listadopreguntas.php';
</script>