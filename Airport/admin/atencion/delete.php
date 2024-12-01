<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

// Verifica si el parámetro "id" existe en la URL y es un ID válido
if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']);
    $query = "SELECT * FROM atencion WHERE id = $id";
    $result = mysqli_query($db, $query);
    $record = mysqli_fetch_assoc($result);

    if (!$record) {
        echo "Atención no encontrada.";
        exit;
    }

    // Ejecuta la eliminación si se envía el formulario (método POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $deleteQuery = "DELETE FROM atencion WHERE id = $id";
        $deleteResult = mysqli_query($db, $deleteQuery);

        if ($deleteResult) {
            // Redirección y alerta con SweetAlert2
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    Swal.fire({
                        title: 'Eliminado',
                        text: 'Atención eliminada correctamente.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/TicketXPress/admin/atencion/list.php';
                        }
                    });
                  </script>";
            exit;
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema, contacta al administrador.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                  </script>";
        }
    }
}
?>
<div class="tablas">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Eliminar Atención</h1>
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
                        <h3 class="card-title">Eliminar Atención</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="hidden" class="form-control" name="id" value="<?php echo $record['id']; ?>">
                                <input type="text" class="form-control" value="<?php echo $record['id']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" required value="<?php echo $record['nombre']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" name="apellido" required value="<?php echo $record['apellido']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" required value="<?php echo $record['email']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="id_evento">ID Evento</label>
                                <input type="text" class="form-control" name="id_evento" required value="<?php echo $record['id_evento']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="mensaje">Mensaje</label>
                                <textarea class="form-control" name="mensaje" disabled><?php echo $record['mensaje']; ?></textarea>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-danger">Confirmar Eliminar</button>
                            <a href="/TicketXPress/admin/atencion/list.php" class="btn btn-secondary">Cancelar</a>
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