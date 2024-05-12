<?php
// Iniciar la sesión si aún no se ha iniciado
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Eliminar la cookie de sesión si se ha creado
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio o a cualquier otra página después de cerrar la sesión
header("Location: ../index.php"); // Cambia 'index.php' por la página a la que quieras redirigir al usuario
exit();
?>