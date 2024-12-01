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
    <!-- <link rel="stylesheet" href="/TicketXPress/build/css/app.css"> -->
    <link rel="stylesheet" href="/TicketXPress/build/css/evento.css?v=1.9"> <!-- Archivo de estilos -->
</head>
    
<body>
    <div class="contenidogeneral">
        <!-- Carrusel de imágenes -->
        <div class="container my-5">
            <!-- Subtítulo de eventos destacados -->
            <div class="featured-events-title text-center mb-4">
                <h1>- - - EVENTOS DESTACADOS - - - </h1>
            </div>

            <?php
            require 'includes/config/database.php';
            $db = conectarDB();

            // Obtener eventos de la base de datos
            $con_sql = "SELECT * FROM evento";
            $res = mysqli_query($db, $con_sql);
            ?>

            <!-- Carrusel de eventos -->
            <div class="carousel-container">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">


                        <?php
                        $count = 0; // Contador de eventos para indicadores
                        while ($reg = mysqli_fetch_array($res)) {
                            $active_class = $count == 0 ? 'active' : ''; // El primer elemento será activo
                            echo "<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='$count' class='$active_class' aria-label='Slide $count'></button>";
                            $count++;
                        }
                        ?>
                    </div>

                    <div class="carousel-inner">
                        <?php
                        // Volver a ejecutar la consulta porque ya hemos recorrido el resultado
                        mysqli_data_seek($res, 0);
                        $active_class = 'active'; // El primer evento será el primero en mostrarse
                        while ($reg = mysqli_fetch_array($res)) {
                        ?>
                            <div class="carousel-item <?php echo $active_class; ?>">
                                <!-- Usar un tamaño adecuado para la imagen -->
                                <img src="/TicketXPress/admin/evento/imagenes/<?php echo $reg['imagen']; ?>" class="d-block w-100" alt="Evento <?php echo $reg['titulo']; ?>" loading="lazy">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><?php echo $reg['titulo']; ?></h5>
                                    <p><?php echo date('d M, Y', strtotime($reg['fecha_evento'])); ?>, <?php echo $reg['ubicacion']; ?></p>
                                </div>
                            </div>
                        <?php
                            $active_class = ''; // Desactivar la clase "active" después del primer ítem
                        }
                        ?>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>




            <?php

            // Obtener los eventos de la base de datos
            $con_sql = "SELECT * FROM evento";
            $res = mysqli_query($db, $con_sql);
            ?>

            <!-- Carteles de Eventos -->
            <div class="container my-5">
                <h1 class="event-title text-center mb-4">"¡No te pierdas los próximos espectáculos! Compra tu entrada en Ticket X Press"</h1>
                <div class="row row-cols-1 row-cols-md-3 g-4">


                    <?php
                    while ($reg = mysqli_fetch_array($res)) {
                    ?>

                        <div class="col">
                            <div class="card h-100 show-card">
                                <!-- Mostrar la imagen del evento -->
                                <img src="/TicketXPress/admin/evento/imagenes/<?php echo $reg['imagen']; ?>" class="card-img-top" alt="Evento <?php echo $reg['titulo']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $reg['titulo']; ?></h5>
                                    <p class="card-text">
                                        <i class="fas fa-map-marker-alt"></i> <?php echo $reg['ubicacion']; ?><br>
                                        <i class="fas fa-calendar-alt"></i> <?php echo date('d M, Y', strtotime($reg['fecha_evento'])); ?><br>
                                        <i class="fas fa-clock"></i> <?php echo date('H:i', strtotime($reg['hora'])); ?><br>
                                        Bs <?php echo number_format($reg['precio'], 2, ',', '.'); ?>
                                    </p>

                                    <!-- Formulario para agregar al carrito -->
                                    <form action="agregar_carrito.php" method="POST">
                                        <input type="hidden" name="id_evento" value="<?php echo $reg['id']; ?>">
                                        <input type="hidden" name="id_servicio" value="">
                                        <input type="hidden" name="cantidad" value="0">
                                        <button type="submit" class="btn btn-comprar">Entradas Disponibles</button>
                                    </form>


                                </div>
                            </div>


                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>






        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
include "includes/templates/footer.php"
?>