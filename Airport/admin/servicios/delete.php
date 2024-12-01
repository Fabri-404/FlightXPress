<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

// Verifica si el parámetro "cod" existe en la URL y es un ID válido
if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']); // Asegurar que el ID es un número entero
    // Realiza la consulta para obtener los datos del servicio
    $query = "SELECT * FROM servicios WHERE id = $id";
    $result = mysqli_query($db, $query);
    $record = mysqli_fetch_assoc($result);

    // Verifica si el servicio existe
    if (!$record) {
        echo "Servicio no encontrado.";
        exit;
    }

    // Ejecuta la eliminación si se envía el formulario (método POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $deleteQuery = "DELETE FROM servicios WHERE id = $id";
        $deleteResult = mysqli_query($db, $deleteQuery);

        if ($deleteResult) {
            // Redirección y alerta con JavaScript
            echo "<script>
                    alert('Servicio eliminado correctamente.');
                    window.location.href = '/TicketXPress/admin/servicios/list.php';
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
                <h1>Eliminar Servicio</h1>
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
                        <h3 class="card-title">Confirmar Eliminación del Servicio</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <p class="text-danger"><strong>Advertencia:</strong> Esta acción eliminará el servicio permanentemente.</p>
                            
                            <!-- Campo ID del servicio -->
                            <div class="form-group">
                                <label for="id">ID del Servicio</label>
                                <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
                                <input type="text" class="form-control" value="<?php echo $record['id']; ?>" disabled>
                            </div>
                          

                            <!-- Servicios Adicionales -->
                            <div class="form-group">
                                <label for="servicios_adicionales">Servicios Adicionales</label>
                                <input type="text" class="form-control" value="<?php echo $record['servicios_adicionales']; ?>" disabled>
                            </div>
                            
                            <!-- Características -->
                            <div class="form-group">
                                <label for="caracteristicas">Características</label>
                                <input type="text" class="form-control" value="<?php echo $record['caracteristicas']; ?>" disabled>
                            </div>
                            
                            <!-- Precio -->
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="text" class="form-control" value="<?php echo number_format($record['precio'], 2); ?>" disabled>
                            </div>
                            
                            <!-- Detalle -->
                            <div class="form-group">
                                <label for="detalle">Detalle</label>
                                <textarea class="form-control" disabled><?php echo $record['detalle']; ?></textarea>
                            </div>

                            <!-- Imagen -->
                            
                            <div class="form-group">
                                <label for="img">Imagen</label>
                                <p><img src="/TicketXPress/admin/servicios/imagenes/<?php echo htmlspecialchars($record['img']); ?>" width="200" alt="Imagen del servicio"></p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-danger">Confirmar Eliminar</button>
                            <a href="/TicketXPress/admin/servicios/list.php" class="btn btn-secondary">Cancelar</a>
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
