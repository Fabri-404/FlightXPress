<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';

$db = conectarDB();

if (isset($_GET['cod'])) {
    $id = intval($_GET['cod']); // Validar que 'cod' es un ID válido

    // Consulta para obtener el registro
    $query = "SELECT * FROM usuario WHERE id = $id";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $reg = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Usuario no encontrado.'); window.location.href = '/TicketXPress/admin/usuarios/list.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID no válido.'); window.location.href = '/TicketXPress/admin/usuarios/list.php';</script>";
    exit;
}

// Procesar formulario al enviar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escapar los datos enviados
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $rol = mysqli_real_escape_string($db, $_POST['rol']);

    // Consulta para actualizar el usuario
    $query = "UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', email = '$email', rol = '$rol' WHERE id = $id";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo "<script>alert('Usuario actualizado correctamente.'); window.location.href = '/TicketXPress/admin/usuarios/list.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el usuario.');</script>";
    }
}

incluirTemplate('navbar');
?>
<div class="tablas">

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Editar Usuario</h1>
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
                        <h3 class="card-title">Editar Usuario</h3>
                    </div>
                    <form method="post">
                        <div class="card-body">
                            <!-- ID -->
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="hidden" class="form-control" name="id" value="<?php echo $reg['id']; ?>">
                                <input type="text" class="form-control" value="<?php echo $reg['id']; ?>" disabled>
                            </div>

                            <!-- Nombre -->
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($reg['nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>

                            <!-- Apellido -->
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" name="apellido" value="<?php echo htmlspecialchars($reg['apellido'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($reg['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>

                            <!-- Rol -->
                            <div class="form-group">
                                <label for="rol">Rol</label>
                                <input type="text" class="form-control" name="rol" value="<?php echo htmlspecialchars($reg['rol'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>

                        </div>

                        <!-- Confirmación de actualización -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="/TicketXPress/admin/usuarios/list.php" class="btn btn-secondary">Cancelar</a>
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
