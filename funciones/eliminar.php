<?php
include "./conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Artesanía eliminada con éxito.</div>';
    } else {

        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';

    }

    $stmt->close();
}

$conn->close();

header('Location: ../Usuarios.php');

exit();
?>
