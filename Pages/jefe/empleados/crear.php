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
  <title>Empleados</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>REGISTRO DE EMPLEADOS</h1>
    </div>
  </section>
  <section class="options">
    <form action="crear.php" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" id="firstName" name='firstName' class="form-control" />
        <label for="firstName">Primer nombre</label>
      </div>
      <div class="form-group">
        <input type="text" id="name" name="name" class="form-control" />
        <label for="name">Segundo nombre</label>
      </div>
      <div class="form-group">
        <input type="text" id="secondName" name="secondName" class="form-control" required />
        <label for="secondName">Apellido paterno</label>
      </div>
      <div class="form-group">
        <input type="text" id="second" name="second" class="form-control" required />
        <label for="second">Apellido materno</label>
      </div>
      <div class="form-group">
        <input type="number" id="nss" name="nss" class="form-control" required />
        <label for="nss">Número de seguridad social</label>
      </div>
      <div class="form-group">
        <input type="number" id="salary" name="salary" class="form-control" required />
        <label for="salary">Salario</label>
      </div>
      <div class="form-group">
        <input type="tel" id="tel" name="tel" class="form-control" required />
        <label for="tel">Telefono</label>
      </div>
      <div class="form-group">
        <input type="email" id="mail" name="mail" class="form-control" required />
        <label for="mail">Correo electrónico</label>
      </div>
      <div class="form-group">
        <select class="form-control" id="nomina" name="nomina" required>
          <option value="Quincenal">Quincenal</option>
          <option value="Mensual">Mensual</option>
        </select>
        <label for="nomina">Tipo de nomina</label>
      </div>
      <div class="form-group">
        <select class="form-control" id="estatus" name="estatus" required>
          <option value="1">Activo</option>
          <option value="2">Inactivo</option>
        </select>
        <label for="estatus">Estatus</label>
      </div>
      <button type="submit" class="submit">Guardar</button>
    </form>
    <script src="../../JS/registro-nota.js"></script>
  </section>
  <footer class="footer">
    <a href="../empleados/empleados.php" class="btn_salir">Regresar</a>
    <a href="empleados/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numTelPk = $_POST['tel'];
    $primer_Nombre = $_POST['firstName'];
    $segundo_Nombre = $_POST['name'];
    $primer_Apellido = $_POST['secondName'];
    $segundo_Apellido = $_POST['second'];
    $correo_Electronico = $_POST['mail'];
    $nss = $_POST['nss'];
    $salario = $_POST['salary'];
    $nomina = $_POST['nomina'];
    $estatus = $_POST['estatus'];

    include ("empleados/../../../../php/bd.php");

    // Consulta SQL de inserción
    $sql = "INSERT INTO empleados (Numero_Telefono_PK, Primer_Nombre, Segundo_Nombre, Primer_Apellido, Segundo_Apellido, Correo_Electronico, Numero_Seguridad_Social, Salario, Tipo_Nomina, Vigente) 
VALUES ('$numTelPk', '$primer_Nombre', '$segundo_Nombre', '$primer_Apellido', '$segundo_Apellido', '$correo_Electronico', '$nss', $salario, '$nomina', $estatus)";
    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
      echo '<script>';
      echo 'alert("Empleado registrado correctamente");';
      // echo 'window.location.href = "../index.php";'; // Redirige a otra_pagina.php después de que el usuario haga clic en "Aceptar"
      echo '</script>';
    } else {
      // echo "Error al insertar datos: " . $conn->error;
    }
  }
  ?>
</body>

</html>