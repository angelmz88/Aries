<?php
include ("empleados/../../../../php/final_sesion.php");
include ("empleados/../../../../php/bd.php");
// Verificar si se ha pasado un ID en la URL
if (isset($_GET['Numero_Telefono_PK'])) {
  $id = $_GET['Numero_Telefono_PK'];
  $id_string = strval($id);
  // Preparar la consulta para obtener los datos del registro
  $sql = "SELECT * FROM empleados WHERE Numero_Telefono_PK = '$id_string'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Obtener los datos del registro
    $empleado = $result->fetch_assoc();
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
  <title>Empleados</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>ACTUALIZACIÓN DE EMPLEADOS</h1>
    </div>
  </section>
  <section class="options">
    <form action="editar.php" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" id="firstName" name='firstName' class="form-control nombre"
          value="<?php echo $empleado['Primer_Nombre']; ?>" />
        <label for="firstName">Primer nombre</label>
      </div>
      <div class="form-group">
        <input type="text" id="name" name="name" class="form-control nombre"
          value="<?php echo $empleado['Segundo_Nombre']; ?>" />
        <label for="name">Segundo nombre</label>
      </div>
      <div class="form-group">
        <input type="text" id="secondName" name="secondName" class="form-control nombre"
          value="<?php echo $empleado['Primer_Apellido']; ?>" required />
        <label for="secondName">Apellido paterno</label>
      </div>
      <div class="form-group">
        <input type="text" id="second" name="second" class="form-control nombre"
          value="<?php echo $empleado['Segundo_Apellido']; ?>" required />
        <label for="second">Apellido materno</label>
      </div>
      <div class="form-group">
        <select class="form-control" id="tipo" name="tipo" required>
          <option value="Empleado" <?php if ($empleado['Tipo'] == 'Empleado')
            echo 'selected'; ?>>Empleado</option>
          <option value="Jefe" <?php if ($empleado['Tipo'] == 'Jefe')
            echo 'selected'; ?>>Jefe</option>
        </select>
        <label for="tipo">Tipo de empleado</label>
      </div>
      <div class="form-group">
        <input type="number" id="nss" name="nss" class="form-control seguro"
          value="<?php echo $empleado['Numero_Seguridad_Social']; ?>" required />
        <label for="nss">Número de seguridad social</label>
      </div>
      <div class="form-group">
        <input type="number" id="salary" name="salary" class="form-control" value="<?php echo $empleado['Salario']; ?>"
          required />
        <label for="salary">Salario</label>
      </div>
      <div class="form-group">
        <select class="form-control" id="nomina" name="nomina" required>
          <option value="Quincenal" <?php if ($empleado['Tipo_Nomina'] == 'Quincenal')
            echo 'selected'; ?>>Quincenal
          </option>
          <option value="Mensual" <?php if ($empleado['Tipo_Nomina'] == 'Mensual')
            echo 'selected'; ?>>Mensual</option>
        </select>
        <label for="nomina">Tipo de nomina</label>
      </div>
      <div class="form-group">
        <input type="tel" id="tel" name="tel" class="form-control tel-clientes"
          value="<?php echo $empleado['Numero_Telefono_PK']; ?>" required />
        <label for="tel">Telefono</label>
      </div>
      <div class="form-group">
        <input type="email" id="mail" name="mail" class="form-control"
          value="<?php echo $empleado['Correo_Electronico']; ?>" required />
        <label for="mail">Correo electrónico</label>
      </div>
      <div class="form-group">
        <select class="form-control" id="estatus" name="estatus" required>
          <option value="1" <?php if ($empleado['Vigente'] == 1)
            echo 'selected'; ?>>Activo</option>
          <option value="2" <?php if ($empleado['Vigente'] == 2)
            echo 'selected'; ?>>Inactivo</option>
        </select>
        <label for="estatus">Estatus</label>
      </div>
      <button type="submit" class="submit">Actualizar</button>
    </form>
    <script src="empleados/../../../../JS/registro-nota.js"></script>
  </section>
  <footer class="footer">
    <a href="buscar.php" class="btn_salir">Regresar</a>
    <a href="empleados/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>