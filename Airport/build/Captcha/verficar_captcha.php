<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $captcha_usuario = $_POST['captcha'];
    $captcha_sesion = $_SESSION['captcha'];

    // Verificar CAPTCHA
    if ($captcha_usuario === $captcha_sesion) {
        // CAPTCHA correcto, procesar el formulario
        echo "<p style='color: green; text-align: center;'>¡Mensaje enviado correctamente!</p>";
    } else {
        // CAPTCHA incorrecto, mostrar mensaje de error
        echo "<p style='color: red; text-align: center;'>Código CAPTCHA incorrecto. Intente nuevamente.</p>";
    }
}
?>
