<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

// Verifica si el parámetro "cod" existe en la URL y es un ID válido
if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']);
    $query = "SELECT * FROM vender WHERE id = $id";
    $result = mysqli_query($db, $query);
    $TicketXPress = mysqli_fetch_assoc($result);

    if (!$TicketXPress) {
        echo "Ticket no encontrado.";
        exit;
    }

    // Actualizar registro si se envía el formulario (método POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $organizador = $_POST['organizador'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $evento_mensaje = $_POST['evento_mensaje'];

        $updateQuery = "UPDATE vender SET 
            organizador = '$organizador', 
            email = '$email', 
            telefono = '$telefono', 
            evento_mensaje = '$evento_mensaje' 
            WHERE id = $id";
        $updateResult = mysqli_query($db, $updateQuery);

        if ($updateResult) {
            echo "<script>
                    alert('Ticket actualizado correctamente.');
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
<section class="col-sm-6">
    <h1>Editar Ticket</h1>
</section>
<section class="content">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                
                <div class="form-group">
                    <label>Organizador:</label>
                    <input type="text" name="organizador" class="form-control" value="<?php echo $TicketXPress['organizador']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $TicketXPress['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Teléfono:</label>
                    <input type="text" name="telefono" class="form-control" value="<?php echo $TicketXPress['telefono']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Mensaje del Evento:</label>
                    <textarea name="evento_mensaje" class="form-control" required><?php echo $TicketXPress['evento_mensaje']; ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="/TicketXPress/admin/vender/list.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</section>
</div>
<?php incluirTemplate('footer'); ?>
<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
</html>