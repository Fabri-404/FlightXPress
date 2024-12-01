<?php
session_start();

// Generar código CAPTCHA
$codigo_captcha = substr(md5(rand()), 0, 6);
$_SESSION['captcha'] = $codigo_captcha;

// Crear imagen
$imagen = imagecreate(100, 40);

// Colores
$fondo = imagecolorallocate($imagen, 255, 255, 255); // Blanco
$texto = imagecolorallocate($imagen, 0, 0, 0);       // Negro

// Añadir el código a la imagen
imagestring($imagen, 5, 15, 10, $codigo_captcha, $texto);

// Mostrar imagen en formato PNG
header('Content-type: image/png');
imagepng($imagen);
imagedestroy($imagen);
?>
