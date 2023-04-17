<?php
session_start();
if (!empty($_POST["btningresar"])) {
    if (empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["password"])) {
        echo '<div class="alerta">Llene todos los campos</div>';
    } else {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $clave = $_POST["password"];
        $sql = $conexion->query("SELECT * FROM usuarios WHERE nombre='$nombre' AND apellido='$apellido' AND clave='$clave'");
        if ($datos = $sql->fetch_object()) {
            $_SESSION["nombre"] = $nombre;
            $_SESSION["apellido"] = $apellido;
            $_SESSION["hora_conexion"] = date("Y-m-d H:i:s");
            header("location:inicio/index.php");
            $fecha_hora_actual = date("Y-m-d H:i:s");
            $sql = "UPDATE usuarios SET ultima_conexion = '$fecha_hora_actual' WHERE nombre='$nombre' AND apellido='$apellido'";
            $conexion->query($sql);
            $usuario_id = $datos->id;
            $sql = "INSERT INTO conexiones(usuario_id, fecha_conexion) VALUES ('$usuario_id', '$fecha_hora_actual')";
            $conexion->query($sql);
        } else {
            echo '<div class="alerta">Debe registrarse primero</div>';
        }
    }
}

if (!empty($_POST["btnregistrar"])) {
    if (empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["password"]) || empty($_POST["rol"])) {
        echo '<div class="alerta">Llene todos los campos</div>';
    } else {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $clave = $_POST["password"];
        $rol = $_POST["rol"];
        $sql = $conexion->query("SELECT * FROM usuarios WHERE nombre='$nombre' AND apellido='$apellido'");
        if ($datos = $sql->fetch_object()) {
            echo('<div class="access">Ya existe este Usuarios Ingrese otro apellido</div>');
        } else {
            $sql = $conexion->query("INSERT INTO usuarios(nombre, apellido, clave, rol) VALUES('$nombre','$apellido', '$clave', '$rol')");
            if ($sql == 1) {
                echo('<div class="access">Guardado exitosamente</div>');
            } else {
                echo('<div class="error">Fallo al guardar</div>');
            }
        }
    }
}
?>
