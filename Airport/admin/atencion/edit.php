<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

// Verifica si el parámetro "id" existe en la URL y es un ID válido
if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']);
    $query = "SELECT * FROM atencion WHERE id = $id";
    $result = mysqli_query($db, $query);
    $atencion = mysqli_fetch_assoc($result);

    if (!$atencion) {
        echo "Atención no encontrada.";
        exit;
    }

    // Actualizar registro si se envía el formulario (método POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $id_evento = $_POST['id_evento'];
        $mensaje = $_POST['mensaje'];
         $captcha = $_POST['captcha'];

        $updateQuery = "UPDATE atencion SET 
            nombre = '$nombre', 
            apellido = '$apellido', 
            email = '$email', 
            id_evento = $id_evento, 
            mensaje = '$mensaje', 
         captcha = '$captcha' 
            WHERE id = $id";
        $updateResult = mysqli_query($db, $updateQuery);

        if ($updateResult) {
            
            echo "<script>
                    Swal.fire({
                    title: 'Actualizado!',
                    text: 'Atención actualizada correctamente.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/TicketXPress/admin/atencion/list.php';
                    }
                    });
                </script>";
            exit;
        } else {
            echo "<script>
                    Swal.fire({
                    title: 'Error!',
                    text: 'Hubo un problema, contacta al administrador.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                    });
                </script>";
        }
        
    }
}
?>
<div class="tablas">
<section class="col-sm-6">
    <h1>Editar Atención</h1>
</section>
<section class="content">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" class="form-control" value="<?php echo $atencion['nombre']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Apellido:</label>
                    <input type="text" name="apellido" class="form-control" value="<?php echo $atencion['apellido']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $atencion['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label>ID Evento:</label>
                    <input type="number" name="id_evento" class="form-control" value="<?php echo $atencion['id_evento']; ?>">
                </div>
                <div class="form-group">
                    <label>Mensaje:</label>
                    <textarea name="mensaje" class="form-control" required><?php echo $atencion['mensaje']; ?></textarea>
                </div>
        

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="/TicketXPress/admin/atencion/list.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</section>
</div>
<?php incluirTemplate('footer'); ?>
<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>