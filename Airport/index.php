<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air X Press</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/TicketXPress/build/css/app.css">
    <link rel="stylesheet" href="/TicketXPress/build/css/index.css?v=1.0">
</head>

<body>
    <?php
    include "includes/templates/navbar.php";
    include "includes/templates/header.php";
    ?>
    <!-----------------------PARTE CONTENIDO--------------------->
    <div class='contenido'>
        <!-- <link rel="stylesheet" href="./EstilosCSS/main.css"> -->
        <h1>- - - POPULAR FLIGHTS - - -</h1>
        <div class="bannerevento">
            <div class="card mb-3">
                <img src="/TicketXPress/build/img/bannermain.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Electro Preste 2025</h5>
                    <p class="card-text">Vive la fusión de música, arte y tecnología en una experiencia única. ¡No te lo pierdas!</p>
                    <p class="card-text"><small class="text-body-secondary">Actualizada hace 3 minutos</small></p>
                </div>
            </div>
        </div>
        <div class="tarjetas">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100 tarjeta-espacio">
                        <img src="/TicketXPress/build/img/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Noche en el cementerio</h5>
                            <p class="card-text">trévete a vivir una experiencia única y llena de misterio. Sumérgete en una noche de historias, recorridos y leyendas en un ambiente oscuro y enigmático. ¿Te atreves a asistir?
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">Actualizada hace 3 minutos</small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 tarjeta-espacio">
                        <img src="/TicketXPress/build/img/img2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Star Wars Fan Club Bolivia</h5>
                            <p class="card-text">Únete a otros fans de Star Wars para celebrar la saga que nos une a todos. Disfruta de charlas, cosplay, actividades y sorpresas en un evento lleno de la Fuerza.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">Actualizada hace 10 minutos</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1> - - - ABOUT US - - - </h1>
        <div class="timeline">
            <div class="timeline-line"></div> <!-- Línea amarilla central -->
            <div class="timeline-container left">
                <div class="content">
                    <h3>Our Beginnings</h3>
                    <p>Air X Press was founded with the mission to provide a safe and reliable platform for air travel in Bolivia, offering seamless connections to the world through advanced technology and a commitment to exceptional service.</p>
                </div>
                <div class="circle">
                    <img src="./build/img/som1">
                </div>
            </div>

            <div class="timeline-container right">
                <div class="circle">
                    <img src="./build/img/somos2.png">
                </div>
                <div class="content">
                    <h3>Trust</h3>
                    <p>As trust in Air X Press grew, more passengers and travel partners began to choose us as their preferred airline, relying on us to deliver safe and memorable flying experiences.</p>
                </div>
            </div>
            <div class="timeline-container left">
                <div class="content">
                    <h3>Innovation</h3>
                    <p>Air X Press focused on enhancing the travel experience by introducing features such as seamless booking, flexible payment options, and world-class customer service, making flying more accessible and enjoyable for everyone.</p>
                </div>
                <div class="circle">
                    <img src="./build/img/somos3.png">
                </div>
            </div>
            <div class="timeline-container right">
                <div class="circle">
                    <img src="./build/img/somos4">
                </div>
                <div class="content">
                    <h3>Connecting Bolivia to the World</h3>
                    <p>Today, Air X Press has become one of Bolivia's leading airlines, connecting thousands of passengers to unforgettable destinations around the globe, expanding horizons and shaping the future of air travel.</p>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br><br>

        <h1>- - - MOST VISITED COUNTRIES LATELY - - -</h1>
        <div class="cuidades">
            <div id="carouselExampleFade" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/TicketXPress/build/img/santa.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/TicketXPress/build/img/cocha.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/TicketXPress/build/img/potosi.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/TicketXPress/build/img/beni.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/TicketXPress/build/img/oruro.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <br><br><br><br>
        <?php
// Conectar a la base de datos
require 'includes/config/database.php';
$db = conectarDB();

// Consulta a la tabla de servicios
$query = "SELECT * FROM servicios";
$res = mysqli_query($db, $query);
?>

<h1>- - - SERVICIOS ADICIONALES - - - </h1>
<div class="servicios">
    <div class="row row-cols-1 row-cols-md-2 g-4">

        <?php
        // Generar dinámicamente las tarjetas de servicios
        while ($servicio = mysqli_fetch_assoc($res)) {
        ?>
            <div class="col">
                <div class="card">
                    <img src="/TicketXPress/admin/servicios/imagenes/<?php echo $servicio['img']; ?>" class="card-img-top" alt="<?php echo $servicio['servicios_adicionales']; ?>">
                    
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $servicio['servicios_adicionales']; ?></h5>

                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalServicio<?php echo $servicio['id']; ?>">
                            Mas Informacion
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalServicio<?php echo $servicio['id']; ?>" tabindex="-1" aria-labelledby="modalServicioLabel<?php echo $servicio['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 black-text" id="modalServicioLabel<?php echo $servicio['id']; ?>">
                                            <?php echo $servicio['servicios_adicionales']; ?>
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Características del servicio -->
                                        <h3>Características</h3>
                                        <p><?php echo nl2br($servicio['caracteristicas']); ?></p>

                                        <!-- Precio y Detalles -->
                                        <h3>Precio y Detalles</h3>
                                        <p>Precio del Servicio: Bs <?php echo number_format($servicio['precio'], 2, ',', '.'); ?></p>
                                        <p><?php echo nl2br($servicio['detalle']); ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <form action="agregar_carrito.php" method="POST">
                                            <input type="hidden" name="id_servicio" value="<?php echo $servicio['id']; ?>">
                                            <button type="submit" class="btn btn-primary">Tomar Pedido</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>


    </div>
    <!-----------------------FIN PARTE CONTENIDO--------------------->

    <script>
        function agregarAlCarrito(paquete) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'agregar_al_carrito.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert('Paquete agregado al carrito');
                }
            };
            xhr.send('paquete=' + paquete);
        }
    </script>



    <?php
    include "includes/templates/footer.php"
    ?>


</body>

</html>