<?php
session_start();
require '../controlador/conexion.php'; // Asegúrate de que este archivo contenga la conexión a la base de datos

if (isset($_POST["eliminar"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];

    $sql = $conexion->query("DELETE FROM usuarios WHERE nombre='$nombre' AND apellido='$apellido'");

    if ($sql) {
        echo "Usuario eliminado correctamente. <a href='../inicio/index.php'>Regresar</a>";
        session_destroy();
    } else {
        echo "Error al eliminar el usuario. <a href='inicio/index.php'>Regresar</a>";
    }
}
?>