<?php
require '../../includes/config/database.php';
$db = conectarDB();
require '../../includes/funciones.php';
incluirTemplate('navbar');
?>
<div class="tablas">
    <section class="col-sm-6">
        <h1>Registrar Nuevo Servicio</h1>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="registrarservicio.php" enctype="multipart/form-data">
                   
                    <!-- Campo Servicios Adicionales -->
                    <div class="form-group">
                        <label for="servicios_adicionales">Servicios Adicionales:</label>
                        <input type="text" name="servicios_adicionales" class="form-control" placeholder="Servicios Adicionales" required>
                    </div>
                    <!-- Imagen -->
                    <div class="form-group">
    <label for="img">Imagen:</label>
    <div class="custom-file">
        <input type="file" name="img" class="custom-file-input" id="img" accept="image/*" required onchange="mostrarImagen(event)">
        <label class="custom-file-label" for="img">Seleccione una imagen</label>
    </div>
    <div class="mt-3">
        <!-- Nombre del archivo seleccionado -->
        <p id="nombreImagen" class="text-muted"></p>
        <!-- Vista previa de la imagen -->
        <img id="vistaPrevia" src="#" alt="Vista previa de la imagen" style="display: none; max-width: 200px; margin-top: 10px;">
    </div>
</div>
                    <!-- Campo Características -->
                    <div class="form-group">
                        <label for="caracteristicas">Características:</label>
                        <textarea name="caracteristicas" class="form-control" placeholder="Características del servicio"></textarea>
                    </div>
                    <!-- Campo Precio -->
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="number" name="precio" class="form-control" placeholder="Precio del servicio" required step="0.01" min="0">
                    </div>
                    <!-- Campo Detalle -->
                    <div class="form-group">
                        <label for="detalle">Detalle:</label>
                        <textarea name="detalle" class="form-control" placeholder="Detalle del servicio"></textarea>
                    </div>
                    <br>
                    <!-- Botones -->
                    <button type="submit" class="btn btn-primary">Registrar Servicio</button>
                    <a href="/TicketXPress/admin/servicios/list.php" class="btn btn-secondary">Volver</a>
                </form>
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
       
       if (input.files && input.files[0]) {
           const file = input.files[0];
           
           // Validar que sea un archivo de imagen
           if (!file.type.startsWith('image/')) {
               alert('Por favor selecciona un archivo de imagen válido.');
               input.value = ''; // Reiniciar el campo
               vistaPrevia.style.display = 'none';
               nombreImagen.textContent = '';
               return;
           }
           
           // Mostrar el nombre del archivo
           nombreImagen.textContent = `Archivo seleccionado: ${file.name}`;
           
           // Mostrar la vista previa de la imagen
           const reader = new FileReader();
           reader.onload = function(e) {
               vistaPrevia.src = e.target.result;
               vistaPrevia.style.display = 'block';
           }
           reader.readAsDataURL(file);
       }
   }
</script>


<?php
incluirTemplate('footer');
?>
<html>
<link rel="stylesheet" href="/TicketXPress/build/css/tablas.css">

</html>