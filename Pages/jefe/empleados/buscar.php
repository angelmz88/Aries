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
  <link rel="stylesheet" href="../../../css/consulta.css" />
  <link rel="shortcut icon" href="../../../img/global/lavanderia.png" />
  <title>Empleados</title>
</head>

<>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>CONSULTAR</h1>
    </div>
  </section>
  <section class="options">
    <div class="buscador">
      <input type="text" />
    </div>
  </section>
  <section>
    <?php
    include ("empleados/../../../../php/bd.php");
    $sql = "SELECT * FROM empleados";
    $result = $conn->query($sql);

    // Mostrar los datos
    if ($result->num_rows > 0) {
      // Mostrar los datos en una tabla HTML
      echo "<table border='1'>";
      echo "<tr><th>Telefono</th><th>Primer nombre</th><th>Segundo nombre</th><th>Primer apellido</th><th>Segundo apellido</th><th>Correo electrónico</th><th>Número de seguro social</th><th>Salario</th><th>Nomina</th><th>Estatus</th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Numero_Telefono_PK"] . "</td><td>" . $row["Primer_Nombre"] . "</td><td>" . $row["Segundo_Nombre"] . "</td><td>" . $row["Primer_Apellido"] . "</td><td>" . $row["Segundo_Apellido"] . "</td><td>" . $row["Correo_Electronico"] . "</td><td>" . $row["Numero_Seguridad_Social"] . "</td><td>" . $row["Salario"] . "</td><td>" . $row["Tipo_Nomina"] . "</td><td>" . $row["Vigente"] . "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "No se encontraron resultados";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
  </section>
  <footer class="footer">
    <a href="../empleados/empleados.php" class="btn_salir">Regresar</a>
    <a href="empleados/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
  </body>

</html>