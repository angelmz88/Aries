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
    <form action="" id="form-register" method="post" class="form">
      <div class="form-group">
        <input type="tel" class="form-control" name="tel-clientes" required />
        <label for="tel-clientes">Contacto del cliente:</label>
      </div>
      <div class="form-group">
        <select class="form-control" name="tipo-servicio" required>
          <option value="Lavado">Lavado</option>
          <option value="Planchado">Planchado</option>
          <option value="Lavado en seco">Lavado en seco</option>
          <option value="Teñido">Teñido</option>
          <option value="Reparacion">Reparacion</option>
        </select>
        <label for="tipo-servicio">Tipo de servicio:</label>
      </div>

      <div id="prendas-container" class="form-group">
        <div class="prenda">
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
            <input type="number" class="form-control" name="numero-prenda[]" required />
            <label for="numero-prenda">Número de prendas</label>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="color-prenda[]" required />
            <label for="color-prenda">Color de prendas</label>
          </div>
          <button type="button" class="remove-prenda submit">Quitar prenda</button>
        </div>
      </div>

      <button type="button" id="add-prenda" class="submit">Agregar prenda</button>

      <div class="form-group">
        <input type="date" class="form-control" name="fecha-entrega" required />
        <label for="fecha-entrega">Fecha de entrega</label>
      </div>
      <div class="form-group">
        <input type="time" class="form-control" name="hora-entrega" required />
        <label for="hora-entrega">Hora de entrega (estimada)</label>
      </div>
      <div class="form-group">
        <input type="number" class="form-control" name="precio-total" required />
        <label for="precio-total">Precio total</label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="notas-adicionales" required />
        <label for="notas-adicionales">Notas adicionales</label>
      </div>
      <button type="submit" class="submit">Guardar</button>
    </form>
    <script>
      document.getElementById('add-prenda').addEventListener('click', function () {
        const container = document.getElementById('prendas-container');
        const newPrenda = container.children[0].cloneNode(true);
        newPrenda.querySelector('input[name="numero-prenda[]"]').value = "";
        newPrenda.querySelector('input[name="color-prenda[]"]').value = "";
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
    </script>
    <script src="../../JS/registro-nota.js"></script>
  </section>
  <footer class="footer">
    <a href="../notas.php" class="btn_salir">Regresar</a>
    <a href="notas/../../../php/salir.php" class="btn_salir">Salir</a>
  </footer>
</body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $tel = $_POST['tel-clientes'];
  $tipo_servicio = $_POST['tipo-servicio'];
  $tipo_prenda = $_POST['tipo-prenda'];
  $numero_prenda = $_POST['numero-prenda'];
  $color_prenda = $_POST['color-prenda'];
  $fecha_entrega = $_POST['fecha-entrega'];
  $hora_entrega = $_POST['hora-entrega'];
  $precio_total = $_POST['precio-total'];
  $notas_adicionales = $_POST['notas-adicionales'];

  include ("clientes/../../../php/bd.php");

  // Consulta SQL de inserción para prendas
  for ($i = 0; $i < count($tipo_prenda); $i++) {
    $sql = "INSERT INTO prendas (Telefono_Cliente, Tipo_Servicio, Tipo_Prenda, Numero_Prenda, Color_Prenda, Fecha_Entrega, Hora_Entrega, Precio_Total, Notas_Adicionales) 
    VALUES ('$tel','$tipo_servicio','" . $tipo_prenda[$i] . "','" . $numero_prenda[$i] . "','" . $color_prenda[$i] . "','$fecha_entrega','$hora_entrega','$precio_total','$notas_adicionales')";

    if ($conn->query($sql) === TRUE) {
      echo '<script>';
      echo 'alert("Prenda registrada correctamente");';
      echo '</script>';
    } else {
      echo "Error al insertar datos: " . $conn->error;
    }
  }
}
?>

</html>