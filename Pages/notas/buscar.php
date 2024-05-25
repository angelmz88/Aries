<?php
// Incluir archivos necesarios y funciones
include ("notas/../../../php/deep_sesion.php");
include ("notas/../../../php/bd.php");

// Función para obtener los datos de la base de datos
function obtenerNotas($term = '')
{
  global $conn;
  $sql = "SELECT * FROM notas";
  if ($term != '') {
    $sql .= " WHERE Folio_Nota_PK LIKE '%$term%' OR Numero_Telefono_Cliente_FK LIKE '%$term%' OR Numero_Telefono_Empleado_FK LIKE '%$term%' 
        OR Tipo_Servicio LIKE '%$term%' OR Fecha_Entrega_Estimada LIKE '%$term%' OR Hora_Entrega_Estimada LIKE '%$term%'";
  }
  $sql .= " ORDER BY Folio_Nota_PK DESC"; // Asegúrate de que la ordenación sea la última parte de la consulta
  $result = $conn->query($sql);

  $notas = array();

  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $notas[] = $row;
    }
  }
  return $notas;
}

// Inicializar la variable $notas para evitar errores
$notas = array();

// Si es una solicitud AJAX, devolver los resultados en JSON
if (isset($_GET['term'])) {
  header('Content-Type: application/json'); // Asegura que el contenido sea JSON
  $term = $_GET['term'];
  $notas = obtenerNotas($term);
  echo json_encode($notas);
  $conn->close();
  exit();
}

// Obtener todas las notas al cargar la página
$notas = obtenerNotas();
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
  <title>Notas</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#search').on('keyup', function () {
        var searchTerm = $(this).val();
        $.ajax({
          url: '', // La URL actual
          type: 'GET',
          data: { term: searchTerm },
          dataType: 'json',
          success: function (data) {
            var tableContent = '<table><tr><th>Folio Nota</th><th>Telefono Cliente</th><th>Telefono Empleado</th><th>Tipo Servicio</th><th>Fecha Entrega Estimada</th><th>Hora Entrega Estimada</th><th>Acciones</th></tr>';
            if (data.length > 0) {
              $.each(data, function (index, nota) {
                tableContent += '<tr><td>' + nota.Folio_Nota_PK + '</td><td>' + nota.Numero_Telefono_Cliente_FK +
                  '</td><td>' + nota.Numero_Telefono_Empleado_FK + '</td><td>' + nota.Tipo_Servicio +
                  '</td><td>' + nota.Fecha_Entrega_Estimada + '</td><td>' + nota.Hora_Entrega_Estimada +
                  '</td><td><a href="seguimiento.php?Folio_Nota_PK=' + nota.Folio_Nota_PK + '">Seguimiento</a><a href="imprimir.php?Folio_Nota_PK=' + nota.Folio_Nota_PK + '">Imprimir</a></td></tr>';
              });
            } else {
              tableContent += '<tr><td colspan="7">No se encontraron resultados</td></tr>';
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
      <h1>CONSULTAR NOTAS</h1>
    </div>
  </section>
  <section class="options">
    <div class="buscador">
      <input type="text" id="search" placeholder="Buscar nota..." />
    </div>
  </section>
  <section id="resultados" class="resultados">
    <table class="table">
      <tr>
        <th>Folio Nota</th>
        <th>Telefono Cliente</th>
        <th>Telefono Empleado</th>
        <th>Tipo Servicio</th>
        <th>Fecha Entrega Estimada</th>
        <th>Hora Entrega Estimada</th>
        <th>Acciones</th>
      </tr>
      <?php if (count($notas) > 0): ?>
        <?php foreach ($notas as $nota): ?>
          <tr>
            <td><?php echo $nota["Folio_Nota_PK"]; ?></td>
            <td><?php echo $nota["Numero_Telefono_Cliente_FK"]; ?></td>
            <td><?php echo $nota["Numero_Telefono_Empleado_FK"]; ?></td>
            <td><?php echo $nota["Tipo_Servicio"]; ?></td>
            <td><?php echo $nota["Fecha_Entrega_Estimada"]; ?></td>
            <td><?php echo $nota["Hora_Entrega_Estimada"]; ?></td>
            <td><a href="seguimiento.php?Folio_Nota_PK=<?php echo $nota['Folio_Nota_PK']; ?>">Seguimiento</a><a
                href="imprimir.php?Folio_Nota_PK=<?php echo $nota['Folio_Nota_PK']; ?>">Imprimir</a></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="7">No se encontraron resultados</td>
        </tr>
      <?php endif; ?>
    </table>
  </section>
  <footer class="footer">
    <a href="../notas.php" class="btn_salir">Regresar</a>
    <a href="notas/../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>