<?php
include ("pages/../../php/sesion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/normalize.css" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/menu.css" />
  <link rel="stylesheet" href="../css/menu-modify.css" />
  <link rel="shortcut icon" href="../img/global/lavanderia.png" />
  <title>Empleado</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
    <nav class="nav">
      <ul class="nav-ul">
        <li>
          <a href="../Pages/jefe/inventario/inventario.html">INVENTARIO</a>
        </li>
        <li>
          <a href="../Pages/jefe/empleados/empleados.html">EMPLEADOS</a>
        </li>
        <li>
          <a href="../Pages/jefe/proveedores/proveedores.html">PROVEEDORES</a>
        </li>
      </ul>
    </nav>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>¡Bienvenido!</h1>
      <h2>¿Qué deseas consultar hoy?</h2>
    </div>
  </section>
  <section class="options">
    <a href="../Pages/jefe/inventario/inventario.php" class="option-card">
      <div class="card-item">
        <img src="../img/jefe/inventario.png" alt="Nota" />
        <h3>INVENTARIO</h3>
      </div>
    </a>
    <a href="../Pages/jefe/empleados/empleados.php" class="option-card">
      <div class="card-item">
        <img src="../img/jefe/empleados.png" alt="Cliente" />
        <h3>EMPLEADOS</h3>
      </div>
    </a>
    <a href="../Pages/jefe/proveedores/proveedores.php" class="option-card">
      <div class="card-item">
        <img src="../img/jefe/proveedores.png" alt="Inventario" />
        <h3>PROVEEDORES</h3>
      </div>
    </a>
  </section>
  <footer class="footer">
    <a href="notas/../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>