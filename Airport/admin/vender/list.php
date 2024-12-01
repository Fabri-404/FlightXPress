
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
                    <div class="card">
                        <div class="card-header">
                            <h1 class="m-0">ADMINISTRACION DE VENDER</h1>
                        </div>
                        <div class="card-body">
                            <div class="bd-example center-buttons">
            
                <a href="/TicketXPress/admin/reportes/reportevender.php" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-file-pdf"></i>Reporte</a>
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
                                            <th>Organizador </th>
                                            <th>Email</th>
                                            <th>Telefono</th>
                                    
                                            <th>Evento mensaje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $con_sql='select * from vender';
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
                                                <td> <?php echo $reg['organizador'];?></td>
                                                <td> <?php echo $reg['email'];?></td>
                                                <td> <?php echo $reg['telefono'];?></td>
                                                
                                                <td> <?php echo $reg['evento_mensaje'];?></td>

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