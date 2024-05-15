<?php
include ("clientes/../../../php/deep_sesion.php");
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
      <h1>REGISTRO DE CLIENTES</h1>
    </div>
  </section>
  <section class="options">
    <form action="alta.php" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" class="form-control" id="nom-clientes" name="nom-clientes" required />
        <label for="nom-clientes">Primer nombre:</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="segundo-nom-clientes" name="segundo-nom-clientes" />
        <label for="segundo-nom-clientes">Segundo nombre (opcional):</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="ap-clientes" name="ap-clientes" required />
        <label for="ap-clientes">Primer apellido:</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="segundo-ap-clientes" name="segundo-ap-clientes" required />
        <label for="segundo-ap-clientes">Segundo apellido:</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="calle" name="calle" required />
        <label for="calle">Calle:</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="numero" name="numero" required />
        <label for="numero">Número exterior:</label>
      </div>
      <div class="form-group">
        <input type="tel" id="tel" class="form-control" name="tel" required />
        <label for="tel">Número de teléfono:</label>
      </div>
      <button type="submit" class="submit">Guardar</button>
    </form>
    <!-- <script src="../../JS/registro-nota.js"></script> -->
  </section>
  <footer class="footer">
    <a href="../cliente.php" class="btn_salir">Regresar</a>
    <a href="clientes/../../../php/salir.php" class="btn_salir">Salir</a>
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