<?php
include ("empleados/../../../php/deep_sesion.php");
include ("empleados/../../../php/bd.php");
// Verificar si se ha pasado un ID en la URL
if (isset($_GET['Clave_Producto_PK'])) {
  $id = $_GET['Clave_Producto_PK'];
  $id_string = strval($id);
  // Preparar la consulta para obtener los datos del registro
  $sql = "SELECT * FROM productos WHERE Clave_Producto_PK = '$id_string'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Obtener los datos del registro
    $producto = $result->fetch_assoc();
  } else {
    echo "Registro no encontrado";
    exit();
  }

  $conn->close();
} else {
  echo "ID no proporcionado";
  exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/normalize.css" />
  <link rel="stylesheet" href="../../css/style.css" />
  <link rel="stylesheet" href="../../css/forms-register.css" />
  <link rel="shortcut icon" href="../../img/global/lavanderia.png" />
  <title>Inventario</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>EDITAR PRODUCTO</h1>
    </div>
  </section>
  <section class="options">
    <form action="procesar_formulario.php" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" class="form-control" id="clave" name="clave" disabled
          value="<?php echo $producto['Clave_Producto_PK']; ?>" />
        <input type="hidden" class="form-control" id="clave" name="clave"
          value="<?php echo $producto['Clave_Producto_PK']; ?>" />
        <label for="clave">Clave del Producto</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="nom" name="nom" disabled
          value="<?php echo $producto['Nombre_Producto']; ?>" />
        <label for="nom">Nombre del Producto</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control numero4" id="num" name="num"
          value="<?php echo $producto['Piezas']; ?>" />
        <label for="num">Número de piezas</label>
      </div>
      <div class="form-group">
        <select class="form-control" id="um" name="um" disabled>
          <option value="Piezas" <?php if ($producto['UM'] == 'Piezas')
            echo 'selected'; ?>>Piezas</option>
          <option value="Metros" <?php if ($producto['UM'] == 'Metros')
            echo 'selected'; ?>>Metros</option>
          <option value="Litros" <?php if ($producto['UM'] == 'Litros')
            echo 'selected'; ?>>Litros</option>
          <option value="Kilos" <?php if ($producto['UM'] == 'Kilos')
            echo 'selected'; ?>>Kilos</option>
        </select>
        <label for="um">Unidad de medida</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="desc" name="desc"
          value="<?php echo $producto['Descripcion_Producto']; ?>" disabled />
        <label for="desc">Descripción</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" id="precio" name="precio" step="0.01"
          value="<?php echo $producto['Precio_Unitario']; ?>" disabled />
        <label for="precio">Precio unitario</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" id="stock" name="stock"
          value="<?php echo $producto['Stock_Minimo']; ?>" disabled />
        <label for="stock">Stock minimo para las alertas</label>
      </div>
      <div class="form-group">
        <select class="form-control" id="vigente" name="vigente" disabled>
          <option value="1" <?php if ($producto['Vigente'] == '1')
            echo 'selected'; ?>>Si</option>
          <option value="0" <?php if ($producto['Vigente'] == '0')
            echo 'selected'; ?>>No</option>
        </select>
        <label for="vigente">Vigente</label>
      </div>
      <button type="submit" class="submit">Actualizar</button>
    </form>
  </section>
  <footer class="footer">
    <a href="consultar.php" class="btn_salir">Regresar</a>
    <a href="inventario/../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>

</body>

</html>