<?php
require '../../includes/config/database.php';
require '../../includes/funciones.php';
$db = conectarDB();

incluirTemplate('navbar');
?>
<div class="tablas">
<section class="content-header">
   <h1>Crear Evento</h1>
</section>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Detalles del Evento</h3>
               </div>
               <form method="post" action="registrarevento.php" enctype="multipart/form-data">
                  <div class="card-body">
                     <fieldset>
                        <!-- Título del Evento -->
                        <div class="form-group">
                           <label for="tit">Título</label>
                           <input type="text" name="tit" class="form-control" id="tit" placeholder="Ingrese el título del evento" required>
                        </div>
                        
                        <!-- Precio -->
                        <div class="form-group">
                           <label for="prec">Precio</label>
                           <input type="text" name="prec" class="form-control" id="prec" placeholder="Ingrese el precio" required>
                        </div>

                        <!-- Imagen -->
                        <div class="form-group">
                           <label for="im">Imagen</label>
                           <div class="custom-file">
                               <input type="file" name="im" class="custom-file-input" id="im" required onchange="mostrarImagen(event)">
                               <label class="custom-file-label" for="im">Seleccione una imagen</label>
                           </div>
                           <div class="mt-3">
                               <p id="nombreImagen" class="text-muted"></p>
                               <img id="vistaPrevia" src="#" alt="Vista previa de la imagen" style="display: none; max-width: 200px; margin-top: 10px;">
                           </div>
                        </div>

                        <!-- Ubicación -->
                        <div class="form-group">
                           <label for="ub">Ubicación</label>
                           <input type="text" name="ub" class="form-control" id="ub" placeholder="Ingrese la ubicación del evento" required>
                        </div>

                        <!-- Fecha del Evento -->
                        <div class="form-group">
                           <label for="fecha_evento">Fecha del Evento</label>
                           <input type="date" name="fecha_evento" class="form-control" id="fecha_evento" required>
                        </div>

                        <!-- Hora del Evento -->
                        <div class="form-group">
                           <label for="hora">Hora</label>
                           <input type="time" name="hora" class="form-control" id="hora" required>
                        </div>
                     </fieldset>

                     
                  </div>

                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary" name="btnregistrar">Guardar Evento</button>
                     <a href="/TicketXPress/admin/evento/list.php" class="btn btn-secondary">Volver</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
</div>
<script>
   // Función para mostrar la vista previa de la imagen y el nombre del archivo
   function mostrarImagen(event) {
       const input = event.target;
       const vistaPrevia = document.getElementById('vistaPrevia');
       const nombreImagen = document.getElementById('nombreImagen');
       
       // Mostrar el nombre del archivo
       nombreImagen.textContent = `Archivo seleccionado: ${input.files[0].name}`;
       
       // Mostrar la vista previa de la imagen
       const reader = new FileReader();
       reader.onload = function() {
           vistaPrevia.src = reader.result;
           vistaPrevia.style.display = 'block';
       }
       reader.readAsDataURL(input.files[0]);
   }
</script>

<?php
incluirTemplate('footer');
?>
<html>
    <link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">
</html>