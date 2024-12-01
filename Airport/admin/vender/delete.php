<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

// Verifica si el parámetro "id" existe en la URL y es un ID válido
if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']);
    $query = "SELECT * FROM vender WHERE id = $id";
    $result = mysqli_query($db, $query);
    $record = mysqli_fetch_assoc($result);

    if (!$record) {
        echo "Ticket no encontrado.";
        exit;
    }

    // Ejecuta la eliminación si se envía el formulario (método POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $deleteQuery = "DELETE FROM vender WHERE id = $id";
        $deleteResult = mysqli_query($db, $deleteQuery);

        if ($deleteResult) {
            // Redirección y alerta con JavaScript
            echo "<script>
                    alert('Ticket eliminado correctamente.');
                    window.location.href = '/TicketXPress/admin/vender/list.php';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Hubo un problema, contacta al administrador.');</script>";
        }
    }
}
?>
<div class="tablas">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Eliminar Ticket Vendido</h1>
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
                        <h3 class="card-title">Eliminar Ticket</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="hidden" class="form-control" name="id" value="<?php echo $record['id']; ?>">
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
                            <button type="submit" class="btn btn-danger">Confirmar Eliminar</button>
                            <a href="/TicketXPress/admin/vender/list.php" class="btn btn-secondary">Cancelar</a>
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