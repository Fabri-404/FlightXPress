<?php
require '../../includes/config/database.php';
$db = conectarDB();

// Verificar si se enviaron los datos por POST
if ($_POST) {
    // Recibir los datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $id_evento = $_POST['id_evento'];
    $id_servicio = $_POST['id_servicio'];
    $cantidad = $_POST['cantidad'];

    // Insertar los datos en la tabla "carrito"
    $insertQuery = "
        INSERT INTO carrito (id_usuario, id_evento, id_servicio, cantidad)
        VALUES ($id_usuario, $id_evento, $id_servicio, $cantidad)
    ";

    // Ejecutar la consulta
    $insertResult = mysqli_query($db, $insertQuery);

    // Verificar si la inserción fue exitosa
    if ($insertResult) {
        echo "<script>
                alert('Carrito creado correctamente.');
                window.location.href = '/TicketXPress/admin/carrito/list.php';
              </script>";
    } else {
        echo "<script>alert('Hubo un problema, contacta al administrador.');</script>";
    }
}
?>
