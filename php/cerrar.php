<?php

session_start(); // Iniciar sesión

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al inicio de sesión después de cerrar sesión
header("Location: ../index.html");
exit;
?>
