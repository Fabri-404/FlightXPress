<?php
require '../../includes/config/database.php'; 
require '../../includes/funciones.php'; 
$db = conectarDB(); 

incluirTemplate('navbar'); 

// Verifica si el parámetro "id" existe en la URL y es un ID válido
if (isset($_GET['cod'])) { 
    $id = intval($_GET['cod']); 
    $query = "SELECT * FROM usuario WHERE id = $id"; 
    $result = mysqli_query($db, $query); 
    $record = mysqli_fetch_assoc($result); 

    if (!$record) { 
        echo "Usuario no encontrado."; 
        exit; 
    } 

    // Ejecuta la eliminación si se envía el formulario (método POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        $deleteQuery = "DELETE FROM usuario WHERE id = $id"; 
        $deleteResult = mysqli_query($db, $deleteQuery); 

        if ($deleteResult) { 
            // Redirección y alerta con JavaScript
            echo "<script> 
                    alert('Usuario eliminado correctamente.'); 
                    window.location.href = '/TicketXPress/admin/usuarios/list.php'; 
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
                <h1>Eliminar Usuario</h1>
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
                        <h3 class="card-title">Eliminar Usuario</h3>
                    </div>
                    <form method="post">
                        <div class="card-body">
                            <!-- ID -->
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="hidden" class="form-control" name="id" value="<?php echo $record['id']; ?>">
                                <input type="text" class="form-control" value="<?php echo $record['id']; ?>" disabled>
                            </div>

                            <!-- Nombre -->
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo $record['nombre']; ?>" disabled>
                            </div>

                            <!-- Apellido -->
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" name="apellido" value="<?php echo $record['apellido']; ?>" disabled>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $record['email']; ?>" disabled>
                            </div>

                            <!-- Rol -->
                            <div class="form-group">
                                <label for="rol">Rol</label>
                                <input type="text" class="form-control" name="rol" value="<?php echo $record['rol']; ?>" disabled>
                            </div>

                        </div>

                        <!-- Confirmación de Eliminación -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
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