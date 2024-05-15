<?php
include ("proveedores/../../../../php/final_sesion.php");
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
      <h1>REGISTRO DE PROVEEDORES</h1>
    </div>
  </section>
  <section class="options">
    <form action="crear.php" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" class="form-control" id="nombre" name="nombre" required />
        <label for="nombre">Nombre</label>
      </div>
      <div class="form-group">
        <input type="tel" class="form-control" id="telPrincipal" name="telPrincipal" required />
        <label for="telPrincipal">Teléfono principal</label>
      </div>
      <div class="form-group">
        <input type="tel" class="form-control" id="telSecundario" name="telSecundario" required />
        <label for="telSecundario">Teléfono secundario</label>
      </div>
      <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" required />
        <label for="email">Correo electrónico</label>
      </div>
      <div class="form-group">
        <select class="form-control" id="pago" name="pago" required>
          <option value="Efectivo">Efectivo</option>
          <option value="Transferencia">Transferencia</option>
        </select>
        <label for="pago">Método de pago</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="catalogo" name="catalogo" required />
        <label for="catalogo">Catálogo que ofrece</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="calle" name="calle" required />
        <label for="calle">Calle</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="num" name="num" required />
        <label for="num">Número</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="colonia" name="colonia" required />
        <label for="colonia">Colonia</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" id="cp" name="cp" required />
        <label for="cp">Código postal</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="mun" name="mun" required />
        <label for="mun">Alcaldía/Municipio</label>
      </div>
      <div class="form-group">
        <select class="form-control" id="estatus" name="estatus" required>
          <option value="Activo">Activo</option>
          <option value="Inactivo">Inactivo</option>
        </select>
        <label for="estatus">Estatus</label>
      </div>
      <button type="submit" class="submit">Guardar</button>
    </form>
  </section>
  <footer class="footer">
    <a href="../proveedores/proveedores.php" class="btn_salir">Regresar</a>
    <a href="proveedores/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que todos los campos requeridos están presentes en $_POST
    $required_fields = ['nombre', 'telPrincipal', 'telSecundario', 'email', 'pago', 'catalogo', 'calle', 'num', 'colonia', 'cp', 'mun', 'estatus'];
    foreach ($required_fields as $field) {
      if (!isset($_POST[$field])) {
        echo "Error: Campo '$field' no está definido en el formulario.";
        exit();
      }
    }

    // Obtener valores del formulario
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

    // Incluir la conexión a la base de datos
    include ("inventario/../../../../php/bd.php");

    // Consulta SQL de inserción
    $sql = "INSERT INTO proveedores (Nombre_Distribuidora_PK, Telefono_Principal, Telefono_Alterno, Correo_Electronico, Metodo_Pago, Catalogo_Producto, Calle, Numero_Exterior, Colonia, Codigo_Postal, Municipio, Estado) 
    VALUES ('$nom', '$telefono', '$telefonoAlterno', '$email', '$mPago', '$catalogo', '$calle', '$numExterior', '$colonia', '$codigoPostal', '$municipio', '$estado')";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
      echo '<script>';
      echo 'alert("Proveedor registrado correctamente");';
      echo '</script>';
    } else {
      echo "Error al insertar datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
  }
  ?>


</body>


</html>