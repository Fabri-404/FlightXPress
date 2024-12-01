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
    $query = "SELECT * FROM servicios WHERE id = $id";
    $result = mysqli_query($db, $query);

    if ($result) {
        $servicio = mysqli_fetch_assoc($result);
        if (!$servicio) {
            echo "Servicio no encontrado.";
            exit;
        }
    } else {
        echo "<script>alert('Hubo un problema al obtener los datos. Contacte al administrador.');</script>";
        exit;
    }

    // Actualizar registro si se envía el formulario (método POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $servicios_adicionales = mysqli_real_escape_string($db, $_POST['servicios_adicionales']);
        $caracteristicas = mysqli_real_escape_string($db, $_POST['caracteristicas']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $detalle = mysqli_real_escape_string($db, $_POST['detalle']);
        $imagen = $servicio['img']; // Imagen actual

        // Verificar si se ha subido una nueva imagen
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $imgTmpPath = $_FILES['img']['tmp_name'];
            $imgName = $_FILES['img']['name'];
            $imgExtension = pathinfo($imgName, PATHINFO_EXTENSION);
            $imgNewName = uniqid("servicio_") . "." . $imgExtension;

            $uploadPath = '../../uploads/' . $imgNewName;
            if (move_uploaded_file($imgTmpPath, $uploadPath)) {
                $imagen = '/uploads/' . $imgNewName; // Actualiza con la nueva ruta de imagen
            } else {
                echo "<script>alert('Error al cargar la imagen. Inténtelo de nuevo.');</script>";
            }
        }

        // Query de actualización
        $updateQuery = "UPDATE servicios SET 
            servicios_adicionales = '$servicios_adicionales', 
            caracteristicas = '$caracteristicas', 
            precio = '$precio', 
            detalle = '$detalle', 
            img = '$imagen' 
            WHERE id = $id";
        $updateResult = mysqli_query($db, $updateQuery);

        if ($updateResult) {
            echo "<script>
                    alert('Servicio actualizado correctamente.');
                    window.location.href = '/TicketXPress/admin/servicios/list.php';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Hubo un problema al actualizar el servicio. Contacta al administrador.');</script>";
        }
    }
}
?>
<div class="tablas">
<section class="col-sm-6">
    <h1>Editar Servicio</h1>
</section>

<section class="content">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                
                
                <div class="form-group">
                    <label>Servicios Adicionales:</label>
                    <input type="text" name="servicios_adicionales" class="form-control" value="<?php echo htmlspecialchars($servicio['servicios_adicionales']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Características:</label>
                    <input type="text" name="caracteristicas" class="form-control" value="<?php echo htmlspecialchars($servicio['caracteristicas']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Precio:</label>
                    <input type="number" name="precio" class="form-control" value="<?php echo htmlspecialchars($servicio['precio']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Detalle:</label>
                    <textarea name="detalle" class="form-control" required><?php echo htmlspecialchars($servicio['detalle']); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Imagen Actual:</label><br>
                    <img src="<?php echo htmlspecialchars($servicio['img']); ?>" alt="Imagen del Servicio" width="150">
                </div>

                <div class="form-group">
                    <label>Nueva Imagen (Opcional):</label>
                    <input type="file" name="img" class="form-control-file">
                </div>
                <br>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="/TicketXPress/admin/servicios/list.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</section>
</div>

<?php incluirTemplate('footer'); ?>
<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
</html>

