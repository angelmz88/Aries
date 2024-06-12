<?php
include ("notas/../../../php/deep_sesion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/normalize.css" />
  <link rel="stylesheet" href="../../css/style.css" />
  <link rel="stylesheet" href="../../css/forms-register.css" />
  <link rel="shortcut icon" href="../../img/global/lavanderia.png" />
  <title>Notas</title>
</head>

<body>
  <header class="header">
    <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
  </header>
  <section class="hero">
    <div class="hero-cover">
      <h1>NUEVA NOTA</h1>
    </div>
  </section>
  <section class="options">
    <form action="crear.php" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="tel" class="form-control tel-clientes" name="tel-clientes" required />
        <label for="tel-clientes">Contacto del cliente:</label>
        <span class="error-message"></span>
      </div>
      <div class="form-group">
        <select class="form-control" name="tipo-servicio" required>
          <option value="lavado">Lavado</option>
          <option value="planchado">Planchado</option>
          <option value="Lavado en seco">Lavado en seco</option>
          <option value="Tenido">Teñido</option>
          <option value="Reparacion">Reparacion</option>
        </select>
        <label for="tipo-servicio">Tipo de servicio:</label>
      </div>
      <div id="prendas-container" class="form-group">
        <div class="prenda form-group">
          <div class="form-group">
            <select class="form-control" name="tipo-prenda[]" required>
              <option value="Pantalon">Pantalon</option>
              <option value="Sudadera">Sudadera</option>
              <option value="Saco">Saco</option>
              <option value="Traje">Traje</option>
              <option value="Abrigo">Abrigo</option>
              <option value="Chamarra">Chamarra</option>
              <option value="Vestido de noche">Vestido de noche</option>
              <option value="Playera">Playera</option>
              <option value="Blusa">Blusa</option>
              <option value="Camisa">Camisa</option>
              <option value="Edredon">Edredon</option>
              <option value="Cobija">Cobija</option>
              <option value="Cobertor">Cobertor</option>
              <option value="Chaleco">Chaleco</option>
              <option value="Capa">Capa</option>
              <option value="Gabardina">Gabardina</option>
              <option value="Falda">Falda</option>
              <option value="Corbata">Corbata</option>
              <option value="Pans">Pans</option>
              <option value="Chalinas">Chalinas</option>
            </select>
            <label for="tipo-prenda">Tipo de prendas</label>
          </div>
          <div class="form-group">
            <input type="number" class="form-control numero-prenda" name="numero-prenda[]" required />
            <label for="numero-prenda">Número de prendas</label>
            <span class="error-message-prenda"></span>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="color-prenda[]" required />
            <label for="color-prenda">Color de prendas</label>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="notas-adicionales[]" required />
            <label for="notas-adicionales">Notas adicionales</label>
          </div>
          <button type="button" class="remove-prenda submit">Quitar prenda</button>
        </div>
      </div>

      <button type="button" id="add-prenda" class="submit accion">Agregar prenda</button>

      <div class="form-group">
        <input type="date" class="form-control fecha-entrega" name="fecha-entrega" required />
        <label for="fecha-entrega">Fecha de entrega</label>
        <span class="error-message"></span>
      </div>
      <div class="form-group">
        <input type="time" class="form-control hora-entrega" name="hora-entrega" required />
        <label for="hora-entrega">Hora de entrega (estimada)</label>
      </div>
      <button type="submit" class="submit" onclick="return confirmSubmission()">Guardar</button>
    </form>
    <script src="notas/../../../JS/registro-nota.js"></script>
    <script>
      document.getElementById('add-prenda').addEventListener('click', function () {
        const container = document.getElementById('prendas-container');
        const newPrenda = container.children[0].cloneNode(true);
        newPrenda.querySelector('input[name="numero-prenda[]"]').value = "";
        newPrenda.querySelector('input[name="color-prenda[]"]').value = "";
        newPrenda.querySelector('input[name="notas-adicionales[]"]').value = ""; // Limpiar el campo de notas adicionales
        container.appendChild(newPrenda);
      });

      document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-prenda')) {
          const prenda = e.target.closest('.prenda');
          if (document.querySelectorAll('.prenda').length > 1) {
            prenda.remove();
          } else {
            alert('Debe haber al menos una prenda.');
          }
        }
      });

      function confirmSubmission() {
        return confirm("¿Los datos son correctos? Una vez realizada la nota no se puede modificar.");
      }
    </script>
  </section>
  <footer class="footer">
    <a href="../notas.php" class="btn_salir">Regresar</a>
    <a href="notas/../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>
