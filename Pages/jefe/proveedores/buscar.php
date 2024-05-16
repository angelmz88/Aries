<?php
include ("proveedores/../../../../php/final_sesion.php");
include ("proveedores/../../../../php/bd.php");

// Función para obtener los datos de la base de datos
function obtenerProveedores($term = '')
{
  global $conn;
  $sql = "SELECT * FROM proveedores";
  if ($term != '') {
    $sql .= " WHERE Nombre_Distribuidora_PK LIKE '%$term%' OR Telefono_Principal LIKE '%$term%' OR Telefono_Alterno LIKE '%$term%' 
    OR Correo_Electronico LIKE '%$term%' OR Metodo_Pago LIKE '%$term%' OR Catalogo_Producto LIKE '%$term%' OR Calle
    LIKE '%$term%' OR Numero_Exterior LIKE '%$term%' OR Colonia LIKE '%$term%' OR Codigo_Postal LIKE '%$term%' OR Municipio LIKE '%$term%' OR Estado LIKE '%$term%'";
  }
  $result = $conn->query($sql);

  $proveedores = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $proveedores[] = $row;
    }
  }
  return $proveedores;
}

// Inicializar la variable $proveedores para evitar errores
$proveedores = array();

// Si es una solicitud AJAX, devolver los resultados en JSON
if (isset($_GET['term'])) {
  header('Content-Type: application/json'); // Asegura que el contenido sea JSON
  $term = $_GET['term'];
  $proveedores = obtenerProveedores($term);
  echo json_encode($proveedores);
  $conn->close();
  exit();
}

// Obtener todos los proveedores al cargar la página
$proveedores = obtenerProveedores();
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
  <title>Proveedores</title>
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
            var tableContent = '<table><tr><th>Distribuidora</th><th>Telefono Principal</th><th>Telefono Alterno</th><th>Correo Electronico</th><th>Metodo de Pago</th><th>Catalogo</th><th>Calle</th><th>Numero Exterior</th><th>Colonia</th><th>C.P.</th><th>Municipio</th><th>Estado</th><th>Acciones</th></tr>';
            if (data.length > 0) {
              $.each(data, function (index, proveedor) {
                tableContent += '<tr><td>' + proveedor.Nombre_Distribuidora_PK + '</td><td>' + proveedor.Telefono_Principal +
                  '</td><td>' + proveedor.Telefono_Alterno + '</td><td>' + proveedor.Correo_Electronico +
                  '</td><td>' + proveedor.Metodo_Pago + '</td><td>' + proveedor.Catalogo_Producto +
                  '</td><td>' + proveedor.Calle + '</td><td>' + proveedor.Numero_Exterior +
                  '</td><td>' + proveedor.Colonia + '</td><td>' + proveedor.Codigo_Postal + '</td><td>' + proveedor.Municipio +
                  '</td><td>' + proveedor.Estado + '</td><td><a href="actualizar.php?Nombre_Distribuidora_PK=' + proveedor.Nombre_Distribuidora_PK + '">Editar</a></td></tr>';
              });
            } else {
              tableContent += '<tr><td colspan="13">No se encontraron resultados</td></tr>';
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
      <h1>CONSULTAR PROVEEDOR</h1>
    </div>
  </section>
  <section class="options">
    <div class="buscador">
      <input type="text" id="search" placeholder="Buscar proveedor..." />
    </div>
  </section>
  <section id="resultados" class="resultados">
    <table class="table">
      <tr>
        <th>Distribuidora</th>
        <th>Telefono Principal</th>
        <th>Telefono Alterno</th>
        <th>Correo Electronico</th>
        <th>Metodo de Pago</th>
        <th>Catalogo</th>
        <th>Calle</th>
        <th>Numero Exterior</th>
        <th>Colonia</th>
        <th>C.P.</th>
        <th>Municipio</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
      <?php if (count($proveedores) > 0): ?>
        <?php foreach ($proveedores as $proveedor): ?>
          <tr>
            <td><?php echo $proveedor["Nombre_Distribuidora_PK"]; ?></td>
            <td><?php echo $proveedor["Telefono_Principal"]; ?></td>
            <td><?php echo $proveedor["Telefono_Alterno"]; ?></td>
            <td><?php echo $proveedor["Correo_Electronico"]; ?></td>
            <td><?php echo $proveedor["Metodo_Pago"]; ?></td>
            <td><?php echo $proveedor["Catalogo_Producto"]; ?></td>
            <td><?php echo $proveedor["Calle"]; ?></td>
            <td><?php echo $proveedor["Numero_Exterior"]; ?></td>
            <td><?php echo $proveedor["Colonia"]; ?></td>
            <td><?php echo $proveedor["Codigo_Postal"]; ?></td>
            <td><?php echo $proveedor["Municipio"]; ?></td>
            <td><?php echo $proveedor["Estado"]; ?></td>
            <td><a
                href="actualizar.php?Nombre_Distribuidora_PK=<?php echo $proveedor['Nombre_Distribuidora_PK']; ?>">Editar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="13">No se encontraron resultados</td>
        </tr>
      <?php endif; ?>
    </table>
  </section>
  <footer class="footer">
    <a href="../proveedores/proveedores.php" class="btn_salir">Regresar</a>
    <a href="proveedores/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>