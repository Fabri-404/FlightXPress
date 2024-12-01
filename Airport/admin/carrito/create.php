<?php
require '../../includes/config/database.php';
$db = conectarDB();
require '../../includes/funciones.php';
incluirTemplate('navbar');

// Consultar eventos, servicios y usuarios disponibles para seleccionar en el formulario
$usuariosQuery = "SELECT id, nombre FROM usuario";
$usuariosResult = mysqli_query($db, $usuariosQuery);

$eventosQuery = "SELECT id, titulo FROM evento";
$eventosResult = mysqli_query($db, $eventosQuery);

$serviciosQuery = "SELECT id, servicios_adicionales FROM servicios";
$serviciosResult = mysqli_query($db, $serviciosQuery);

?>

<div class="tablas">
<section class="content-header">
    <h1>Crear Nuevo Carrito</h1>
</section>
<section class="content">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="registrarcarrito.php">
                <!-- Usuario -->
                <div class="form-group">
                    <label>Usuario:</label>
                    <select name="id_usuario" class="form-control" required>
                        <?php while($usuario = mysqli_fetch_assoc($usuariosResult)): ?>
                            <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['nombre']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Evento -->
                <div class="form-group">
                    <label>Evento:</label>
                    <select name="id_evento" class="form-control" required>
                        <?php while($evento = mysqli_fetch_assoc($eventosResult)): ?>
                            <option value="<?php echo $evento['id']; ?>"><?php echo $evento['titulo']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Servicio -->
                <div class="form-group">
                    <label>Servicio Adicional:</label>
                    <select name="id_servicio" class="form-control" required>
                        <?php while($servicio = mysqli_fetch_assoc($serviciosResult)): ?>
                            <option value="<?php echo $servicio['id']; ?>"><?php echo $servicio['servicios_adicionales']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Cantidad -->
                <div class="form-group">
                    <label>Cantidad:</label>
                    <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" required>
                </div>
                <br>

                <button type="submit" class="btn btn-primary">Crear Carrito</button>
                <a href="/TicketXPress/admin/carrito/list.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</section>
</div>

<?php incluirTemplate('footer'); ?>
<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
</html>
