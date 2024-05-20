<?php
// El mensaje
$mensaje = "Línea 1";

// Enviarlo
if (mail('angelmarquez080802@gmail.com', 'Mi título', $mensaje)) {
    echo 'Correo enviado exitosamente';
} else {
    echo 'Error al enviar el correo';
}
