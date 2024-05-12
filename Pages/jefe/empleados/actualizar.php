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
    <form action="" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" id="folio" class="form-control" disabled />
        <label for="folio">Primer nombre</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" />
        <label for="tel-clientes">Segundo nombre</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="tel-clientes">Apellido paterno</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="tel-clientes">Apellido materno</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" required />
        <label for="contacto">Número de seguridad social</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" required />
        <label for="contacto">Salario</label>
      </div>
      <div class="form-group">
        <input type="tel" class="form-control" required />
        <label for="contacto">Telefono</label>
      </div>
      <div class="form-group">
        <select class="form-control" required>
          <option value="1">Quincenal</option>
          <option value="2">Mensual</option>
        </select>
        <label for="Servicio">Tipo de nomina</label>
      </div>
      <div class="form-group">
        <select class="form-control" required>
          <option value="1">Activo</option>
          <option value="2">Inactivo</option>
        </select>
        <label for="Servicio">Estatus</label>
      </div>
      <button type="submit" class="submit">Actualizar</button>
    </form>
    <script src="../../JS/registro-nota.js"></script>
  </section>
  <footer class="footer">
    <a href="../empleados/empleados.php" class="btn_salir">Regresar</a>
    <a href="empleados/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>