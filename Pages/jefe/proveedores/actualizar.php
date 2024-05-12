<?php
include ("proveedores/../../../../php/final_sesion.php");
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
  <title>Proveedores</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>REGISTRO DE PROVEEDORES</h1>
    </div>
  </section>
  <section class="options">
    <form action="" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="text" class="form-control" />
        <label for="tel-clientes">Nombre</label>
      </div>
      <div class="form-group">
        <input type="tel" class="form-control" required />
        <label for="tel-clientes">Teléfono principal</label>
      </div>
      <div class="form-group">
        <input type="tel" class="form-control" required />
        <label for="tel-clientes">Teléfono secundario</label>
      </div>
      <div class="form-group">
        <input type="email" class="form-control" required />
        <label for="contacto">Correo electrónico</label>
      </div>
      <div class="form-group">
        <select class="form-control" required>
          <option value="1">Transferencia</option>
          <option value="2">Efectivo</option>
        </select>
        <label for="Servicio">Método de pago</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="contacto">Catalogo que ofrece</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="contacto">Calle</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="contacto">Número</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="contacto">Colonia</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" required />
        <label for="contacto">Código postal</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" required />
        <label for="contacto">Alcaldia/Municipio</label>
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
    <a href="../proveedores/proveedores.php" class="btn_salir">Regresar</a>
    <a href="proveedores/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>