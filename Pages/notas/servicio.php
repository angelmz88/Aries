<?php
include ("notas/../../../php/deep_sesion.php");
include ("notas/../../../php/bd.php");

// Función para obtener los datos de la base de datos
function obtenerexternos($term = '')
{
  global $conn;
  $sql = "SELECT * FROM tenido_reparacion";
  if ($term != '') {
    $sql .= " WHERE Folio_Nota_PK_FK LIKE '%$term%' OR Cantidad_Prendas_PK LIKE '%$term%' OR Tipo_Servicio LIKE '%$term%' 
    OR Telefono_Colaborador_FK LIKE '%$term%' OR Estatus LIKE '%$term%'";
  }
  $result = $conn->query($sql);

  $externos = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $externos[] = $row;
    }
  }
  return $externos;
}

// Inicializar la variable $externos para evitar errores
$externos = array();

// Si es una solicitud AJAX, devolver los resultados en JSON
if (isset($_GET['term'])) {
  header('Content-Type: application/json'); // Asegura que el contenido sea JSON
  $term = $_GET['term'];
  $externos = obtenerexternos($term);
  echo json_encode($externos);
  $conn->close();
  exit();
}

// Obtener todas las externos al cargar la página
$externos = obtenerexternos();
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
  <title>externos</title>
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
            var tableContent = '<table><tr><th>Folio Nota</th><th>Tipo de Servicio</th><th>Telefono Colaborador</th><th>Estatus</th></tr>';
            if (data.length > 0) {
              $.each(data, function (index, externo) {
                tableContent += '<tr><td>' + externo.Folio_externo_PK + '</td><td>' + externo.Tipo_Servicio + '</td><td>' + externo.Telefono_Colaborador_FK +
                  '</td><td>' + externo.Estatus + '</td></tr>';
              });
            } else {
              tableContent += '<tr><td colspan="6">No se encontraron resultados</td></tr>';
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
      <h1>CONSULTAR externoS</h1>
    </div>
  </section>
  <section class="options">
    <div class="buscador">
      <input type="text" id="search" placeholder="Buscar externo..." />
    </div>
  </section>
  <section id="resultados" class="resultados">
    <table class="table">
      <tr>
        <th>Folio Nota</th>
        <th>Tipo de Servicio</th>
        <th>Telefono Colaborador</th>
        <th>Estatus</th>
      </tr>
      <?php if (count($externos) > 0): ?>
        <?php foreach ($externos as $externo): ?>
          <tr>
            <td><?php echo $externo["Folio_Nota_PK_FK"]; ?></td>
            <td><?php echo $externo["Tipo_Servicio"]; ?></td>
            <td><?php echo $externo["Telefono_Colaborador_FK"]; ?></td>
            <td><?php echo $externo["Estatus"]; ?></td>
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