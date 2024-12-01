<?php
include "includes/templates/navbar.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/TicketXPress/build/css/contactanos.css?v=1.6"> <!-- Archivo de estilos -->
</head>

<body>

    <div class="container">
        <h1>- - - CONTACTANOS - - - </h1>
        <!-- Sección de Facebook -->
        <div class="contact-section">
            <div id="carouselFacebook" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./build/img/face1.png" class="d-block w-100" alt="Facebook Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="./build/img/face2.jpg" class="d-block w-100" alt="Facebook Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="./build/img/staff.jpg" class="d-block w-100" alt="Facebook Image 3">
                    </div>
                </div>
            </div>
            <div class="contact-text">
                <h2>Facebook</h2>
                <p>Encuéntranos en Facebook para estar al tanto de nuestras últimas noticias y eventos. 🎉</p>
                <p>Interacciona con nuestra comunidad y recibe recomendaciones personalizadas para tus eventos favoritos.</p>
                <p>Forma parte de una red que conecta a miles de asistentes y organizadores en Bolivia. 📲</p>
            </div>
        </div>
        <!-- Sección de Instagram -->
        <div class="contact-section reverse">
            <div class="contact-text">
                <h2>Instagram</h2>
                <p>Síguenos en Instagram para ver nuestras fotos y videos más recientes. 📸</p>
                <p>Descubre contenido exclusivo, historias detrás de cámaras y los mejores momentos de cada evento.</p>
                <p>¡Etiqueta a tus amigos y comparte tu experiencia con Ticket X Press usando #TicketXPress! 🌟</p>
            </div>
            <div id="carouselInstagram" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./build/img/insta1.png" class="d-block w-100" alt="Instagram Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="./build/img/insta2.jpg" class="d-block w-100" alt="Instagram Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="./build/img/insta3.jpg" class="d-block w-100" alt="Instagram Image 3">
                    </div>
                </div>
            </div>
        </div>


        <!-- Sección de YouTube -->
        <div class="contact-section">
            <div id="carouselYouTube" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./build/img/ytb1.png" class="d-block w-100" alt="YouTube Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="./build/img/ytb2.jpg" class="d-block w-100" alt="YouTube Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="./build/img/ytb3.avif" class="d-block w-100" alt="YouTube Image 3">
                    </div>
                </div>
            </div>
            <div class="contact-text">
                <h2>YouTube</h2>
                <p>Suscríbete a nuestro canal de YouTube para ver nuestros últimos videos y transmisiones en vivo. 🎥</p>
                <p>Aprende más sobre cómo trabajamos y descubre consejos para maximizar tu experiencia en eventos.</p>
                <p>Explora entrevistas, tutoriales y contenido exclusivo de los eventos más destacados. 🚀</p>
            </div>
        </div>

        <!-- Sección de Comunidad -->
        <h1> - - - COMUNIDAD - - - </h1>
        <div class="comment-box">
            <p>"Gracias a Ticket X Press, organizar nuestro evento fue más fácil que nunca. Su sistema es rápido y confiable. ¡Altamente recomendado!"</p>
            <p>- Carlos Mendoza</p>
        </div>
        <div class="comment-box">
            <p>"Siempre compro mis entradas con Ticket X Press. Me encanta lo fácil que es usar su plataforma. ¡Sigan así!"</p>
            <p>- María Fernández</p>
        </div>
        <div class="comment-box">
            <p>"Ticket X Press no solo es práctico, sino que también tiene el mejor soporte al cliente. Resolvieron todas mis dudas rápidamente."</p>
            <p>- Luis Gutiérrez</p>
        </div>
    </div>
    <br><br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
include "includes/templates/footer.php"
?>
