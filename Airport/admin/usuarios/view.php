<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';

$db = conectarDB();
incluirTemplate('navbar');

// Verificar si el ID de usuario está presente en la URL
if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']); // Asegurarse de que el ID sea un entero válido

    // Consulta para obtener los detalles del usuario
    $query = "SELECT * FROM usuario WHERE id = $id";
    $result = mysqli_query($db, $query);

    // Verificar si la consulta se ejecutó correctamente
    if ($result) {
        $reg = mysqli_fetch_assoc($result);

        // Si no se encuentra un usuario con ese ID
        if (!$reg) {
            echo "Usuario no encontrado.";
            exit;
        }
    } else {
        // Si la consulta falla
        echo "Error al ejecutar la consulta: " . mysqli_error($db);
        exit;
    }
} else {
    echo "ID no proporcionado.";
    exit;
}
?>
<div class="tablas">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ver Usuario</h1>
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
                        <h3 class="card-title">Detalles del Usuario</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="hidden" class="form-control" name="id" value="<?php echo $reg['id']; ?>">
                                <input type="text" class="form-control" value="<?php echo $reg['id']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($reg['nombre']); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" name="apellido" value="<?php echo htmlspecialchars($reg['apellido']); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($reg['email']); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="rol">Rol</label>
                                <input type="text" class="form-control" name="rol" value="<?php echo htmlspecialchars($reg['rol']); ?>" disabled>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="/TicketXPress/admin/usuarios/list.php" class="btn btn-secondary">Volver</a>
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
