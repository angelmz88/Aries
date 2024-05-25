<?php
include ("notas/../../../php/deep_sesion.php");
include ("notas/../../../php/bd.php");
require 'notas/../../../pdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_GET['Folio_Nota_PK'])) {
    $id = $_GET['Folio_Nota_PK'];

    // Obtener datos de la nota
    $sql_folio = "SELECT * FROM notas WHERE Folio_Nota_PK = '$id'";
    $result_folio = $conn->query($sql_folio);

    if ($result_folio->num_rows > 0) {
        $nota = $result_folio->fetch_assoc();
    } else {
        echo "<p>No se encontró ninguna nota con el Folio_Nota_PK especificado.</p>";
        exit();
    }

    // Obtener datos de las prendas asociadas a la nota
    $sql_prendas = "SELECT p.Tipo_Prenda_PK_FK, p.Cantidad, p.Observaciones, p.Precio_Total, pp.Precio_Unitario 
                    FROM prendas p
                    INNER JOIN precio_prendas pp ON p.Tipo_Prenda_PK_FK = pp.Tipo_Prenda_PK
                    WHERE p.Folio_Nota_PK_FK = '$id'";
    $result_prendas = $conn->query($sql_prendas);

    $prendas = [];
    $total_precio = 0;
    if ($result_prendas->num_rows > 0) {
        while ($row = $result_prendas->fetch_assoc()) {
            $prendas[] = $row;
            $total_precio += $row['Precio_Total'];
        }
    }
} else {
    echo "<p>Folio_Nota_PK no especificado en la URL.</p>";
    exit();
}

// Crear el contenido HTML para el PDF
$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .nota-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: 20px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="nota-container">
        <h1>Tintorería Aries</h1>
        <table>
            <tr>
                <th>Folio de nota</th>
                <td>' . htmlspecialchars($nota['Folio_Nota_PK']) . '</td>
            </tr>
            <tr>
                <th>Teléfono del cliente</th>
                <td>' . htmlspecialchars($nota['Numero_Telefono_Cliente_FK']) . '</td>
            </tr>
            <tr>
                <th>Teléfono del empleado</th>
                <td>' . htmlspecialchars($nota['Numero_Telefono_Empleado_FK']) . '</td>
            </tr>
            <tr>
                <th>Tipo de servicio</th>
                <td>' . htmlspecialchars($nota['Tipo_Servicio']) . '</td>
            </tr>
            <tr>
                <th>Fecha de entrega (Estimada)</th>
                <td>' . htmlspecialchars($nota['Fecha_Entrega_Estimada']) . '</td>
            </tr>
            <tr>
                <th>Hora de entrega (Estimada)</th>
                <td>' . htmlspecialchars($nota['Hora_Entrega_Estimada']) . '</td>
            </tr>
        </table>
        <h2>Prendas</h2>
        <table>
            <tr>
                <th>Tipo de Prenda</th>
                <th>Cantidad</th>
                <th>Observaciones</th>
                <th>Precio Unitario</th>
                <th>Precio Total</th>
            </tr>';

foreach ($prendas as $prenda) {
    $html .= '
            <tr>
                <td>' . htmlspecialchars($prenda['Tipo_Prenda_PK_FK']) . '</td>
                <td>' . htmlspecialchars($prenda['Cantidad']) . '</td>
                <td>' . htmlspecialchars($prenda['Observaciones']) . '</td>
                <td>' . htmlspecialchars($prenda['Precio_Unitario']) . '</td>
                <td>' . htmlspecialchars($prenda['Precio_Total']) . '</td>
            </tr>';
}

$html .= '
            <tr>
                <th colspan="4">Total</th>
                <td>' . htmlspecialchars($total_precio) . '</td>
            </tr>
        </table>
    </div>
</body>
</html>';

// Obtener la fecha actual
$fecha_actual = date('Y-m-d');

// Nombre del archivo
$nombre_archivo = 'nota_' . $fecha_actual . '_' . $id . '.pdf';

// Inicializar Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Enviar el PDF al navegador
$dompdf->stream($nombre_archivo, array("Attachment" => false));
