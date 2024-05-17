<?php
include ("empleados/../../../php/deep_sesion.php");
include ("empleados/../../../php/bd.php");
// Verificar si se ha pasado un ID en la URL
if (isset($_GET['Numero_Telefono_PK'])) {
  $id = $_GET['Numero_Telefono_PK'];
  $id_string = strval($id);
  // Preparar la consulta para obtener los datos del registro
  $sql = "SELECT * FROM clientes WHERE Numero_Telefono_PK = '$id_string'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Obtener los datos del registro
    $cliente = $result->fetch_assoc();
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
  <title>Cliente</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>ACTUALIZACIÓN DE CLIENTES</h1>
    </div>
  </section>
  <section class="options">
    <form action="editar.php" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" class="form-control" id="nom-clientes" name="nom-clientes"
          value="<?php echo $cliente['Primer_Nombre']; ?>" required />
        <label for="nom-clientes">Primer nombre:</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="segundo-nom-clientes" name="segundo-nom-clientes"
          value="<?php echo $cliente['Segundo_Nombre']; ?>" />
        <label for="segundo-nom-clientes">Segundo nombre (opcional):</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="ap-clientes" name="ap-clientes"
          value="<?php echo $cliente['Primer_Apellido']; ?>" required />
        <label for="ap-clientes">Primer apellido:</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="segundo-ap-clientes" name="segundo-ap-clientes"
          value="<?php echo $cliente['Segundo_Apellido']; ?>" required />
        <label for="segundo-ap-clientes">Segundo apellido:</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="calle" name="calle" value="<?php echo $cliente['Calle']; ?>"
          required />
        <label for="calle">Calle:</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="numero" name="numero"
          value="<?php echo $cliente['Numero_Exterior']; ?>" required />
        <label for="numero">Número exterior:</label>
      </div>
      <div class="form-group">
        <input type="tel" id="tel" name="tel" class="form-control" value="<?php echo $cliente['Numero_Telefono_PK']; ?>"
          disabled />
        <input type="hidden" id="tel" name="tel" class="form-control"
          value="<?php echo $cliente['Numero_Telefono_PK']; ?>" />
        <label for="tel">Número de teléfono:</label>
      </div>
      <button type="submit" class="submit">Actualizar</button>
    </form>
  </section>
  <footer class="footer">
    <a href="consultar.php" class="btn_salir">Regresar</a>
    <a href="clientes/../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>