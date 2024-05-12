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
      <h1>ACTUALIZACIÓN DE CLIENTES</h1>
    </div>
  </section>
  <section class="options">
    <form action="" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="nom-clientes">Primer nombre:</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" />
        <label for="nom-clientes">Segundo nombre (opcional):</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="ap-clientes">Primer apellido:</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="ap-clientes">Segundo apellido:</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="calle-clientes">Calle:</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" required />
        <label for="calle-clientes">Número exterior:</label>
      </div>
      <div class="form-group">
        <input type="tel" id="folio" class="form-control" required />
        <label for="Tel-clientes">Número de teléfono:</label>
      </div>
      <button type="submit" class="submit">Actualizar</button>
    </form>
    <script src="../../JS/registro-nota.js"></script>
  </section>
  <footer class="footer">
    <a href="../cliente.php" class="btn_salir">Regresar</a>
    <a href="clientes/../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>