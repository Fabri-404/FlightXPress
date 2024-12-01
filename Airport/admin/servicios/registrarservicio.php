<?php
require '../../includes/config/database.php';
$db = conectarDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los valores del formulario
    $servicios_adicionales = $_POST['servicios_adicionales']; 
    $caracteristicas = $_POST['caracteristicas']; 
    $precio = $_POST['precio']; 
    $detalle = $_POST['detalle']; 
    $img = $_FILES['img']['name']; 

    // Validación y configuración de la imagen
    $directorio = __DIR__ . '/imagenes/'; // Ruta absoluta
    $tipo_im = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $size_im = $_FILES['img']['size']; 

    // Validar que el archivo sea una imagen
    if (!in_array($tipo_im, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "<script> alert('El archivo debe ser una imagen válida (jpg, jpeg, png, gif).');</script>";
        exit;
    }

    // Validar el tamaño del archivo
    if ($size_im > 5000000) {
        echo "<script> alert('La imagen es demasiado grande. Máximo 5MB.');</script>";
        exit;
    }

    // Generar un nombre único para la imagen
    $nombreArchivo = 'servicio_' . uniqid() . '.' . $tipo_im;

    // Insertar los datos en la base de datos
    $insertQuery = "INSERT INTO servicios ( servicios_adicionales, img, caracteristicas, precio, detalle) 
                    VALUES ( '$servicios_adicionales', '$nombreArchivo', '$caracteristicas', '$precio', '$detalle')";
    $res = mysqli_query($db, $insertQuery);

    if ($res) {
        // Subir la imagen al servidor
        $tmp = $_FILES['img']['tmp_name'];
        $upload_success = move_uploaded_file($tmp, $directorio . $nombreArchivo);

        if ($upload_success) {
            echo "<script> alert('Servicio registrado correctamente.');</script>";
            echo "<script> location.href='list.php'; </script>";
        } else {
            echo "<script> alert('Error al subir la imagen. Asegúrate de que el directorio existe y tiene permisos.');</script>";
        }
    } else {
        echo "<script> alert('Hubo un error al registrar el servicio.');</script>";
    }
}
?>
