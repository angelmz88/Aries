<?php
include ("inventario/../../../../php/final_sesion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $claveProducto = $_POST['clave'];
    $nombreProducto = $_POST['nom'];
    $piezas = $_POST['num'];
    $um = $_POST['um'];
    $descripcionProducto = $_POST['desc'];
    $precioUnitario = $_POST['precio'];
    $stock = $_POST['stock'];
    $vigente = $_POST['vigente'];

    include ("inventario/../../../../php/bd.php");

    // Consulta SQL de actualización
    $sql = "UPDATE productos SET Nombre_Producto = '$nombreProducto', 
    Piezas = $piezas, UM = '$um', Descripcion_Producto = '$descripcionProducto', Precio_Unitario = $precioUnitario, 
    Stock_Minimo = $stock, Vigente = $vigente WHERE Clave_Producto_PK = '$claveProducto'";

    echo $sql;
    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo '<script>';
        echo 'alert("Producto actualizado correctamente");';
        echo 'window.location.href = "buscar.php";'; // Redirige a otra_pagina.php después de que el usuario haga clic en "Aceptar"
        echo '</script>';
    } else {
        echo "Error al actualizar datos: " . $conn->error;
    }
    $conn->close();
}
