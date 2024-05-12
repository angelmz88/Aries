<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["username"])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    echo "Estoy en sesion";
    // header("Location: php/salir.php");
    header("Location: pages/../../../php/salir.php");
    exit;
}

