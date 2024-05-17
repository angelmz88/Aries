<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $primer_Nombre = $_POST['nom-clientes'];
    $segundo_Nombre = $_POST['segundo-nom-clientes'];
    $primer_Apellido = $_POST['ap-clientes'];
    $segundo_Apellido = $_POST['segundo-ap-clientes'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $tel = $_POST['tel'];

    include ("empleados/../../../php/deep_sesion.php");
    include ("empleados/../../../php/bd.php");

    // Consulta SQL de actualización
    $sql = "UPDATE clientes SET 
    Primer_Nombre = '$primer_Nombre', 
    Segundo_Nombre = '$segundo_Nombre', 
    Primer_Apellido = '$primer_Apellido', 
    Segundo_Apellido = '$segundo_Apellido', 
    Calle = '$calle', 
    Numero_Exterior = '$numero'
    WHERE Numero_Telefono_PK = '$tel'";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo '<script>';
        echo 'alert("Cliente actualizado correctamente");';
        echo 'window.location.href = "consultar.php";'; // Redirige a otra_pagina.php después de que el usuario haga clic en "Aceptar"
        echo '</script>';
    } else {
        echo "Error al actualizar datos: " . $conn->error;
    }
    $conn->close();
}
