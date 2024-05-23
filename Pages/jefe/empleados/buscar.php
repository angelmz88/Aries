<?php
include ("empleados/../../../../php/final_sesion.php");
include ("empleados/../../../../php/bd.php");

// Función para obtener los datos de la base de datos
function obtenerEmpleados($term = '')
{
  global $conn;
  $sql = "SELECT * FROM empleados";
  if ($term != '') {
    $sql .= " WHERE Numero_Telefono_PK LIKE '%$term%' OR Primer_Nombre LIKE '%$term%' OR Segundo_Nombre LIKE '%$term%' 
    OR Primer_Apellido LIKE '%$term%' OR Segundo_Apellido LIKE '%$term%' OR Correo_Electronico LIKE '%$term%' OR Numero_Seguridad_Social 
    LIKE '%$term%' OR Salario LIKE '%$term%' OR Tipo_Nomina LIKE '%$term%' OR Vigente LIKE '%$term%' OR Tipo_Empleado LIKE '%$term%'";
  }
  $result = $conn->query($sql);

  $empleados = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $empleados[] = $row;
    }
  }
  return $empleados;
}

// Si es una solicitud AJAX, devolver los resultados en JSON
if (isset($_GET['term'])) {
  header('Content-Type: application/json'); // Asegura que el contenido sea JSON
  $term = $_GET['term'];
  $empleados = obtenerEmpleados($term);
  echo json_encode($empleados);
  $conn->close();
  exit();
}

// Obtener todos los empleados al cargar la página
$empleados = obtenerEmpleados();
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#search').on('keyup', function () {
        var searchTerm = $(this).val();
        $.ajax({
          url: '',
          type: 'GET',
          data: { term: searchTerm },
          dataType: 'json',
          success: function (data) {
            var tableContent = '<table><tr><th>Telefono</th><th>Primer nombre</th><th>Segundo nombre</th><th>Primer apellido</th><th>Segundo apellido</th><th>Correo electrónico</th><th>Número de seguro social</th><th>Salario</th><th>Nomina</th><th>Estatus</th><th>Tipo</th><th>Acciones</th></tr>';
            if (data.length > 0) {
              $.each(data, function (index, empleado) {
                let vigenteText = empleado.Vigente == 1 ? "Si" : "No";
                tableContent += '<tr><td>' + empleado.Numero_Telefono_PK + '</td><td>' + empleado.Primer_Nombre +
                  '</td><td>' + empleado.Segundo_Nombre + '</td><td>' + empleado.Primer_Apellido +
                  '</td><td>' + empleado.Segundo_Apellido + '</td><td>' + empleado.Correo_Electronico +
                  '</td><td>' + empleado.Numero_Seguridad_Social + '</td><td>' + empleado.Salario +
                  '</td><td>' + empleado.Tipo_Nomina + '</td><td>' + vigenteText + '</td><td>' + empleado.Tipo_Empleado +
                  '</td><td><a href="actualizar.php?Numero_Telefono_PK=' + empleado.Numero_Telefono_PK + '">Editar</a></td></tr>';
              });
            } else {
              tableContent += '<tr><td colspan="12">No se encontraron resultados</td></tr>';
            }
            tableContent += '</table>';
            $('#resultados').html(tableContent);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });
      });
    });
  </script>
</head>
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
    <input type="text" id="search" placeholder="Buscar empleado..." />
  </div>
</section>
<section id="resultados" class="resultados">
  <table class="table">
    <tr>
      <th>Telefono</th>
      <th>Primer nombre</th>
      <th>Segundo nombre</th>
      <th>Primer apellido</th>
      <th>Segundo apellido</th>
      <th>Correo electrónico</th>
      <th>Número de seguro social</th>
      <th>Salario</th>
      <th>Nomina</th>
      <th>Estatus</th>
      <th>Tipo</th>
      <th>Acciones</th>
    </tr>
    <?php if (count($empleados) > 0): ?>
      <?php foreach ($empleados as $empleado): ?>
        <tr>
          <td><?php echo $empleado["Numero_Telefono_PK"]; ?></td>
          <td><?php echo $empleado["Primer_Nombre"]; ?></td>
          <td><?php echo $empleado["Segundo_Nombre"]; ?></td>
          <td><?php echo $empleado["Primer_Apellido"]; ?></td>
          <td><?php echo $empleado["Segundo_Apellido"]; ?></td>
          <td><?php echo $empleado["Correo_Electronico"]; ?></td>
          <td><?php echo $empleado["Numero_Seguridad_Social"]; ?></td>
          <td><?php echo $empleado["Salario"]; ?></td>
          <td><?php echo $empleado["Tipo_Nomina"]; ?></td>
          <td><?php if ($empleado['Vigente'] == 1) {
            echo "Activo";
          } else {
            echo "Inactivo";
          } ?></td>
          <td><?php echo $empleado["Tipo_Empleado"]; ?></td>
          <td><a href="actualizar.php?Numero_Telefono_PK=<?php echo $empleado['Numero_Telefono_PK']; ?>">Editar</a></td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="12">No se encontraron resultados</td>
      </tr>
    <?php endif; ?>
  </table>
</section>
<footer class="footer">
  <a href="../empleados/empleados.php" class="btn_salir">Regresar</a>
  <a href="empleados/../../../../php/salir.php" class="btn_salir">Salir</a>
</footer>
</body>

</html>