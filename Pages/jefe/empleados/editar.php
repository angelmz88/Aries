<?php
include ("empleados/../../../../php/final_sesion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include ("empleados/../../../../php/bd.php");
    $numTelPk = $_POST['tel'];
    $primer_Nombre = $_POST['firstName'];
    $segundo_Nombre = $_POST['name'];
    $primer_Apellido = $_POST['secondName'];
    $segundo_Apellido = $_POST['second'];
    $correo_Electronico = $_POST['mail'];
    $nss = $_POST['nss'];
    $salario = $_POST['salary'];
    $nomina = $_POST['nomina'];
    $estatus = $_POST['estatus'];
    $tipo = $_POST['tipo'];
    $vigente = $_POST['estatus'];

    // Consulta SQL de actualización
    $sql = "UPDATE empleados SET Numero_Telefono_PK = '$numTelPk', 
    Primer_Nombre = '$primer_Nombre', Segundo_Nombre = '$segundo_Nombre', Primer_Apellido = '$primer_Apellido', 
    Segundo_Apellido = '$segundo_Apellido', Correo_Electronico = '$correo_Electronico',
    Numero_Seguridad_Social = '$nss', Salario = $salario, Tipo_Nomina = '$nomina', 
    Vigente = '$estatus', Tipo_Empleado = '$tipo', Vigente = $vigente WHERE Numero_Telefono_PK = '$numTelPk'";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo '<script>';
        echo 'alert("Empleado actualizado correctamente");';
        echo 'window.location.href = "buscar.php";'; // Redirige a otra_pagina.php después de que el usuario haga clic en "Aceptar"
        echo '</script>';
    } else {
        echo "Error al actualizar datos: " . $conn->error;
    }
    $conn->close();
}
