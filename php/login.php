<?php
include ('bd.php');
session_start();

// Obtener los datos del formulario de inicio de sesión
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta SQL para verificar las credenciales del usuario
$sql = "SELECT * FROM empleados WHERE Numero_Seguridad_Social='$username' AND Numero_Telefono_PK='$password'";
$result = $conn->query($sql);

// Verificar si el usuario ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($result->num_rows > 0) {
        $validacion = "SELECT Tipo FROM empleados where Numero_Seguridad_Social = '$username'";
        $retorno = $conn->query($validacion);
        $row = $retorno->fetch_assoc();
        $tipo = (string) $row['Tipo'];
        // El usuario ha iniciado sesión correctamente
        $_SESSION["username"] = $username; // Establecer una variable de sesión para indicar que el usuario ha iniciado sesión
        echo "Inicio de sesión exitoso. ¡Bienvenido!";
        echo $tipo;
        // Redirigir a otra página

        if ($tipo == 'Jefe') {
            header("Location: ../Pages/jefe.php");
        } elseif ($tipo == 'Empleado') {
            header("Location: ../Pages/empleado.php");
        }
        exit(); // Asegúrate de salir del script después de la redirección
    } else {
        // Las credenciales son incorrectas
        echo "Nombre de usuario o contraseña incorrectos.";
        echo '<script>';
        echo 'alert("Nombre de usuario o contraseña incorrectos.");';
        echo 'window.location.href = "../index.php";'; // Redirige a otra_pagina.php después de que el usuario haga clic en "Aceptar"
        echo '</script>';
        // header("Location: ../index.html");
    }
}

$conn->close();


