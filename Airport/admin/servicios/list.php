<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');
?>
<div class="tablas">

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1 class="m-0">ADMINISTRACION DE SERVICIOS</h1>
            </div>
            <div class="card-body">
                <div class="bd-example center-buttons">
                    <a href="/TicketXPress/admin/servicios/create.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nuevo</a>
                    <a href="/TicketXPress/admin/reportes/reporteservicios.php" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Reporte</a>
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
                        <div class="table-container">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>ID</th>
                                        <th>Servicios Adicionales</th>
                                        <th>Imagen</th>
                                        <th>Características</th>
                                        <th>Precio</th>
                                        <th>Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Verificar si se ha enviado un filtro
                                    $filter = isset($_POST['filter']) ? mysqli_real_escape_string($db, $_POST['filter']) : '';

                                    // Consulta para listar servicios, con filtro si es necesario
                                    $con_sql = "SELECT * FROM servicios";
                                    if (!empty($filter)) {
                                        $con_sql .= " WHERE servicios_adicionales LIKE '%$filter%' OR codigo_evento LIKE '%$filter%'";
                                    }

                                    $res = mysqli_query($db, $con_sql);

                                    if ($res) {
                                        while ($reg = $res->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="view.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-warning btn-sm">Ver</a>
                                                    <a href="edit.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-primary btn-sm">Editar</a>
                                                    <a href="delete.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-danger btn-sm">Eliminar</a>
                                                </td>
                                                <td><?php echo $reg['id']; ?></td>
                                                <td><?php echo $reg['servicios_adicionales']; ?></td>
                                                <td> <img src="imagenes/<?php echo $reg['img']; ?>" width="100" height="100"> </td>
                                                <td><?php echo $reg['caracteristicas']; ?></td>
                                                <td><?php echo number_format($reg['precio'], 2); ?> USD</td>
                                                <td><?php echo $reg['detalle']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No se encontraron resultados</td></tr>";
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
</div>

<?php incluirTemplate('footer'); ?>
<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
</html>
