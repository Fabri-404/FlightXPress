<?php 
require '../../includes/config/database.php'; 
require '../../includes/funciones.php'; 
$db = conectarDB(); 
 
incluirTemplate('navbar'); 
 
// Verifica si el parámetro "id" existe en la URL y es un ID válido 
if (isset($_GET['cod'])) { 
    $id = intval($_GET['cod']); 
    $query = "SELECT * FROM evento WHERE id = $id"; 
    $result = mysqli_query($db, $query); 
    $record = mysqli_fetch_assoc($result); 
 
    if (!$record) { 
        echo "Evento no encontrada."; 
        exit; 
    } 
 
    // Ejecuta la eliminación si se envía el formulario (método POST) 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        $deleteQuery = "DELETE FROM evento WHERE id = $id"; 
        $deleteResult = mysqli_query($db, $deleteQuery); 
 
        if ($deleteResult) { 
            // Redirección y alerta con JavaScript 
            echo "<script> 
                    alert('Evento eliminado correctamente.'); 
                    window.location.href = '/TicketXPress/admin/evento/list.php'; 
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
                <h1>Eliminar EVENTO</h1> <!-- Cambiado a "Evento" -->
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
                        <h3 class="card-title">Eliminar Evento</h3> <!-- Cambiado a "Evento" -->
                    </div>
                    <form method="post">
                        <div class="card-body">
                            <!-- ID -->
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="hidden" class="form-control" name="id" value="<?php echo $record['id']; ?>">
                                <input type="text" class="form-control" value="<?php echo $record['id']; ?>" disabled>
                            </div>

                            <!-- Título -->
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" name="titulo" required value="<?php echo $record['titulo']; ?>" disabled>
                            </div>

                            <!-- Precio -->
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="text" class="form-control" name="precio" required value="<?php echo $record['precio']; ?>" disabled>
                            </div>

                            <!-- Ubicación -->
                            <div class="form-group">
                                <label for="ubicacion">Ubicación</label>
                                <input type="text" class="form-control" name="ubicacion" required value="<?php echo $record['ubicacion']; ?>" disabled>
                            </div>

                            <!-- Fecha del Evento -->
                            <div class="form-group">
                                <label for="fecha_evento">Fecha del Evento</label>
                                <input type="date" class="form-control" name="fecha_evento" required value="<?php echo $record['fecha_evento']; ?>" disabled>
                            </div>

                            <!-- Hora del Evento -->
                            <div class="form-group">
                                <label for="hora">Hora</label>
                                <input type="time" class="form-control" name="hora" required value="<?php echo $record['hora']; ?>" disabled>
                            </div>

                            <!-- Imagen -->
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                
                                <br>
                                <p>Imagen actual: <img src="/TicketXPress/admin/evento/imagenes/<?php echo htmlspecialchars($record['imagen']); ?>" width="200"></p>
                            </div>

                        <!-- Confirmación de Desactivación -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-danger" >Eliminar</button>
                            <a href="/TicketXPress/admin/evento/list.php" class="btn btn-secondary">Cancelar</a>
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