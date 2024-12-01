<?php
require '../../includes/config/database.php';
$db = conectarDB();
require '../../includes/funciones.php';

incluirTemplate('navbar');

// Verificar si la conexión a la base de datos es exitosa
if (!$db) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

?>
<div class="tablas">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="card">
                    <div class="card-header">
                        <h1 class="m-0">ADMINISTRACION DE CARRITO</h1>
                    </div><!-- /.col -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="bd-example center-buttons">
                                <a href="/TicketXPress/admin/carrito/create.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nuevo</a>
                                <a href="/TicketXPress/admin/reportes/rpt_pdf_total_eventos.php" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> Reporte</a>
                            </div>
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
                                        <th>Usuario</th>
                                        <th>Evento</th>
                                        <th>Servicio</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Consulta con LEFT JOIN para permitir registros sin servicio
                                    $con_sql = '
                                        SELECT c.id, u.nombre AS usuario, e.titulo AS evento, 
                                                s.servicios_adicionales AS servicio, c.cantidad
                                        FROM carrito c
                                        JOIN usuario u ON c.id_usuario = u.id
                                        JOIN evento e ON c.id_evento = e.id
                                        LEFT JOIN servicios s ON c.id_servicio = s.id';  // Cambié INNER JOIN a LEFT JOIN
                                    
                                    // Ejecutar la consulta
                                    $res = mysqli_query($db, $con_sql);

                                    // Comprobar si la consulta fue exitosa
                                    if (!$res) {
                                        // Si la consulta falla, mostrar el error
                                        die("Error en la consulta: " . mysqli_error($db));
                                    }

                                    // Verificar si hay resultados
                                    if (mysqli_num_rows($res) > 0) {
                                        // Mostrar los datos en la tabla
                                        while ($reg = $res->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <a href="view.php?cod=<?php echo $reg['id']; ?>" class="btn btn-warning btn-sm">Ver</a>
                                                    <a href="edit.php?cod=<?php echo $reg['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                                                    <a href="delete.php?cod=<?php echo $reg['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                </td>
                                                <td><?php echo $reg['id']; ?></td>
                                                <td><?php echo $reg['usuario']; ?></td>
                                                <td><?php echo $reg['evento']; ?></td>
                                                <td><?php echo $reg['servicio'] ? $reg['servicio'] : 'Ninguno'; ?></td> <!-- Si servicio es NULL, mostrar 'Ninguno' -->
                                                <td><?php echo $reg['cantidad']; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        // Si no hay resultados, mostrar un mensaje
                                        echo "<tr><td colspan='6' class='text-center'>No hay datos disponibles.</td></tr>";
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

<!-- Aseguramos que los estilos sean correctos -->
<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
</html>
