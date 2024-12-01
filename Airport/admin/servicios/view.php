<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

// Verificar si se ha pasado un código de servicio
if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']); // Asegurar que el ID es un número entero
    // Realizar la consulta a la tabla servicios
    $query = "SELECT * FROM servicios WHERE id = $id";
    $result = mysqli_query($db, $query);
    // Recuperar el registro de servicio
    $record = mysqli_fetch_assoc($result);

    // Verificar si el servicio existe
    if (!$record) {
        echo "Servicio no encontrado.";
        exit;
    }
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ver Servicio</h1>
            </div>
        </div>
    </div>
</section>
<div class="tablas">

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detalle del Servicio</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <!-- Campo ID del servicio -->
                            <div class="form-group">
                                <label for="id">ID del Servicio</label>
                                <input type="text" class="form-control" value="<?php echo $record['id']; ?>" disabled>
                            </div>
                            
                            <!-- Campo Servicios Adicionales -->
                            <div class="form-group">
                                <label for="servicios_adicionales">Servicios Adicionales</label>
                                <input type="text" class="form-control" value="<?php echo $record['servicios_adicionales']; ?>" disabled>
                            </div>
                            <!-- Campo Imagen -->
                            
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <p><img src="/TicketXPress/admin/servicios/imagenes/<?php echo htmlspecialchars($record['img']); ?>" width="200" alt="Imagen del servicio"></p>
                            </div>
                            <!-- Campo Características -->
                            <div class="form-group">
                                <label for="caracteristicas">Características</label>
                                <textarea class="form-control" disabled><?php echo $record['caracteristicas']; ?></textarea>
                            </div>
                            <!-- Campo Precio -->
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="text" class="form-control" value="<?php echo $record['precio']; ?>" disabled>
                            </div>
                            <!-- Campo Detalle -->
                            <div class="form-group">
                                <label for="detalle">Detalle</label>
                                <textarea class="form-control" disabled><?php echo $record['detalle']; ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/TicketXPress/admin/servicios/list.php" class="btn btn-secondary">Volver</a>
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
