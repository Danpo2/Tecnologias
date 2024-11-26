<?php
// Se utiliza para llamar al archivo que contiene la conexión a la base de datos
require 'conexion.php';
session_start(); // Inicia la sesión para manejar datos del usuario

// Validamos que el formulario y el botón login hayan sido presionados
if (isset($_POST['login'])) {

    // Obtener los valores enviados por el formulario
    $correo = mysqli_real_escape_string($conexion, $_POST['correo_user']); // Ahora se usa el correo
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena_user']);

    // Ejecutamos la consulta a la base de datos utilizando la función mysqli_query
    $sql = "SELECT * FROM usuarios WHERE correo_user = '$correo' AND contrasena_user = '$contrasena'";
    $resultado = mysqli_query($conexion, $sql);

    // Validar si la consulta fue exitosa
    if ($resultado) {
        $numero_registros = mysqli_num_rows($resultado);

        if ($numero_registros > 0) {
            // Inicio de sesión exitoso
            $fila = mysqli_fetch_assoc($resultado); // Obtiene la fila del usuario
            $_SESSION['correo_user'] = $fila['correo_user']; // Guarda el correo en la sesión
            $_SESSION['nombre_user'] = $fila['nombre_user']; // Guarda también el nombre del usuario si es necesario

            // Redirigir a la página de bienvenida (rutina.html)
            header("Location: ../rutina.html");
            exit;
        } else {
            // Credenciales inválidas
            header("Location: ../index.php?error=Credenciales inválidas. Verifica tu correo y/o contraseña.");
            exit;
        }
    } else {
        // Mostrar el error de la consulta
        header("Location: ../index.php?error=Error en la consulta: " . mysqli_error($conexion));
        exit;
    }
}
?>
