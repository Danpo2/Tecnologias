<?php
// Se utiliza para llamar al archivo que contiene la conexión a la base de datos
require 'conexion.php';

// Validamos que el formulario y que el botón de registro hayan sido presionados
if (isset($_POST['registro'])) {

    // Obtener los valores enviados por el formulario
    $usuario = mysqli_real_escape_string($conexion, $_POST['nombre_user']);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena_user']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo_user']);

    // Validamos que los campos no estén vacíos
    if (empty($usuario) || empty($contrasena) || empty($correo)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Validamos que el correo tenga un formato válido
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "El correo ingresado no es válido.";
        exit;
    }

    // Preparamos la consulta para insertar los datos
    $sql = "INSERT INTO usuarios (id_user, nombre_user, contrasena_user, correo_user) VALUES (NULL, '$usuario', '$contrasena', '$correo')";

    // Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql);

    // Validar si la inserción fue exitosa
    if ($resultado) {
        echo "¡Se insertaron los datos correctamente!";
		header("Location: ../login.html");
    	exit;
    } else {
        echo "¡No se puede insertar la información!" . "<br>";
        echo "Error: " . mysqli_error($conexion);
    }
}
?>