<?php
include ("notas/../../../php/bd.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  date_default_timezone_set('America/Mexico_City');
  $tel = isset($_POST['tel-clientes']) ? $_POST['tel-clientes'] : null;
  $tipo_servicio = isset($_POST['tipo-servicio']) ? $_POST['tipo-servicio'] : null;
  $tipo_prenda = isset($_POST['tipo-prenda']) ? $_POST['tipo-prenda'] : [];
  $numero_prenda = isset($_POST['numero-prenda']) ? $_POST['numero-prenda'] : [];
  $color_prenda = isset($_POST['color-prenda']) ? $_POST['color-prenda'] : [];
  $notas_adicionales = isset($_POST['notas-adicionales']) ? $_POST['notas-adicionales'] : []; // Cambio aquí
  $fecha_entrega = isset($_POST['fecha-entrega']) ? $_POST['fecha-entrega'] : null;
  $hora_entrega = isset($_POST['hora-entrega']) ? $_POST['hora-entrega'] : null;

  $hora_actual = date('H:i:s');
  $fecha_actual = date('Y-m-d');

  $username = $_SESSION["username"];
  $validacion = "SELECT Numero_Telefono_PK FROM empleados WHERE Numero_Seguridad_Social = '$username'";
  $retorno = $conn->query($validacion);
  $numero = $retorno->fetch_assoc();
  $tel_empleado = (string) $numero['Numero_Telefono_PK'];

  $conn->begin_transaction(); // Iniciar transacción
  try {
    // Insertar información de la nota
    $sql_nota = "INSERT INTO notas (Numero_Telefono_Cliente_FK, Numero_Telefono_Empleado_FK, Tipo_Servicio, Fecha_Entrega_Estimada, Hora_Entrega_Estimada)
    VALUES ('$tel', '$tel_empleado','$tipo_servicio', '$fecha_entrega', '$hora_entrega')";
    if (!$conn->query($sql_nota)) {
      throw new Exception("Error al insertar nota: " . $conn->error);
    }

    switch ($tipo_servicio) {
      case 'mostrador':
        $clave_area = 'M';
        break;
      case 'planta':
        $clave_area = 'P';
        break;
      case 'lavado':
        $clave_area = 'L';
        break;
      case 'planchado':
        $clave_area = 'PL';
        break;
    }


    $nota_id = $conn->insert_id; // Obtener el ID de la nota insertada

    $query_Mover = '';

    if ($tipo_servicio == 'Tenido' || $tipo_servicio == 'Reparacion') {
      $query_Mover = "INSERT INTO tenido_reparacion (Folio_Nota_PK_FK, Cantidad_Prendas_PK, Tipo_Servicio, Telefono_Colaborador_FK, Estatus)
VALUES ('$nota_id', 0, '$tipo_servicio', '5513106553', 0)";
      if (!$conn->query($query_Mover)) {
        throw new Exception("Error al mover nota: " . $conn->error);
      }
    } else {
      $query_Mover = "INSERT INTO mostrador (Folio_Nota_PK_FK, Fecha_Entrada_PK, Hora_Entrada, Estatus, Identificador_Area_FK, Area_Siguiente)
VALUES ('$nota_id', '$fecha_actual', '$hora_actual', 0, 'M', '$clave_area')";

      if (!$conn->query($query_Mover)) {
        throw new Exception("Error al mover nota: " . $conn->error);
      }
      // Insertar las prendas
      for ($i = 0; $i < count($tipo_prenda); $i++) {
        $consulta_precio = "SELECT Precio_Unitario FROM precio_prendas WHERE Tipo_Prenda_PK = '" . $tipo_prenda[$i] . "'";
        $ejec_precio = $conn->query($consulta_precio);

        // Verificar si la consulta fue exitosa
        if ($ejec_precio) {
          $precio = $ejec_precio->fetch_assoc();

          // Verificar si se encontró el precio
          if ($precio) {
            // Obtener el precio unitario de la consulta
            $precio_unitario = (int) $precio['Precio_Unitario'];

            // Calcular el precio total
            $precio_total = $precio_unitario * (int) $numero_prenda[$i];

            // Insertar los datos en la base de datos
            $sql_prenda = "INSERT INTO prendas (Folio_Nota_PK_FK, Tipo_Prenda_PK_FK, Color, Cantidad, Precio_Total, Observaciones, Fecha_Entrada, Hora_Entrada) 
             VALUES ('$nota_id', '" . $tipo_prenda[$i] . "', '" . $color_prenda[$i] . "', '" . $numero_prenda[$i] . "', $precio_total, 
             '" . $notas_adicionales[$i] . "', '$fecha_actual', '$hora_actual')";
            if (!$conn->query($sql_prenda)) {
              throw new Exception("Error al insertar prenda: " . $conn->error);
            }
          } else {
            throw new Exception("No se encontró el precio para el tipo de prenda especificado.");
          }
        } else {
          throw new Exception("Error al ejecutar la consulta de precio: " . $conn->error);
        }
      }
    }



    $conn->commit(); // Confirmar transacción
    echo '<script>';
    echo 'alert("Nota y prendas registradas correctamente. Folio de nota: ' . $nota_id . ' Precio total: ' . $precio_total . ' ");';
    echo '</script>';
  } catch (Exception $e) {
    $conn->rollback(); // Revertir transacción en caso de error
    $error_message = $e->getMessage();
    if (strpos($error_message, 'Cannot add or update a child row: a foreign key constraint fails') !== false && strpos($error_message, 'Telefono_Clientes_Notas') !== false) {
      echo '<script>';
      echo 'alert("El contacto de usuario no coincide con ningún registro, favor de registrarlo.");';
      echo '</script>';
    } else {
      echo '<script>';
      echo 'alert("' . $error_message . '");';
      echo '</script>';
    }
  }
}

?>

</html>