<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

// Verificar si el ID de la propiedad está presente en la URL
if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']);
    $query = "SELECT * FROM evento WHERE id = $id";
    $result = mysqli_query($db, $query);
    $reg = mysqli_fetch_assoc($result);

    if (!$reg) {
        echo "Propiedad no encontrada.";
        exit;
    }
}
?>
<div class="tablas">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ver Evento</h1>
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
                        <h3 class="card-title">Detalles del Evento</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="hidden" class="form-control" name="id" value="<?php echo $reg['id']; ?>">
                                <input type="text" class="form-control" value="<?php echo $reg['id']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <p><img src="/TicketXPress/admin/evento/imagenes/<?php echo htmlspecialchars($reg['imagen']); ?>" width="200" alt="Imagen del evento"></p>
                            </div>
                            
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" name="titulo" value="<?php echo htmlspecialchars($reg['titulo']); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="ubicacion">Ubicaion</label>
                                <input type="text" class="form-control" name="ubicacion" value="<?php echo htmlspecialchars($reg['ubicacion']); ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label for="fecha_evento">Fecha del evento</label>
                                <input type="text" class="form-control" name="fecha_evento" value="<?php echo htmlspecialchars($reg['fecha_evento']); ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label for="hora">Hora</label>
                                <input type="text" class="form-control" name="hora" value="<?php echo htmlspecialchars($reg['hora']); ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="text" class="form-control" name="precio" value="<?php echo htmlspecialchars($reg['precio']); ?>" disabled>
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="/TicketXPress/admin/evento/list.php" class="btn btn-secondary">Volver</a>
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