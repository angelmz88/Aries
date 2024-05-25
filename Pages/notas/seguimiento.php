<?php
include ("notas/../../../php/deep_sesion.php");
include ("notas/../../../php/bd.php");

$id = null;
if (isset($_GET['Folio_Nota_PK'])) {
    $id = $_GET['Folio_Nota_PK'];
    $id = $conn->real_escape_string($id);  // Escapar el valor para evitar inyecciones SQL

    $query = "SELECT Folio_Nota_PK FROM notas WHERE Folio_Nota_PK = '$id'";
    $result = $conn->query($query);
    $row = $result ? $result->fetch_assoc() : null;

    $query_Mostrador = "SELECT * FROM mostrador WHERE Folio_Nota_PK_FK = '$id'";
    $result_Mostrador = $conn->query($query_Mostrador);
    $row_Mostrador = $result_Mostrador ? $result_Mostrador->fetch_assoc() : null;

    $query_Lavado = "SELECT * FROM lavado WHERE Folio_Nota_PK_FK = '$id'";
    $result_Lavado = $conn->query($query_Lavado);
    $row_Lavado = $result_Lavado ? $result_Lavado->fetch_assoc() : null;

    $query_Planchado = "SELECT * FROM planchado WHERE Folio_Nota_PK_FK = '$id'";
    $result_Planchado = $conn->query($query_Planchado);
    $row_Planchado = $result_Planchado ? $result_Planchado->fetch_assoc() : null;

    $query_Planta = "SELECT * FROM planta WHERE Folio_Nota_PK_FK = '$id'";
    $result_Planta = $conn->query($query_Planta);
    $row_Planta = $result_Planta ? $result_Planta->fetch_assoc() : null;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/normalize.css" />
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/consulta.css" />
    <link rel="stylesheet" href="../../css/forms-register.css" />
    <link rel="shortcut icon" href="../../img/global/lavanderia.png" />
    <title>Notas</title>
    <script>
        function updateSelectOptions() {
            const selectDesde = document.querySelector('select[name="area-mover-desde"]');
            const selectA = document.querySelector('select[name="area-mover"]');

            // Habilitar todas las opciones antes de aplicar la lógica de deshabilitación
            selectDesde.querySelectorAll('option').forEach(option => option.disabled = false);
            selectA.querySelectorAll('option').forEach(option => option.disabled = false);

            const selectedValueDesde = selectDesde.value;
            const selectedValueA = selectA.value;

            if (selectedValueDesde) {
                selectA.querySelector(`option[value="${selectedValueDesde}"]`).disabled = true;
            }
            if (selectedValueA) {
                selectDesde.querySelector(`option[value="${selectedValueA}"]`).disabled = true;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const selectDesde = document.querySelector('select[name="area-mover-desde"]');
            const selectA = document.querySelector('select[name="area-mover"]');

            selectDesde.addEventListener('change', updateSelectOptions);
            selectA.addEventListener('change', updateSelectOptions);

            updateSelectOptions();
        });
    </script>
</head>

<body>
    <header class="header">
        <h1>SIAUTO (Sistema Integral de Automatización y Control)</h1>
    </header>
    <section class="hero">
        <div class="hero-cover">
            <h1>SEGUIMIENTO</h1>
        </div>
    </section>
    <section>
        <h3>Folio de Nota:
            <?php echo isset($row['Folio_Nota_PK']) ? htmlspecialchars($row['Folio_Nota_PK']) : "Sin registro"; ?>
        </h3>
    </section>
    <section id="resultados" class="resultados">
        <table class="table">
            <tr>
                <th>Área</th>
                <th>Fecha de entrada</th>
                <th>Hora de entrada</th>
                <th>Fecha de salida</th>
                <th>Hora de salida</th>
                <th>Área siguiente</th>
                <th>Estatus</th>
            </tr>
            <tr>
                <th>Lavado</th>
                <td><?php echo isset($row_Lavado['Fecha_Entrada_PK']) ? htmlspecialchars($row_Lavado['Fecha_Entrada_PK']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Lavado['Hora_Entrada']) ? htmlspecialchars($row_Lavado['Hora_Entrada']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Lavado['Fecha_Salida']) ? htmlspecialchars($row_Lavado['Fecha_Salida']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Lavado['Hora_Salida']) ? htmlspecialchars($row_Lavado['Hora_Salida']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Lavado['Area_Siguiente']) ? htmlspecialchars($row_Lavado['Area_Siguiente']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Lavado['Estatus']) ? htmlspecialchars($row_Lavado['Estatus']) : "Sin registro"; ?>
                </td>
            </tr>
            <tr>
                <th>Planta</th>
                <td><?php echo isset($row_Planta['Fecha_Entrada_PK']) ? htmlspecialchars($row_Planta['Fecha_Entrada_PK']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Planta['Hora_Entrada']) ? htmlspecialchars($row_Planta['Hora_Entrada']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Planta['Fecha_Salida']) ? htmlspecialchars($row_Planta['Fecha_Salida']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Planta['Hora_Salida']) ? htmlspecialchars($row_Planta['Hora_Salida']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Planta['Area_Siguiente']) ? htmlspecialchars($row_Planta['Area_Siguiente']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Planta['Estatus']) ? htmlspecialchars($row_Planta['Estatus']) : "Sin registro"; ?>
                </td>
            </tr>
            <tr>
                <th>Planchado</th>
                <td><?php echo isset($row_Planchado['Fecha_Entrada_PK']) ? htmlspecialchars($row_Planchado['Fecha_Entrada_PK']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Planchado['Hora_Entrada']) ? htmlspecialchars($row_Planchado['Hora_Entrada']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Planchado['Fecha_Salida']) ? htmlspecialchars($row_Planchado['Fecha_Salida']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Planchado['Hora_Salida']) ? htmlspecialchars($row_Planchado['Hora_Salida']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Planchado['Area_Siguiente']) ? htmlspecialchars($row_Planchado['Area_Siguiente']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Planchado['Estatus']) ? htmlspecialchars($row_Planchado['Estatus']) : "Sin registro"; ?>
                </td>
            </tr>
            <tr>
                <th>Mostrador</th>
                <td><?php echo isset($row_Mostrador['Fecha_Entrada_PK']) ? htmlspecialchars($row_Mostrador['Fecha_Entrada_PK']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Mostrador['Hora_Entrada']) ? htmlspecialchars($row_Mostrador['Hora_Entrada']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Mostrador['Fecha_Salida']) ? htmlspecialchars($row_Mostrador['Fecha_Salida']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Mostrador['Hora_Salida']) ? htmlspecialchars($row_Mostrador['Hora_Salida']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Mostrador['Area_Siguiente']) ? htmlspecialchars($row_Mostrador['Area_Siguiente']) : "Sin registro"; ?>
                </td>
                <td><?php echo isset($row_Mostrador['Estatus']) ? htmlspecialchars($row_Mostrador['Estatus']) : "Sin registro"; ?>
                </td>
            </tr>
        </table>
    </section>
    <section class="form-register options">
        <h3>Opciones</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?Folio_Nota_PK=' . urlencode($id)); ?>"
            method="POST" class="form">
            <input type="hidden" name="Folio_Nota_PK" value="<?php echo htmlspecialchars($id); ?>" />
            <div class="form-group">
                <select class="form-control" name="area-mover-desde" required>
                    <option value="">Seleccionar área</option>
                    <option value="lavado">Lavado</option>
                    <option value="planta">Planta</option>
                    <option value="planchado">Planchado</option>
                    <option value="mostrador">Mostrador</option>
                </select>
                <label for="area-mover-desde">Mover desde:</label>
            </div>
            <div class="form-group">
                <select class="form-control" name="area-mover" required>
                    <option value="">Seleccionar área</option>
                    <option value="lavado">Lavado</option>
                    <option value="planta">Planta</option>
                    <option value="planchado">Planchado</option>
                    <option value="mostrador">Mostrador</option>
                </select>
                <label for="area-mover">Mover a:</label>
            </div>
            <button type="submit" class="submit">Mover</button>
        </form>
    </section>
    <footer class="footer">
        <a href="../notas.php" class="btn_salir">Regresar</a>
        <a href="notas/../../../php/salir.php" class="btn_salir">Salir</a>
    </footer>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $conn->real_escape_string($_POST['Folio_Nota_PK']);
        $area = $conn->real_escape_string($_POST['area-mover']);
        $area_desde = $conn->real_escape_string($_POST['area-mover-desde']);
        date_default_timezone_set('America/Mexico_City');
        $fecha_entrada = date('Y-m-d');
        $hora_entrada = date('H:i:s');
        $query_Mover = '';
        $query_Actualizar = '';

        switch ($area) {
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

        switch ($clave_area) {
            case 'M':
                $clave_siguiente = 'P';
                break;
            case 'P':
                $clave_siguiente = 'PL';
                break;
            case 'L':
                $clave_siguiente = 'PL';
                break;
            case 'PL':
                $clave_siguiente = 'M';
                break;
        }

        if ($clave_area != 'M') {
            $query_Mover = "INSERT INTO $area (Folio_Nota_PK_FK, Fecha_Entrada_PK, Hora_Entrada, Estatus, Identificador_Area_FK, Area_Siguiente)
        VALUES ('$id', '$fecha_entrada', '$hora_entrada', 0, '$clave_area', '$clave_siguiente')";

            $query_Actualizar = "UPDATE $area_desde SET Fecha_Salida = '$fecha_entrada', Hora_Salida = '$hora_entrada', 
        Area_Siguiente = '$clave_area', Estatus = 1 WHERE Folio_Nota_PK_FK = '$id'";

            if ($conn->query($query_Mover) === TRUE) {
                // echo '<script>alert("Producto registrado correctamente");</script>';
            } else {
                echo '<script>alert("Error: No se puede realizar ese movimiento");</script>';
            }

            if ($conn->query($query_Actualizar) === TRUE) {
                echo '<script>alert("Área actualizada correctamente");';
                echo 'window.location.href = "buscar.php";';
                echo '</script>';

            } else {
                echo '<script>alert("Error: No se puede realizar ese movimiento");</script>';
            }
        } else {
            date_default_timezone_set('America/Mexico_City');
            $fecha_entrada = date('Y-m-d');
            $hora_entrada = date('H:i:s');
            $query_Actualizar = "UPDATE $area_desde SET Fecha_Salida = '$fecha_entrada', Hora_Salida = '$hora_entrada', 
            Area_Siguiente = '$clave_area', Estatus = 1 WHERE Folio_Nota_PK_FK = '$id'";

            $query_Actualizar_Mostrador = "UPDATE mostrador SET Fecha_Salida = '$fecha_entrada', Hora_Salida = '$hora_entrada', 
            Area_Siguiente = 'NA' WHERE Folio_Nota_PK_FK = '$id'";

            if ($conn->query($query_Actualizar) === TRUE && $conn->query($query_Actualizar_Mostrador) === TRUE) {
                echo '<script>alert("Movimiento realizado con exito");';
                echo 'window.location.href = "buscar.php";';
                echo '</script>';
            } else {
                echo '<script>alert("Error: No se puede realizar ese movimiento");</script>';
            }
        }
    }

    ?>
</body>

</html>