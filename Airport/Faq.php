<?php
include "includes/templates/navbar.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->

    <link rel="stylesheet" href="/TicketXPress/build/css/faq.css?v=1.15" />
    <title>FAQ - TicketXPress</title>
</head>

<body>
    <h1>- - - PREGUNTAS FRECUENTES - - - </h1>
    <div class="container-fluid">
        
        <div class="faq-container">
            <div class="faq-image">
                <img src="/TicketXPress/build/img/faq.png" alt="FAQ"> <!--CAMBIAR EL COLOR DE LA IMAGEN EL SIGNO DE INTERROGACION-->
            </div>
            
            <div class="container">
                

                <div class="tab">
                    <input type="radio" name="acc" id="acc1">
                    <label for="acc1">
                        <h2>01</h2>
                        <h3>¿Cómo puedo comprar entradas en TicketXPress?</h3>
                    </label>
                    <div class="content">
                        <p>Para comprar entradas, simplemente ingresa al evento de tu preferencia en nuestro sitio web, selecciona la cantidad de entradas que deseas, completa los datos requeridos y realiza el pago seguro. ¡Recibirás tus entradas por correo electrónico al instante!</p>
                    </div>
                </div>

                <div class="tab">
                    <input type="radio" name="acc" id="acc2">
                    <label for="acc2">
                        <h2>02</h2>
                        <h3>¿Es seguro comprar a través de TicketXPress?</h3>
                    </label>
                    <div class="content">
                        <p>Sí, nuestra plataforma utiliza encriptación SSL para proteger tus datos personales y transacciones. Además, trabajamos con métodos de pago confiables y seguros para que tu experiencia sea completamente confiable.</p>
                    </div>
                </div>

                <div class="tab">
                    <input type="radio" name="acc" id="acc3">
                    <label for="acc3">
                        <h2>03</h2>
                        <h3>¿Qué hago si no recibo mis entradas después de la compra?</h3>
                    </label>
                    <div class="content">
                        <p>Si no recibes tus entradas por correo electrónico en el plazo establecido, revisa tu carpeta de spam o correo no deseado. Si aún no las encuentras, contáctanos a través de nuestro formulario de soporte y estaremos encantados de ayudarte.</p>
                    </div>
                </div>

                <div class="tab">
                    <input type="radio" name="acc" id="acc4">
                    <label for="acc4">
                        <h2>04</h2>
                        <h3>¿Puedo obtener un reembolso por mis entradas?</h3>
                    </label>
                    <div class="content">
                        <p>Las políticas de reembolso dependen del evento y de las condiciones del organizador. En caso de cancelación del evento, el reembolso será gestionado según las políticas establecidas. Para más detalles, revisa nuestra sección de términos y condiciones o contacta con el soporte de TicketXPress.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <?php
    include "includes/templates/footer.php"
    ?>