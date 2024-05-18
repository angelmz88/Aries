<?php
include ("proveedores/../../../../php/final_sesion.php");
include ("proveedores/../../../../php/bd.php");
// Verificar si se ha pasado un ID en la URL
if (isset($_GET['Nombre_Distribuidora_PK'])) {
  $id = $_GET['Nombre_Distribuidora_PK'];
  $id_string = strval($id);
  // Preparar la consulta para obtener los datos del registro
  $sql = "SELECT * FROM proveedores WHERE Nombre_Distribuidora_PK = '$id_string'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Obtener los datos del registro
    $proveedor = $result->fetch_assoc();
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
  <link rel="stylesheet" href="../../../css/normalize.css" />
  <link rel="stylesheet" href="../../../css/style.css" />
  <link rel="stylesheet" href="../../../css/forms-register.css" />
  <link rel="shortcut icon" href="../../../img/global/lavanderia.png" />
  <title>Proveedores</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>ACTUALIZACIÓN DE PROVEEDORES</h1>
    </div>
  </section>
  <section class="options">
    <form action="editar.php" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" class="form-control" id="nombre_mostrar" name="nombre_mostrar"
          value="<?php echo $proveedor['Nombre_Distribuidora_PK']; ?>" disabled />
        <input type="hidden" class="form-control" id="nombre" name="nombre"
          value="<?php echo $proveedor['Nombre_Distribuidora_PK']; ?>" />
        <label for="nombre_mostrar">Nombre</label>
      </div>
      <div class="form-group">
        <input type="tel" class="form-control" id="telPrincipal" name="telPrincipal"
          value="<?php echo $proveedor['Telefono_Principal']; ?>" required />
        <label for="telPrincipal">Teléfono principal</label>
      </div>
      <div class="form-group">
        <input type="tel" class="form-control" id="telSecundario" name="telSecundario"
          value="<?php echo $proveedor['Telefono_Alterno']; ?>" required />
        <label for="telSecundario">Teléfono secundario</label>
      </div>
      <div class="form-group">
        <input type="email" class="form-control" id="email" name="email"
          value="<?php echo $proveedor['Correo_Electronico']; ?>" required />
        <label for="email">Correo electrónico</label>
      </div>
      <div class="form-group">
        <select class="form-control" id="pago" name="pago" required>
          <option value="Efectivo" <?php if ($proveedor['Metodo_Pago'] == 'Efectivo')
            echo 'selected'; ?>>Efectivo
          </option>
          <option value="Transferencia" <?php if ($proveedor['Metodo_Pago'] == 'Transferencia')
            echo 'selected'; ?>>
            Transferencia </option>
          <option value="Tarjeta" <?php if ($proveedor['Metodo_Pago'] == 'Tarjeta')
            echo 'selected'; ?>>
            Tarjeta </option>
        </select>
        <label for="pago">Método de pago</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="catalogo" name="catalogo"
          value="<?php echo $proveedor['Catalogo_Producto']; ?>" required />
        <label for="catalogo">Catálogo que ofrece</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="calle" name="calle" value="<?php echo $proveedor['Calle']; ?>"
          required />
        <label for="calle">Calle</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="num" name="num" value="<?php echo $proveedor['Numero_Exterior']; ?>"
          required />
        <label for="num">Número</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="colonia" name="colonia" value="<?php echo $proveedor['Colonia']; ?>"
          required />
        <label for="colonia">Colonia</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" id="cp" name="cp" value="<?php echo $proveedor['Codigo_Postal']; ?>"
          required />
        <label for="cp">Código postal</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="mun" name="mun" value="<?php echo $proveedor['Municipio']; ?>"
          required />
        <label for="mun">Alcaldía/Municipio</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="estatus" name="estatus" value="<?php echo $proveedor['Estado']; ?>"
          required>
        <label for="estatus">Estado</label>
      </div>
      <button type="submit" class="submit">Actualizar</button>
    </form>
  </section>
  <footer class="footer">
    <a href="buscar.php" class="btn_salir">Regresar</a>
    <a href="proveedores/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>