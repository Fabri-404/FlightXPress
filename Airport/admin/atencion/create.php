<?php
require '../../includes/config/database.php';
$db = conectarDB();
require '../../includes/funciones.php';
incluirTemplate('navbar');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $id_evento = $_POST['id_evento'];
    $mensaje = $_POST['mensaje'];
    $captcha = $_POST['captcha'];

    // Insertar nuevo registro
    $insertQuery = "INSERT INTO atencion (nombre, apellido, email, id_evento, mensaje, captcha) VALUES ('$nombre', '$apellido', '$email', $id_evento, '$mensaje', '$captcha')";
    $insertResult = mysqli_query($db, $insertQuery);

    if ($insertResult) {
        echo "<script>
                alert('Atención registrada correctamente.');
                window.location.href = '/TicketXPress/admin/atencion/list.php';
              </script>";
        exit;
    } else {
        echo "<script>alert('Hubo un problema, contacta al administrador.');</script>";
    }
}
?>
<div class="tablas">
<section class="content-header">
    <h1>Crear Nueva Atención</h1>
</section>
<section class="content">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                </div>
                <div class="form-group">
                    <label>Apellido:</label>
                    <input type="text" name="apellido" class="form-control" placeholder="Apellido" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                <legend>Vendedor</legend>
                    <select name="id_evento" id="id_evento">
                        <?php
                        $con_sql="select * from atencion";
                        $res=mysqli_query($db,$con_sql);
                        while($reg=$res->fetch_assoc()){
                        ?>
                        <option value="<?php echo $reg['id']?>"><?php echo $reg['titulo']." ".$reg['ubicacion']." ".$reg['precio']?></option>
                        
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mensaje:</label>
                    <textarea name="mensaje" class="form-control" placeholder="Escribe tu mensaje aquí" required></textarea>
                </div>
                <div class="form-group">
                    <label>Captcha:</label>
                    <input type="text" name="captcha" class="form-control" placeholder="Captcha" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="/TicketXPress/admin/atencion/list.php" class="btn btn-secondary">Volver</a>
            </form>
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
