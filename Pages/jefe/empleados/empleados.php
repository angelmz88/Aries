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
  <link rel="stylesheet" href="../../../css/menu.css" />
  <link rel="stylesheet" href="../../../css/img-inventario.css" />
  <link rel="shortcut icon" href="../../../img/global/lavanderia.png" />
  <title>Empleados</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
    <nav class="nav">
      <ul class="nav-ul">
        <li><a href="../empleados/crear.php">AGREGAR</a></li>
        <li><a href="../empleados/buscar.php">CONSULTAR</a></li>
      </ul>
    </nav>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>Empleados</h1>
    </div>
  </section>
  <section class="options">
    <a href="../empleados/crear.php" class="option-card">
      <div class="card-item">
        <img src="../../../img/nota/crear.png" alt="Buscar nota" />
        <h3>AGREGAR</h3>
      </div>
    </a>
    <a href="../empleados/buscar.php" class="option-card">
      <div class="card-item">
        <img src="../../../img/nota/buscar.png" alt="Buscar nota" />
        <h3>CONSULTAR</h3>
      </div>
    </a>
  </section>
  <footer class="footer">
    <a href="../../jefe.php" class="btn_salir">Regresar</a>
    <a href="empleados/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>