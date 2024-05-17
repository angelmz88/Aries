<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include ("proveedores/../../../../php/bd.php");
    $nom = $_POST['nombre'];
    $telefono = $_POST['telPrincipal'];
    $telefonoAlterno = $_POST['telSecundario'];
    $email = $_POST['email'];
    $mPago = $_POST['pago'];
    $catalogo = $_POST['catalogo'];
    $calle = $_POST['calle'];
    $numExterior = $_POST['num'];
    $colonia = $_POST['colonia'];
    $codigoPostal = $_POST['cp'];
    $municipio = $_POST['mun'];
    $estado = $_POST['estatus'];

    // Consulta SQL de actualización
    $sql = "UPDATE proveedores SET Telefono_Principal = '$telefono', 
    Telefono_Alterno = '$telefonoAlterno', Correo_Electronico = '$email', Metodo_Pago = '$mPago', Catalogo_Producto = '$catalogo', 
    Calle = '$calle', Numero_Exterior = '$numExterior', Colonia = '$colonia', Codigo_Postal = '$codigoPostal', 
    Municipio = '$municipio', Estado = '$estado' WHERE Nombre_Distribuidora_PK = '$nom'";

    echo $sql;

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo '<script>';
        echo 'alert("Proveedor actualizado correctamente");';
        echo 'window.location.href = "buscar.php";'; // Redirige a otra_pagina.php después de que el usuario haga clic en "Aceptar"
        echo '</script>';
    } else {
        echo "Error al actualizar datos: " . $conn->error;
    }
    $conn->close();
}
