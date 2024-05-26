<?php
include ("empleados/../../../../php/final_sesion.php");
include ("empleados/../../../../php/bd.php");
require 'empleados/../../../../pdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

ob_start(); // Iniciar almacenamiento en búfer de salida
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
  <title>Inventario</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>CREAR PEDIDO</h1>
    </div>
  </section>
  <section class="options">
    <form action="pedido.php" id="form-register" method="post" class="form">
      <div class="form-group">
        <select class="form-control" name="proveedor[]" required>
          <?php
          $sql = "SELECT Nombre_Distribuidora_PK FROM proveedores";
          $result = $conn->query($sql);

          while ($row = $result->fetch_assoc()) {
            echo "<option value='" . trim($row['Nombre_Distribuidora_PK']) . "'>" . trim($row['Nombre_Distribuidora_PK']) . "</option>";
          }
          ?>
        </select>
        <label for="proveedores">Nombre de la distribuidora</label>
      </div>
      <div id="productos-container" class="form-group">
        <div class="producto form-group">
          <div class="form-group">
            <select class="form-control" name="producto[]" required>
              <?php
              $sql = "SELECT Nombre_Producto FROM productos";
              $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . trim($row['Nombre_Producto']) . "'>" . trim($row['Nombre_Producto']) . "</option>";
              }
              ?>
            </select>
            <label for="producto">Producto</label>
          </div>
          <div class="form-group">
            <input type="number" class="form-control numero4" name="num-piezas[]" required />
            <label for="num-piezas">Número de piezas</label>
          </div>
          <button type="button" class="remove-producto submit">Quitar producto</button>
        </div>
      </div>
      <button type="button" id="add-producto" class="submit accion">Agregar producto</button>
      <button type="submit" class="submit">Guardar</button>
    </form>
    <script src="inventario/../../../../JS/registro-nota.js"></script>
    <script>
      document.getElementById('add-producto').addEventListener('click', function () {
        const container = document.getElementById('productos-container');
        const newProducto = container.children[0].cloneNode(true);

        // Restablecer los valores de los campos en el nuevo producto
        newProducto.querySelector('select[name="producto[]"]').value = "";
        newProducto.querySelector('input[type="number"]').value = "";

        // Añadir el nuevo producto al contenedor
        container.appendChild(newProducto);
      });

      document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-producto')) {
          const producto = e.target.closest('.producto');
          if (document.querySelectorAll('.producto').length > 1) {
            producto.remove();
          } else {
            alert('Debe haber al menos un producto.');
          }
        }
      });
    </script>
  </section>
  <footer class="footer">
    <a href="../inventario/inventario.php" class="btn_salir">Regresar</a>
    <a href="inventario/../../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>

