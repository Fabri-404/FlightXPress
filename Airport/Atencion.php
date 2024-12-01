<?php
require 'includes/config/database.php';
$db = conectarDB();
require 'includes/funciones.php';
incluirTemplate('navbar');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $id_evento = $_POST['id_evento'];
    $mensaje = $_POST['mensaje'];
    $captcha = $_POST['captcha'];

    // Verificar CAPTCHA
    if ($captcha === $_SESSION['captcha']) {
        // Insertar nuevo registro
        $insertQuery = "INSERT INTO atencion (nombre, apellido, email, id_evento, mensaje, captcha) VALUES ('$nombre', '$apellido', '$email', $id_evento, '$mensaje', '$captcha')";
        $insertResult = mysqli_query($db, $insertQuery);

        if ($insertResult) {
            echo "<script>
                    alert('Atención registrada correctamente.');
                    window.location.href = '/TicketXPress/Atencion.php';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Hubo un problema, contacta al administrador.');</script>";
        }
    } else {
        echo "<script>alert('El código CAPTCHA ingresado es incorrecto. Intenta nuevamente.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/TicketXPress/build/css/atencion.css?v=1.28">
</head>
<body>

    <div class="recovery-text">
        <h1>- - - ATENCION AL CLIENTE - - - </h1>
        <p>
        Es probable que tus dudas se resuelvan consultando bien la información sobre el evento que hay en la web, 
        bien en la sección de Preguntas Frecuentes que encontrarás en el menú superior/inferior. 
        </p> 
        <p>
        Si no encuentras tus entradas, revisa lo que hemos contado arriba acerca de la recuperación de las mismas.
        </p> 
        <p>
            Si aun así, necesitas consultarnos cualquier otra cosa, rellena el formulario o escríbenos directamente a 
            <a href="mailto:compras@ticketxpress.bo" class="email">compras@ticketxpress.bo</a>.
        </p>
        <p>
        ¡Te responderemos enseguida!    
        </p> 
        <p> 
        Muchas gracias.
        </p> 

    <!-- Texto cursivo y centrado -->
    <h2 class="text-center obligatorio-text"><em>Todos los campos son obligatorios</em></h2>

    <!-- Formulario de contacto -->
    <form method="POST" class="text-center contact-form">
        <!-- Campo: Nombres y Apellidos -->
        <div class="form-group mb-3">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
        </div>
        <!-- Campo: Apellidos -->
        <div class="form-group mb-3">
            <input type="text" name="apellido" class="form-control" placeholder="Apellido" required>
        </div>
        <!-- Campo: Email -->
        <div class="form-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <!-- Campo: Seleccione un Evento -->
        <div class="form-group mb-3">
                        <select name="id_evento" id="id_evento" class="form-control" required>
                            <?php
                            $con_sql="select * from evento";
                            $res=mysqli_query($db,$con_sql);
                            while($reg=$res->fetch_assoc()){
                            ?>
                            <option value="<?php echo $reg['id']?>"><?php echo $reg['titulo']." ".$reg['ubicacion']." ".$reg['precio']?></option>
                            
                            <?php
                            }
                            ?>
                        </select>
        </div>
        <!-- Campo: Escriba su mensaje -->
        <div class="form-group mb-3">
            <textarea name="mensaje" class="form-control" placeholder="Escribe tu mensaje aquí" required></textarea>
        </div>
        <!-- Código CAPTCHA -->
        <div class="form-group mb-3">
            <!-- Añadimos la clase 'captcha-img' a la imagen -->
            <img src="/TicketXPress/build/Captcha/generar_captcha.php" alt="CAPTCHA" class="captcha-img mb-3">
            <input type="text" class="form-control" name="captcha" placeholder="Ingrese el código CAPTCHA" required>
        </div>
        <!-- Botones: Refrescar y Enviar -->
        <div class="form-group mb-3 text-center">
            <button type="button" class="btn btn-comprar" id="refreshCaptcha">Refrescar</button>
            <button type="submit" class="btn btn-comprar">Enviar</button>
        </div>
        <!-- Mensaje de enviado -->
        <p class="text-center enviado-text" style="display: none;">¡Mensaje enviado correctamente!</p>
    </form>
    </div>
    <script>
        document.getElementById('refreshCaptcha').addEventListener('click', function() {
    // Seleccionamos la imagen usando la clase 'captcha-img'
    const captchaImage = document.querySelector('.captcha-img');
    // Añadimos un timestamp para evitar que el navegador cachee la imagen
    captchaImage.src = '/TicketXPress/build/Captcha/generar_captcha.php?' + Date.now();
});

    </script>
</body>
</html>
<?php
    include "includes/templates/footer.php"
?>