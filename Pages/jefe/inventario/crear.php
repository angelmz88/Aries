<?php
include ("empleados/../../../../php/final_sesion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../../css/normalize.css" />
  <link rel="stylesheet" href="../../../css/style.css" />
  <link rel="stylesheet" href="../../../css/forms-register.css" />
  <link rel="shortcut icon" href="../../../img/global/lavanderia.png" />
  <title>Inventario</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>AGREGAR PRODUCTO</h1>
    </div>
  </section>
  <section class="options">
    <form action="crear.php" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" class="form-control" id="clave" name="clave" required />
        <label for="clave">Clave del Producto</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="nom" name="nom" required />
        <label for="nom">Nombre del Producto</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" id="num" name="num" required />
        <label for="num">Número de piezas</label>
      </div>
      <div class="form-group">
        <select class="form-control" id="um" name="um" required>
          <option value="Piezas">Piezas</option>
          <option value="Metros">Metros</option>
          <option value="Litros">Litros</option>
          <option value="Kilos">Kilos</option>
        </select>
        <label for="um">Unidad de medida</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="desc" name="desc" required />
        <label for="desc">Descripción</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" id="precio" name="precio" step="0.01" required />
        <label for="precio">Precio unitario</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" id="stock" name="stock" required />
        <label for="stock">Stock minimo para las alertas</label>
      </div>
      <button type="submit" class="submit">Guardar</button>
    </form>
  </section>
  <footer class="footer">
    <a href="../inventario/inventario.php" class="btn_salir">Regresar</a>
    <a href="inventario/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $claveProducto = $_POST['clave'];
    $nombreProducto = $_POST['nom'];
    $piezas = $_POST['num'];
    $um = $_POST['um'];
    $descripcionProducto = $_POST['desc'];
    $precioUnitario = $_POST['precio'];
    $stock = $_POST['stock'];

    include ("inventario/../../../../php/bd.php");

    // Consulta SQL de inserción
    $sql = "INSERT INTO productos (Clave_Producto_PK, Nombre_Producto, Piezas, UM, Descripcion_Producto, Precio_Unitario, Stock) 
VALUES ('$claveProducto', '$nombreProducto', $piezas, '$um', '$descripcionProducto', $precioUnitario, $stock)";
    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
      echo '<script>';
      echo 'alert("Producto registrado correctamente");';
      // echo 'window.location.href = "../index.php";'; // Redirige a otra_pagina.php después de que el usuario haga clic en "Aceptar"
      echo '</script>';
    } else {
      // echo "Error al insertar datos: " . $conn->error;
    }
  }
  ?>
</body>

</html>