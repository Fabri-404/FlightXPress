<?php
 require '../../includes/config/database.php';
 $db=conectarDB();
 if($_POST){
    // Recuperar los valores del formulario
    $t = $_POST['tit']; // Título
    $pr = $_POST['prec']; // Precio
    $im = $_FILES["im"]["name"]; // Nombre de la imagen
    $ub = $_POST['ub']; // Ubicación
    $fecha_evento = $_POST['fecha_evento']; // Fecha del evento
    $hora = $_POST['hora']; // Hora

    // Validación y configuración de la imagen
    $nom_im = $_FILES["im"]["name"];
    $tipo_im = strtolower(pathinfo($nom_im, PATHINFO_EXTENSION));
    $size_im = $_FILES["im"]["size"]; // en bytes
    $directorio = '/bienes/admin/evento/imagenes/'; // Asegúrate de tener esta carpeta en el servidor

    // Insertar los datos en la base de datos
    $con_sql = "INSERT INTO evento (titulo, precio, imagen, ubicacion, fecha_evento, hora) 
                VALUES ('$t', '$pr', '$im', '$ub', '$fecha_evento', '$hora')";

    $res = mysqli_query($db, $con_sql);

    if ($res) {
        // Subir la imagen al servidor
        $tmp = $_FILES['im']['tmp_name'];
        $upload_success = move_uploaded_file($tmp, '../../admin/evento/imagenes/' . $im);

        if ($upload_success) {
            echo "<script> alert('Evento registrado correctamente.');</script>";
            echo "<script> location.href='list.php'; </script>"; // Redirigir a la lista de eventos
        } else {
            echo "<script> alert('Error al subir la imagen.');</script>";
        }
    } else {
        echo "<script> alert('Hubo un error al registrar el evento.');</script>";
    }
}
?>
