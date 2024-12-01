<?php
/*
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: /practica/login.php'); // Redirige al login si no está autenticado
    exit;
}

// Verificar si el usuario tiene el rol adecuado (en este caso, 'administrador')
if ($_SESSION['rol'] !== 'administrador') {
    echo "<script>
            alert('Acceso restringido: No tienes permisos para acceder a esta sección.');
            window.location.href = '/practica/index.php';
          </script>";
    exit;
}
*/
require '../../includes/config/database.php';
$db = conectarDB();
require '../../includes/funciones.php';

incluirTemplate('navbar');
?>
<div class="tablas">
<section class="content-header">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1 class="m-0">ADMINISTRACION DE EVENTOS</h1>
                </div>
                <div class="card-body">
                    <div class="bd-example center-buttons">
                        <a href="/TicketXPress/admin/evento/create.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Nuevo</a>
                        <a href="/TicketXPress/admin/reportes/rpt_pdf_total_eventos.php" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-file-pdf"></i>Reporte</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Id</th>
                                    <th>Imagen</th>
                                    <th>Titulo</th>
                                    <th>Ubicacion</th>
                                    <th>Fecha del evento</th>
                                    <th>Hora</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $con_sql = 'select * from evento';
                                $res = mysqli_query($db, $con_sql);
                                while ($reg = $res->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td>
                                            <a href="view.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-warning btn-sm">Ver</a>
                                            <a href="edit.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-primary btn-sm">Editar</a>
                                            <a href="delete.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-danger btn-sm">Eliminar</a>
                                        </td>
                                        <td> <?php echo $reg['id']; ?></td>
                                        <td> <img src="imagenes/<?php echo $reg['imagen']; ?>" width="100" height="100"> </td>
                                        <td> <?php echo $reg['titulo']; ?></td>
                                        <td> <?php echo $reg['ubicacion']; ?></td>
                                        <td> <?php echo $reg['fecha_evento']; ?></td>
                                        <td> <?php echo $reg['hora']; ?></td>
                                        <td> <?php echo $reg['precio']; ?></td>
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
</div>
</section>

<?php
incluirTemplate('footer');
?>
<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
</html>