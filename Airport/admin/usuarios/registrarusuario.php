<?php
require '../../includes/config/database.php';
$db = conectarDB();

if ($_POST) {
    // Recuperar los valores del formulario
    $nombre = $_POST['nombre']; // Nombre
    $apellido = $_POST['apellido']; // Apellido
    $email = $_POST['email']; // Email
    $password = $_POST['password']; // Contraseña
    $rol = $_POST['rol']; // Rol

    // Validación y configuración de la contraseña
    $password_hash = password_hash($password, PASSWORD_BCRYPT); // Encriptar la contraseña

    // Insertar los datos en la base de datos
    $con_sql = "INSERT INTO usuario (nombre, apellido, email, password, rol) 
                VALUES ('$nombre', '$apellido', '$email', '$password_hash', '$rol')";

    $res = mysqli_query($db, $con_sql);

    if ($res) {
        echo "<script> alert('Usuario registrado correctamente.');</script>";
        echo "<script> location.href='list.php'; </script>"; // Redirigir a la lista de usuarios
    } else {
        echo "<script> alert('Hubo un error al registrar el usuario.');</script>";
    }
}
?>
