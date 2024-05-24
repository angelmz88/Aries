<?php
// Recibimos los datos del formulario
$clave = $_POST['Clave_Producto_PK'];
// Recibimos otros campos del formulario si es necesario

// Enviamos los datos al primer archivo PHP
$editar_resultado = include 'editar.php';

// Enviamos los datos al segundo archivo PHP
$mail_resultado = include 'empleados/../../../php/mail.php';

// Puedes procesar los resultados si es necesario
// Por ejemplo, verificar si hubo errores en el procesamiento

// Redireccionamos a alguna página de confirmación o a donde necesites
header("Location: empleados/../../../php/mail.php");
exit();
