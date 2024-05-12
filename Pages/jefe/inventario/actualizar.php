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
  <title>Inventario</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>EDITAR PRODUCTO</h1>
    </div>
  </section>
  <section class="options">
    <form action="" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" id="folio" class="form-control" disabled />
        <label for="folio">ID del Producto</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="tel-clientes">Nombre del Producto</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" required />
        <label for="contacto">Número de prendas</label>
      </div>
      <div class="form-group">
        <select class="form-control" required>
          <option value="1">Lavado</option>
          <option value="2">Planchado</option>
          <option value="3">Secado</option>
        </select>
        <label for="Servicio">Unidad de medida</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="fecha">Descripción</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" required />
        <label for="tipo">Precio unitario</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" required />
        <label for="tipo">Stock minimo para las alertas</label>
      </div>
      <button type="submit" class="submit">Actualizar</button>
    </form>
    <script src="../../JS/registro-nota.js"></script>
  </section>
  <footer class="footer">
    <a href="../inventario/inventario.php" class="btn_salir">Regresar</a>
    <a href="inventario/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>