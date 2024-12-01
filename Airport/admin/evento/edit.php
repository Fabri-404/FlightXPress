<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');

// Verificar si el ID de la propiedad está presente en la URL
if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']);

    // Consultar los datos actuales de la propiedad
    $query = "SELECT * FROM evento WHERE id = $id";
    $result = mysqli_query($db, $query);
    $reg = mysqli_fetch_assoc($result);

    if (!$reg) {
        echo "Evento no encontrado.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $ubicacion = $_POST['ubicacion'];  // Corregido typo
        $fecha_evento = $_POST['fecha_evento'];
        $hora = $_POST['hora'];

        // Manejo de la imagen: verificar si hay nueva imagen
        $nombreImagen = $_FILES['imagen']['name'] ? $_FILES['imagen']['name'] : $reg['imagen'];
        if ($_FILES['imagen']['tmp_name']) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['imagen']['type'], $allowedTypes)) {
                $rutaImagen = '../../admin/evento/imagenes/' . $nombreImagen;
                move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);
            } else {
                echo "<script>alert('Solo se permiten imágenes JPEG, PNG o GIF.');</script>";
                exit;
            }
        }

        // Actualizar los datos del evento usando sentencia preparada
        $query = "UPDATE evento SET 
                  titulo = ?, 
                  precio = ?, 
                  imagen = ?, 
                  ubicacion = ?, 
                  hora = ?, 
                  fecha_evento = ? 
                  WHERE id = ?";

        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, 'sssssss', $titulo, $precio, $nombreImagen, $ubicacion, $hora, $fecha_evento, $id);
        $updateResult = mysqli_stmt_execute($stmt);

        if ($updateResult) {
            echo "<script>
                    alert('Evento actualizado correctamente.');
                    window.location.href = '/TicketXPress/admin/evento/list.php';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Error al actualizar el evento.');</script>";
        }
    }
}
?>
<div class="tablas">
<section class="col-sm-6">
    <h1>Editar Evento</h1>
</section>
<section class="content">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="hidden" class="form-control" name="id" value="<?php echo $reg['id']; ?>">
                    <input type="text" class="form-control" value="<?php echo $reg['id']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control" name="imagen" id="imagen">
                    <br>
                    <p>Imagen actual: <img src="/TicketXPress/admin/evento/imagenes/<?php echo htmlspecialchars($reg['imagen']); ?>" width="200"></p>
                </div>
                <div class="form-group">
                    <label>Título</label>
                    <input type="text" name="titulo" class="form-control" value="<?php echo $reg['titulo']; ?>">
                </div>
                <div class="form-group">
                    <label>Ubicación</label>
                    <input type="text" name="ubicacion" class="form-control" value="<?php echo $reg['ubicacion']; ?>">
                </div>
                <div class="form-group">
                    <label>Fecha del Evento</label>
                    <input type="date" name="fecha_evento" class="form-control" value="<?php echo $reg['fecha_evento']; ?>">
                </div>
                <div class="form-group">
                    <label>Hora</label>
                    <input type="time" name="hora" class="form-control" value="<?php echo $reg['hora']; ?>">
                </div>
                <div class="form-group">
                    <label>Precio</label>
                    <input type="text" name="precio" class="form-control" value="<?php echo $reg['precio']; ?>">
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="/TicketXPress/admin/evento/list.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</section>
</div>
<?php incluirTemplate('footer'); ?>
<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
</html>