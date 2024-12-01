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
    
    // Consulta para obtener los datos del carrito, utilizando LEFT JOIN para las relaciones
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

    // Actualizar registro si se envía el formulario (método POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = $_POST['usuario'];
        $evento = $_POST['evento'];
        $servicio = $_POST['servicio'];
        $cantidad = $_POST['cantidad'];

        $updateQuery = "
            UPDATE carrito 
            SET 
                id_usuario = (SELECT id FROM usuario WHERE nombre = '$usuario' LIMIT 1), 
                id_evento = (SELECT id FROM evento WHERE titulo = '$evento' LIMIT 1),
                id_servicio = (SELECT id FROM servicios WHERE servicios_adicionales = '$servicio' LIMIT 1),
                cantidad = $cantidad
            WHERE id = $id
        ";
        $updateResult = mysqli_query($db, $updateQuery);

        if ($updateResult) {
            echo "<script>
                    alert('Carrito actualizado correctamente.');
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
<section class="col-sm-6">
    <h1>Editar Carrito</h1>
</section>
<section class="content">
    <div class="card">
        <div class="card-body">
            <form method="POST">
                
                <div class="form-group">
                    <label>Usuario:</label>
                    <input type="text" name="usuario" class="form-control" value="<?php echo $record['usuario']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Evento:</label>
                    <input type="text" name="evento" class="form-control" value="<?php echo $record['evento']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Servicio:</label>
                    <input type="text" name="servicio" class="form-control" value="<?php echo $record['servicio']; ?>" >
                </div>
                <div class="form-group">
                    <label>Cantidad:</label>
                    <input type="number" name="cantidad" class="form-control" value="<?php echo $record['cantidad']; ?>" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="/TicketXPress/admin/carrito/list.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</section>
</div>
<?php incluirTemplate('footer'); ?>

<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
</html>
