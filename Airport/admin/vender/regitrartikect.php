<?php
require '../../includes/config/database.php';
$db = conectarDB();

if ($_POST) {
    $organizador = $_POST['organizador'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $evento_mensaje = $_POST['evento_mensaje'];

    $con_sql = "INSERT INTO vender (organizador, email, telefono,id_evento, evento_mensaje)
                VALUES ('$organizador', '$email', '$telefono','1','$evento_mensaje')";
    $res = mysqli_query($db, $con_sql);

    if ($res) {
        echo "<script>
                alert('Ticket registrado correctamente.');
                window.location.href = '/TicketXPress/Vender.php';
              </script>";
    } else {
        echo "<script>alert('Hubo un problema, contacta al administrador.');</script>";
    }
}
?>

