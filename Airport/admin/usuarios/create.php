<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');
?>
<div class="tablas">
<section class="content-header">
   <h1>Crear Usuario</h1>
</section>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Detalles del Usuario</h3>
               </div>
               <form method="post" action="registrarusuario.php">
                  <div class="card-body">
                     <fieldset>
                        <!-- Nombre del Usuario -->
                        <div class="form-group">
                           <label for="nombre">Nombre</label>
                           <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingrese el nombre del usuario" required>
                        </div>
                        
                        <!-- Apellido -->
                        <div class="form-group">
                           <label for="apellido">Apellido</label>
                           <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Ingrese el apellido del usuario" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                           <label for="email">Correo Electrónico</label>
                           <input type="email" name="email" class="form-control" id="email" placeholder="Ingrese el correo electrónico" required>
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group">
                           <label for="password">Contraseña</label>
                           <input type="password" name="password" class="form-control" id="password" placeholder="Ingrese la contraseña" required>
                        </div>

                        <!-- Rol del Usuario -->
                        <div class="form-group">
                           <label for="rol">Rol</label>
                           <select name="rol" class="form-control" required>
                               <option value="admin">Administrador</option>
                               <option value="cliente">Cliente</option>
                           </select>
                        </div>
                     </fieldset>
                  </div>

                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary" name="btnregistrar">Guardar Usuario</button>
                     <a href="/TicketXPress/admin/usuarios/list.php" class="btn btn-secondary">Volver</a>
                  </div>
               </form>
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