<?php
include ("inventario/../../../../php/bd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre_distribuidora = trim($_POST['proveedor'][0]);
  $productos = isset($_POST['producto']) ? array_map('trim', $_POST['producto']) : [];
  $numero_piezas = isset($_POST['num-piezas']) ? $_POST['num-piezas'] : [];
  $provisional = 0;
  $fecha_actual = date('Y-m-d');

  $conn->begin_transaction();

  try {
    $sql_nota = "INSERT INTO pedidos (Nombre_Distribuidora_PK_FK, Fecha_Pedido, Total_Pagar) VALUES (?, ?, 0)";
    $stmt_nota = $conn->prepare($sql_nota);
    $stmt_nota->bind_param("ss", $nombre_distribuidora, $fecha_actual);

    if (!$stmt_nota->execute()) {
      throw new Exception("Error al insertar nota: " . $stmt_nota->error);
    }

    $nota_id = $stmt_nota->insert_id;

    $detalle_pedidos = [];

    for ($i = 0; $i < count($productos); $i++) {
      $producto_actual = $productos[$i];

      $consulta_precio = "SELECT Precio_Unitario, Clave_Producto_PK FROM productos WHERE Nombre_Producto = ?";
      $stmt_precio = $conn->prepare($consulta_precio);
      $stmt_precio->bind_param("s", $producto_actual);

      if (!$stmt_precio->execute()) {
        throw new Exception("Error al ejecutar la consulta de precio: " . $stmt_precio->error);
      }

      $result_precio = $stmt_precio->get_result();
      if ($result_precio->num_rows > 0) {
        $row_precio = $result_precio->fetch_assoc();
        $precio_unitario = (int) $row_precio['Precio_Unitario'];
        $id_prenda = trim($row_precio['Clave_Producto_PK']);

        $precio_total = $precio_unitario * (int) $numero_piezas[$i];
        $provisional += $precio_total;

        $sql_prenda = "INSERT INTO detalles_pedidos (Numero_Pedido_PK_FK, Identificador_Producto_PK_FK, Cantidad_Producto) 
                       VALUES (?, ?, ?)";
        $stmt_prenda = $conn->prepare($sql_prenda);
        $stmt_prenda->bind_param("isi", $nota_id, $id_prenda, $numero_piezas[$i]);

        if (!$stmt_prenda->execute()) {
          throw new Exception("Error al insertar producto: " . $stmt_prenda->error);
        }

        $detalle_pedidos[] = [
          'Nombre_Producto' => $producto_actual,
          'Cantidad' => $numero_piezas[$i],
          'Precio_Unitario' => $precio_unitario,
          'Precio_Total' => $precio_total
        ];
      } else {
        throw new Exception("No se encontró el precio para el producto especificado: " . $producto_actual);
      }
    }

    $sql_update_total = "UPDATE pedidos SET Total_Pagar = ? WHERE Numero_Pedido_PK = ?";
    $stmt_update_total = $conn->prepare($sql_update_total);
    $stmt_update_total->bind_param("ii", $provisional, $nota_id);

    if (!$stmt_update_total->execute()) {
      throw new Exception("Error al actualizar el total a pagar: " . $stmt_update_total->error);
    }

    $conn->commit();

    // Crear el contenido HTML para el PDF
    $html = '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pedido ' . htmlspecialchars($nota_id) . '</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { width: 100%; max-width: 800px; margin: 0 auto; }
            h1 { text-align: center; }
            table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
            table, th, td { border: 1px solid black; }
            th, td { padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Pedido ' . htmlspecialchars($nota_id) . '</h1>
            <table>
                <tr>
                    <th>Número de Pedido</th>
                    <td>' . htmlspecialchars($nota_id) . '</td>
                </tr>
                <tr>
                    <th>Distribuidora</th>
                    <td>' . htmlspecialchars($nombre_distribuidora) . '</td>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <td>' . htmlspecialchars($fecha_actual) . '</td>
                </tr>
            </table>
            <h2>Productos</h2>
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Precio Total</th>
                </tr>';

    foreach ($detalle_pedidos as $detalle) {
      $html .= '
                <tr>
                    <td>' . htmlspecialchars($detalle['Nombre_Producto']) . '</td>
                    <td>' . htmlspecialchars($detalle['Cantidad']) . '</td>
                    <td>' . htmlspecialchars($detalle['Precio_Unitario']) . '</td>
                    <td>' . htmlspecialchars($detalle['Precio_Total']) . '</td>
                </tr>';
    }

    $html .= '
                <tr>
                    <th colspan="3">Total a Pagar</th>
                    <td>' . htmlspecialchars($provisional) . '</td>
                </tr>
            </table>
        </div>
    </body>
    </html>';

    // Inicializar Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    ob_end_clean(); // Limpiar cualquier salida antes de enviar el PDF

    // Enviar el PDF al navegador
    $dompdf->stream('pedido_' . $fecha_actual . '_' . $nota_id . '.pdf', array("Attachment" => TRUE));

    echo '<script>';
    echo 'alert("Pedido y productos registrados correctamente.");';
    // echo 'window.location.href = "../notas.php";'; // Redirige después de éxito
    echo '</script>';
  } catch (Exception $e) {
    $conn->rollback();
    ob_end_clean(); // Limpiar el búfer en caso de error también
    echo '<script>';
    echo 'alert("Error al registrar nota y productos: ' . $e->getMessage() . '");';
    echo '</script>';
  }
}
?>

</html>