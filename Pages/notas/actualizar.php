<?php
include ("notas/../../../php/sesion.php");
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
      <h1>ACTUALIZACIÓN</h1>
    </div>
  </section>
  <section class="options">
    <form action="" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" id="folio" class="form-control" />
        <label for="folio">Folio:</label>
      </div>
      <div class="form-group">
        <input type="tel" class="form-control" required />
        <label for="tel-clientes">Contacto del cliente:</label>
      </div>
      <div class="form-group">
        <select class="form-control" required>
          <option value="1">Lavado</option>
          <option value="2">Planchado</option>
          <option value="3">Secado</option>
        </select>
        <label for="Servicio">Tipo de servicio:</label>
      </div>
      <div class="form-group">
        <select class="form-control" required>
          <option value="1">Lavado</option>
          <option value="2">Planchado</option>
          <option value="3">Secado</option>
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
      <button type="submit" class="submit">Actualizar</button>
    </form>
    <script src="../../JS/registro-nota.js"></script>
  </section>
  <footer class="footer">
    <a href="../notas.php" class="btn_salir">Regresar</a>
    <a href="notas/../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>