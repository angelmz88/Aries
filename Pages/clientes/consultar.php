<?php
include ("clientes/../../../php/deep_sesion.php");
include ("clientes/../../../php/bd.php");

// Función para obtener los datos de la base de datos
function obtenerClientes($term = '')
{
  global $conn;
  $sql = "SELECT * FROM clientes";
  if ($term != '') {
    $sql .= " WHERE Numero_Telefono_PK LIKE '%$term%' OR Primer_Nombre LIKE '%$term%' OR Segundo_Nombre LIKE '%$term%' 
    OR Primer_Apellido LIKE '%$term%' OR Segundo_Apellido LIKE '%$term%' OR Calle LIKE '%$term%' OR Numero_Exterior LIKE '%$term%'";
  }
  $result = $conn->query($sql);

  $clientes = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $clientes[] = $row;
    }
  }
  return $clientes;
}

// Inicializar la variable $clientes para evitar errores
$clientes = array();

// Si es una solicitud AJAX, devolver los resultados en JSON
if (isset($_GET['term'])) {
  header('Content-Type: application/json'); // Asegura que el contenido sea JSON
  $term = $_GET['term'];
  $clientes = obtenerClientes($term);
  echo json_encode($clientes);
  $conn->close();
  exit();
}

// Obtener todos los clientes al cargar la página
$clientes = obtenerClientes();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/normalize.css" />
  <link rel="stylesheet" href="../../css/style.css" />
  <link rel="stylesheet" href="../../css/consulta.css" />
  <link rel="shortcut icon" href="../../img/global/lavanderia.png" />
  <title>Clientes</title>
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
            var tableContent = '<table><tr><th>Telefono</th><th>Primer Nombre</th><th>Segundo Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Calle</th><th>Numero Exterior</th><th>Acciones</th></tr>';
            if (data.length > 0) {
              $.each(data, function (index, cliente) {
                tableContent += '<tr><td>' + cliente.Numero_Telefono_PK + '</td><td>' + cliente.Primer_Nombre +
                  '</td><td>' + cliente.Segundo_Nombre + '</td><td>' + cliente.Primer_Apellido +
                  '</td><td>' + cliente.Segundo_Apellido + '</td><td>' + cliente.Calle +
                  '</td><td>' + cliente.Numero_Exterior + '</td><td><a href="actualizar.php?Numero_Telefono_PK=' + cliente.Numero_Telefono_PK + '">Editar</a></td></tr>';
              });
            } else {
              tableContent += '<tr><td colspan="8">No se encontraron resultados</td></tr>';
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

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>CONSULTAR CLIENTES</h1>
    </div>
  </section>
  <section class="options">
    <div class="buscador">
      <input type="text" id="search" placeholder="Buscar cliente..." />
    </div>
  </section>
  <section id="resultados" class="resultados">
    <table class="table">
      <tr>
        <th>Telefono</th>
        <th>Primer Nombre</th>
        <th>Segundo Nombre</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
        <th>Calle</th>
        <th>Numero Exterior</th>
        <th>Acciones</th>
      </tr>
      <?php if (count($clientes) > 0): ?>
        <?php foreach ($clientes as $cliente): ?>
          <tr>
            <td><?php echo $cliente["Numero_Telefono_PK"]; ?></td>
            <td><?php echo $cliente["Primer_Nombre"]; ?></td>
            <td><?php echo $cliente["Segundo_Nombre"]; ?></td>
            <td><?php echo $cliente["Primer_Apellido"]; ?></td>
            <td><?php echo $cliente["Segundo_Apellido"]; ?></td>
            <td><?php echo $cliente["Calle"]; ?></td>
            <td><?php echo $cliente["Numero_Exterior"]; ?></td>
            <td><a href="actualizar.php?Numero_Telefono_PK=<?php echo $cliente['Numero_Telefono_PK']; ?>">Editar</a></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="8">No se encontraron resultados</td>
        </tr>
      <?php endif; ?>
    </table>
  </section>
  <footer class="footer">
    <a href="../cliente.php" class="btn_salir">Regresar</a>
    <a href="clientes/../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>