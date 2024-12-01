<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

// Verifica si el parámetro "cod" existe en la URL y es un ID válido
if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']);
    
    // Consulta para obtener los datos del carrito, usando LEFT JOIN
    $query = "
        SELECT c.id, u.nombre AS usuario, e.titulo AS evento, s.servicios_adicionales AS servicio, c.cantidad
        FROM carrito c
        LEFT JOIN usuario u ON c.id_usuario = u.id
        LEFT JOIN evento e ON c.id_evento = e.id
        LEFT JOIN servicios s ON c.id_servicio = s.id
        WHERE c.id = $id
    ";
    $result = mysqli_query($db, $query);
    $record = mysqli_fetch_assoc($result);

    // Si no se encuentra el carrito, mostrar un mensaje de error
    if (!$record) {
        echo "Carrito no encontrado.";
        exit;
    }

    // Ejecuta la eliminación si se envía el formulario (método POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Eliminar el registro del carrito
        $deleteQuery = "DELETE FROM carrito WHERE id = $id";
        $deleteResult = mysqli_query($db, $deleteQuery);

        if ($deleteResult) {
            // Redirección y alerta con JavaScript
            echo "<script>
                    alert('Carrito eliminado correctamente.');
                    window.location.href = '/TicketXPress/admin/carrito/list.php';
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
                <h1>Eliminar Carrito</h1>
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
                        <h3 class="card-title">Eliminar Carrito</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="hidden" class="form-control" name="id" value="<?php echo $record['id']; ?>">
                                <input type="text" class="form-control" value="<?php echo $record['id']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="usuario" required value="<?php echo $record['usuario']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="evento">Evento</label>
                                <input type="text" class="form-control" name="evento" required value="<?php echo $record['evento']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="servicio">Servicio</label>
                                <input type="text" class="form-control" name="servicio" required value="<?php echo $record['servicio']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" required value="<?php echo $record['cantidad']; ?>" disabled>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-danger">Confirmar Eliminar</button>
                            <a href="/TicketXPress/admin/carrito/list.php" class="btn btn-secondary">Cancelar</a>
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

