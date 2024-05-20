<?php
include ("empleados/../../../../php/final_sesion.php");
include ("empleados/../../../../php/bd.php");

// Función para obtener los datos de la base de datos
function obtenerProductos($term = '')
{
  global $conn;
  $sql = "SELECT * FROM productos";
  if ($term != '') {
    $sql .= " WHERE Clave_Producto_PK LIKE '%$term%' OR Nombre_Producto LIKE '%$term%' OR Piezas LIKE '%$term%' 
    OR UM LIKE '%$term%' OR Descripcion_Producto LIKE '%$term%' OR Precio_Unitario LIKE '%$term%' 
    OR Stock_Minimo LIKE '%$term%'";
  }
  $result = $conn->query($sql);

  $productos = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $productos[] = $row;
    }
  }
  return $productos;
}

// Si es una solicitud AJAX, devolver los resultados en JSON
if (isset($_GET['term'])) {
  $term = $_GET['term'];
  $productos = obtenerProductos($term);
  echo json_encode($productos);
  $conn->close();
  exit();
}

// Obtener todos los productos al cargar la página
$productos = obtenerProductos();
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
  <title>Inventario</title>
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
            var tableContent = '<table><tr><th>Clave</th><th>Nombre</th><th>Piezas</th><th>UM</th><th>Descripción</th><th>Precio unitario</th><th>Alerta de stock</th><th>Acciones</th></tr>';
            if (data.length > 0) {
              $.each(data, function (index, producto) {
                tableContent += '<tr><td>' + producto.Clave_Producto_PK + '</td><td>' + producto.Nombre_Producto +
                  '</td><td>' + producto.Piezas + '</td><td>' + producto.UM + '</td><td>' + producto.Descripcion_Producto +
                  '</td><td>' + producto.Precio_Unitario + '</td><td>' + producto.Stock +
                  '</td><td><a href="actualizar.php?Clave_Producto_PK=' + producto.Clave_Producto_PK + '">Editar</a></td></tr>';
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
      <h1>CONSULTAR</h1>
    </div>
  </section>
  <section class="options">
    <div class="buscador">
      <input type="text" id="search" placeholder="Buscar producto..." />
    </div>
  </section>
  <section id="resultados" class="resultados">
    <!-- Mostrar todos los productos por defecto -->
    <table class="table">
      <tr>
        <th>Clave</th>
        <th>Nombre</th>
        <th>Piezas</th>
        <th>UM</th>
        <th>Descripción</th>
        <th>Precio unitario</th>
        <th>Alerta de stock</th>
        <th>Acciones</th>
      </tr>
      <?php if (count($productos) > 0): ?>
        <?php foreach ($productos as $producto): ?>
          <tr>
            <td><?php echo $producto['Clave_Producto_PK']; ?></td>
            <td><?php echo $producto['Nombre_Producto']; ?></td>
            <td><?php echo $producto['Piezas']; ?></td>
            <td><?php echo $producto['UM']; ?></td>
            <td><?php echo $producto['Descripcion_Producto']; ?></td>
            <td><?php echo $producto['Precio_Unitario']; ?></td>
            <td><?php echo $producto['Stock_Minimo']; ?></td>
            <td><a href="actualizar.php?Clave_Producto_PK=<?php echo $producto['Clave_Producto_PK']; ?>">Editar</a></td>
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
    <a href="../inventario/inventario.php" class="btn_salir">Regresar</a>
    <a href="../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

</html>