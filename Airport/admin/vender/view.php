<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']);
    $query = "SELECT * FROM vender WHERE id = $id";
    $result = mysqli_query($db, $query);
    $record = mysqli_fetch_assoc($result);

    if (!$record) {
        echo "Ticket no encontrado.";
        exit;
    }
}
?>
<div class="tablas">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ver Ticket Vendido</h1>
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
                        <h3 class="card-title">Detalle del Ticket</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" class="form-control" value="<?php echo $record['id']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="organizador">Organizador</label>
                                <input type="text" class="form-control" value="<?php echo $record['organizador']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="<?php echo $record['email']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" value="<?php echo $record['telefono']; ?>" disabled>
                            </div>
                    
                            <div class="form-group">
                                <label for="evento_mensaje">Mensaje del Evento</label>
                                <textarea class="form-control" disabled><?php echo $record['evento_mensaje']; ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/TicketXPress/admin/vender/list.php" class="btn btn-secondary">Volver</a>
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
