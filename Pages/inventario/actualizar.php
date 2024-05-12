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
  <title>Inventario</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>ACTUALIZACIÓN DE INVENTARIO</h1>
    </div>
  </section>
  <section class="options">
    <form action="" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="nom-clientes">Clave del producto</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" />
        <label for="nom-clientes">Nombre del producto</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" required />
        <label for="piezas">Piezas</label>
      </div>
      <button type="submit" class="submit">Actualizar</button>
    </form>
    <script src="../../JS/registro-nota.js"></script>
  </section>
  <footer class="footer">
    <a href="../cliente.php" class="btn_salir">Regresar</a>
    <a href="inventario/../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>