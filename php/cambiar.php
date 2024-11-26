<?php
require 'conexion.php';
session_start();

// Si el botón "Cerrar Sesión" es presionado
if (isset($_POST['logout'])) {
    session_destroy(); // Finaliza la sesión
    header("Location: login.html"); // Redirige al inicio de sesión
    exit();
}

?>