<?php
require '../../includes/config/database.php';
$db = conectarDB();

require '../../includes/funciones.php';
incluirTemplate('navbar');

// Consulta para obtener los usuarios
$query = 'SELECT id, nombre, apellido, email, password, rol FROM usuario';
$res = mysqli_query($db, $query);

// Manejo de errores si no se obtiene la lista de usuarios
if (!$res) {
    echo "<p>Error al obtener los usuarios.</p>";
    exit;
}
?>
<div class="tablas">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="m-0">ADMINISTRACION DE USUARIOS</h1>
                    </div>
                    <div class="card-body table-responsive p-0">
                    <div class="bd-example center-buttons">
                    <a href="/TicketXPress/admin/usuarios/create.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Nuevo</a>
                    <a href="/TicketXPress/admin/reportes/reporteusuario.php" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Reporte</a>
                    </div>
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>apellido</th>
                                    <th>Email</th>
                                    <th>Rol</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($reg = mysqli_fetch_assoc($res)) {
                                ?>
                                    <tr>
                                    <td>
                                            <a href="view.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-warning btn-sm">Ver</a>
                                            <a href="edit.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-primary btn-sm">Editar</a>
                                            <a href="delete.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-danger btn-sm">Eliminar</a>
                                        </td>
                                        <td> <?php echo $reg['id']; ?></td>
                                        <td> <?php echo $reg['nombre'];?></td>
                                        <td> <?php echo $reg['apellido'];?></td>
                                        <td> <?php echo $reg['email']; ?></td>
                                        <td> <?php echo $reg['rol']; ?></td>
                                       

                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
</div>
<?php
incluirTemplate('footer');
?>
<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
</html>