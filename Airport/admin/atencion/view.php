<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']);
    $query = "SELECT * FROM atencion WHERE id = $id";
    $result = mysqli_query($db, $query);
    $record = mysqli_fetch_assoc($result);

    if (!$record) {
        echo "Atención no encontrada.";
        exit;
    }
}
?>
<div class="tablas">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ver Atención</h1>
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
                        <h3 class="card-title">Detalle de la Atención</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" class="form-control" value="<?php echo $record['id']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" value="<?php echo $record['nombre']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" value="<?php echo $record['apellido']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="<?php echo $record['email']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="id_evento">ID Evento</label>
                                <input type="text" class="form-control" value="<?php echo $record['id_evento']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="mensaje">Mensaje</label>
                                <textarea class="form-control" disabled><?php echo $record['mensaje']; ?></textarea>
                            </div>
                           
                        </div>
                        <div class="card-footer">
                            <a href="/TicketXPress/admin/atencion/list.php" class="btn btn-secondary">Volver</a>
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