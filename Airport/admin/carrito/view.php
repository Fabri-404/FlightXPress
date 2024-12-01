<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

// Verificar si se ha pasado el parámetro 'cod'
if (isset($_GET['cod'])) {
    // Obtener el ID del carrito
    $id = intval($_GET['cod']);

    // Consulta para obtener los detalles del carrito, usuario, evento y servicio
    $query = "
        SELECT c.id, u.nombre AS usuario, e.titulo AS evento, e.imagen AS evento_imagen, 
               s.servicios_adicionales AS servicio, s.img AS servicio_imagen, c.cantidad
        FROM carrito c
        JOIN usuario u ON c.id_usuario = u.id
        JOIN evento e ON c.id_evento = e.id
        LEFT JOIN servicios s ON c.id_servicio = s.id
        WHERE c.id = $id";

    // Ejecutar la consulta
    $result = mysqli_query($db, $query);

    // Si no se encuentra el carrito, mostrar un mensaje
    $record = mysqli_fetch_assoc($result);

    if (!$record) {
        echo "Carrito no encontrado.";
        exit;
    }
}
?>
<div class="tablas">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ver Carrito</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detalle del Carrito</h3>
                        </div>
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" value="<?php echo $record['id']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input type="text" class="form-control" value="<?php echo $record['usuario']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="evento">Evento</label>
                                    <input type="text" class="form-control" value="<?php echo $record['evento']; ?>" disabled>
                                </div>

                                <!-- Mostrar la imagen del evento -->
                                <div class="form-group">
    <label for="evento_imagen">Imagen del Evento</label><br>
    <?php 
    if ($record['evento_imagen']) { ?>
        <img src="/TicketXPress/admin/evento/imagenes/<?php echo $record['evento_imagen']; ?>" alt="Imagen del Evento" class="img-fluid" style="max-width: 300px;">
    <?php } else { ?>
        <p>No hay imagen disponible para este evento.</p>
    <?php } ?>
</div>



                                <div class="form-group">
                                    <label for="servicio">Servicio</label>
                                    <input type="text" class="form-control" value="<?php echo $record['servicio'] ? $record['servicio'] : 'Ninguno'; ?>" disabled>
                                </div>

                                <!-- Mostrar la imagen del servicio -->
                                <div class="form-group">
                                    <label for="servicio_imagen">Imagen del Servicio</label><br>
                                    <?php if ($record['servicio_imagen']) { ?>
                                        <img src="/TicketXPress/admin/servicios/imagenes/<?php echo $record['servicio_imagen']; ?>" alt="Imagen del Servicio" class="img-fluid" style="max-width: 300px;">
                                    <?php } else { ?>
                                        <p>No hay imagen disponible para este servicio.</p>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" class="form-control" value="<?php echo $record['cantidad']; ?>" disabled>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/TicketXPress/admin/carrito/list.php" class="btn btn-secondary">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php incluirTemplate('footer'); ?>

<html>
<link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">

</html>