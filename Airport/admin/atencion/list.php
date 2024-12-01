<?php
        require '../../includes/config/database.php';
        require '../../includes/funciones.php';
        $db = conectarDB();

        incluirTemplate('navbar');
        
    ?>
<div class="tablas">
        <section class="content-header">
            <div class="content-header">
                <div class="container-fluid">
                </div><!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="m-0">ADMINISTRACION DE ATENCION</h1>
                        </div>
                        <div class="card-body">
                            <div class="bd-example center-buttons">
                <a href="/TicketXPress/admin/reportes/reporteatencion.php" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-file-pdf"></i>Reporte</a>
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
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>E-mail</th>
                                            <th>id Evento</th>
                                            <th>Mensaje</th>
                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $con_sql='select * from atencion';
                                            $res=mysqli_query($db,$con_sql);
                                            while($reg=$res->fetch_assoc())
                                            {
                                        ?>                                       
                                            <tr>
                                                <td>
                                                    <a href="view.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-warning btn-sm">Ver</a>
                                                    <a href="edit.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-primary btn-sm">Editar</a>
                                                    <a href="delete.php?cod=<?php echo $reg['id']; ?>" class="boton btn btn-danger btn-sm">Eliminar</a>
                                                </td>
                                                <td> <?php echo $reg['id'];?></td>
                                                <td> <?php echo $reg['nombre'];?></td>
                                                <td> <?php echo $reg['apellido'];?></td>
                                                <td> <?php echo $reg['email'];?></td>
                                                <td> <?php echo $reg['id_evento'];?></td>
                                                <td> <?php echo $reg['mensaje'];?></td>
                  

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
    



    <?php incluirTemplate('footer'); ?>
<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
</html>