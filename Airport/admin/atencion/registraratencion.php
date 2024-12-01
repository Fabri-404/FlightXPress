<?php
require '../../includes/config/database.php';
$db = conectarDB();

if ($_POST) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $id_evento = $_POST['id_evento'];
    $mensaje = $_POST['mensaje'];
    $captcha = $_POST['captcha'];

    $con_sql = "INSERT INTO atencion (nombre, apellido, email, id_evento, mensaje, captcha)
                VALUES ('$nombre', '$apellido', '$email', $id_evento, '$mensaje', '$captcha')";
    $res = mysqli_query($db, $con_sql);

    if ($res) {
        echo "<script>
                alert('Atención registrada correctamente.');
                window.location.href = '/TicketXPress/admin/atencion/list.php';
              </script>";
    } else {
        echo "<script>alert('Hubo un problema, contacta al administrador.');</script>";
    }
}
?>
