<?php
// Importar clases de PHPMailer en el espacio de nombres global
// Estas deben estar en la parte superior de tu script, no dentro de una función
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include ("bd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['clave'];

    echo $id;

    $query_stock = "SELECT Stock_Minimo FROM Productos WHERE Clave_Producto_PK = '$id'";
    $result_stock = $conn->query($query_stock);
    $stock_Producto = $result_stock->fetch_assoc()['Stock_Minimo'];

    $query_Nombre = "SELECT Nombre_Producto, Piezas FROM Productos WHERE Clave_Producto_PK = '$id'";
    $result_Nombre = $conn->query($query_Nombre);
    $producto = $result_Nombre->fetch_assoc();
    $nombre_Producto = $producto['Nombre_Producto'];
    $numero_Producto = $producto['Piezas'];

    if ($numero_Producto <= $stock_Producto) {
        // Cargar el autoloader de Composer
        require 'php/../../vendor/autoload.php';

        // Crear una instancia; pasando `true` habilita excepciones
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Habilitar salida de depuración detallada
            $mail->isSMTP();                                            // Enviar usando SMTP
            $mail->Host = 'smtp.gmail.com';                             // Establecer el servidor SMTP para enviar a través de él
            $mail->SMTPAuth = true;                                     // Habilitar autenticación SMTP
            $mail->Username = 'joseangelmarquez080802@gmail.com';       // Nombre de usuario SMTP
            $mail->Password = '';                       // Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Habilitar encriptación TLS implícita
            $mail->Port = 465;                                          // Puerto TCP para conectarse; usa 587 si has establecido `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Destinatarios
            $mail->setFrom('joseangelmarquez080802@gmail.com', 'SIAUTO');
            $mail->addAddress('joseangelmarquez080802@gmail.com', 'Empleados de Aries');     // Añadir un destinatario
            $mail->addCC('jocelyndeshuef@gmail.com');
            $mail->addCC('lufer.5698@gmail.com');
            $mail->addCC('valencializettet@gmail.com');
            $mail->addBCC('josmargustavopalominocastelan@gmail.com');

            // Contenido
            $mail->isHTML(true);                                  // Establecer el formato del correo a HTML
            $mail->Subject = 'Alerta de Stock';
            $mail->Body = "
                <!DOCTYPE html>
                <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Alerta de Stock</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            width: 100%;
                            max-width: 600px;
                            margin: 0 auto;
                            background-color: #ffffff;
                            border: 1px solid #dddddd;
                            padding: 20px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }
                        .header {
                            background-color: #656ed3;
                            padding: 10px;
                            text-align: center;
                            color: #ffffff;
                        }
                        .content {
                            padding: 20px;
                            text-align: center;
                        }
                        .content h1 {
                            color: #333333;
                        }
                        .content p {
                            color: #666666;
                        }
                        .footer {
                            text-align: center;
                            padding: 10px;
                            background-color: #f4f4f4;
                            color: #999999;
                            font-size: 12px;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h1>Alerta de Stock Bajo</h1>
                        </div>
                        <div class='content'>
                            <h1>¡Aviso Importante!</h1>
                            <p>El producto <strong>$nombre_Producto</strong> se está quedando sin stock.</p>
                            <p>Actualmente quedan solo <strong>$numero_Producto unidades</strong> en nuestro inventario.</p>
                        </div>
                        <div class='footer'>
                            <p>Tintorería Aries.</p>
                            <p>&copy; 2024. Todos los derechos reservados.</p>
                        </div>
                    </div>
                </body>
                </html>
            ";

            $mail->send();
            echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Error de Mailer: {$mail->ErrorInfo}";
        }
    }
}
