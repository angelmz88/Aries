<?php
include ("notas/../../../php/deep_sesion.php");
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
  <title>Notas</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>NUEVA NOTA</h1>
    </div>
  </section>
  <section class="options">
    <form action="" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="tel" class="form-control" required />
        <label for="tel-clientes">Contacto del cliente:</label>
      </div>
      <div class="form-group">
        <select class="form-control" required>
          <option value="Lavado">Lavado</option>
          <option value="Planchado">Planchado</option>
          <option value="Lavado en seco">Lavado en seco</option>
          <option value="Teñido">Teñido</option>
          <option value="Reparcion">Reparcion</option>
        </select>
        <label for="Servicio">Tipo de servicio:</label>
      </div>
      <div class="form-group">
        <select class="form-control" required>
          <option value="Pantalon">Pantalon</option>
          <option value="Sudadera">Sudadera</option>
          <option value="Saco">Saco</option>
          <option value="Traje">Traje</option>
          <option value="Abrigo">Abrigo</option>
          <option value="Chamarra">Chamarra</option>
          <option value="Vestido de noche">Vestido de noche</option>
          <option value="Playera">Playera</option>
          <option value="Blusa">Blusa</option>
          <option value="Camisa">Camisa</option>
          <option value="Edredon">Edredon</option>
          <option value="Cobija">Cobija</option>
          <option value="Cobertor">Cobertor</option>
          <option value="Chaleco">Chaleco</option>
          <option value="Capa">Capa</option>
          <option value="Gabardina">Gabardina</option>
          <option value="Falda">Falda</option>
          <option value="Corbata">Corbata</option>
          <option value="Pans">Pans</option>
          <option value="Chalinas">Chalinas</option>
        </select>
        <label for="Servicio">Tipo de prendas</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" required />
        <label for="contacto">Número de prendas</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="contacto">Color de prendas</label>
      </div>
      <div class="form-group">
        <input type="date" class="form-control" required />
        <label for="fecha">Fecha de entrega</label>
      </div>
      <div class="form-group">
        <input type="time" class="form-control" required />
        <label for="tipo">Hora de entrega (estimada)</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" required />
        <label for="tipo">Precio total</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="tipo">Notas adicionales</label>
      </div>
      <button type="submit" class="submit">Guardar</button>
    </form>
    <script src="../../JS/registro-nota.js"></script>
  </section>
  <footer class="footer">
    <a href="../notas.php" class="btn_salir">Regresar</a>
    <a href="notas/../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $primer_Nombre = $_POST['nom-clientes'];
  $segundo_Nombre = $_POST['segundo-nom-clientes'];
  $primer_Apellido = $_POST['ap-clientes'];
  $segundo_Apellido = $_POST['segundo-ap-clientes'];
  $calle = $_POST['calle'];
  $numero = $_POST['numero'];
  $tel = $_POST['tel'];

  include ("clientes/../../../php/bd.php");

  // Consulta SQL de inserción
  $sql = "INSERT INTO clientes (Numero_Telefono_PK, Primer_Nombre, Segundo_Nombre, Primer_Apellido, Segundo_Apellido, Calle, Numero_Exterior) 
VALUES ('$tel','$primer_Nombre','$segundo_Nombre','$primer_Apellido','$segundo_Apellido','$calle','$numero')";
  // Ejecutar la consulta y verificar si fue exitosa
  if ($conn->query($sql) === TRUE) {
    echo '<script>';
    echo 'alert("Cliente registrado correctamente");';
    // echo 'window.location.href = "../index.php";'; // Redirige a otra_pagina.php después de que el usuario haga clic en "Aceptar"
    echo '</script>';
  } else {
    // echo "Error al insertar datos: " . $conn->error;
  }
}
?>

</html>