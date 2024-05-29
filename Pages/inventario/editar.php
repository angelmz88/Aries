<?php
include ("inventario/../../../php/deep_sesion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $claveProducto = $_POST['clave'];
    $piezasReducir = intval($_POST['num']); // Asegurarse de que es un número entero

    include ("inventario/../../../php/bd.php");

    // Obtener el número actual de piezas
    $numActualSql = "SELECT Piezas FROM productos WHERE Clave_Producto_PK = '$claveProducto'";
    $result = $conn->query($numActualSql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $numActual = intval($row['Piezas']);

        // Verificar si el número actual de piezas es mayor o igual al número de piezas a reducir
        if ($numActual >= $piezasReducir) {
            $sql = "UPDATE productos SET Piezas = $piezasReducir WHERE Clave_Producto_PK = '$claveProducto'";

            // Ejecutar la consulta y verificar si fue exitosa
            if ($conn->query($sql) === TRUE) {
                echo '<script>';
                echo 'alert("Producto actualizado correctamente");';
                echo 'window.location.href = "consultar.php";'; // Redirige a otra_página.php después de que el usuario haga clic en "Aceptar"
                echo '</script>';
            } else {
                echo "Error al actualizar datos: " . $conn->error;
            }
        } else {
            echo '<script>';
            echo 'alert("No tienes permiso para agregar productos");';
            echo 'window.location.href = "consultar.php";';
            echo '</script>';
        }
    } else {
        echo "Producto no encontrado";
    }

    $conn->close();
}
?>