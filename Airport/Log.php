<?php
require 'includes/config/database.php'; // Asegúrate de que la ruta es correcta
$db = conectarDB(); // Conectar a la base de datos
$errores = [];
$success = false; // Variable para manejar el éxito del registro

// Comprobar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger la acción (login o register)
    $action = $_POST['action'] ?? '';

    if ($action === 'register') {
        // Registro de usuario
        // Recoger los datos del formulario
        $nombre = mysqli_real_escape_string($db, $_POST['nombre'] ?? '');
        $apellido = mysqli_real_escape_string($db, $_POST['apellido'] ?? '');
        $email = mysqli_real_escape_string($db, $_POST['email'] ?? '');
        $password = mysqli_real_escape_string($db, $_POST['password'] ?? '');
        $rol = 'cliente'; // Por defecto, el rol será cliente

        // Verificar si el email contiene '@admin.com' para asignar el rol como 'admin'
        if (strpos($email, '@admin.com') !== false) {
            $rol = 'admin';
        }

        // Validar los campos
        if (!$nombre) $errores[] = "El nombre es obligatorio";
        if (!$apellido) $errores[] = "El apellido es obligatorio";
        if (!$email) $errores[] = "El email es obligatorio";
        if (!$password) $errores[] = "El password es obligatorio";

        // Verificar si ya existe el email
        if (empty($errores)) {
            $query = "SELECT * FROM usuario WHERE email = '$email'";
            $resultado = mysqli_query($db, $query);
            if (mysqli_num_rows($resultado) > 0) {
              echo "<button id='btnSA_3' type='button' class='btn btn-outline-warning'>Confirmación</button>";
              echo "<script>
              alert('Este correo ya está registrado. Intente iniciar sesión o use otro correo.');
              window.location.href = 'log.php';
            </script>";
              exit; 
            } else {
                // Si no hay errores, proceder con el registro
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                $query = "INSERT INTO usuario (nombre, apellido, email, password, rol) VALUES ('$nombre', '$apellido', '$email', '$passwordHash', '$rol')";
                $resultado = mysqli_query($db, $query);

                if ($resultado) {
                    $success = true;
                    
                    echo "<script>
                            alert('Se registro correctamente');
                             window.location.href = 'log.php';
                          </script>";
                    exit;
                } else {
                    $errores[] = "Hubo un problema al registrar el usuario. Por favor, contacte con el administrador.";
                }
            }
        }
    } elseif ($action === 'login') {
        // Login de usuario
        $email = mysqli_real_escape_string($db, $_POST['email'] ?? '');
        $password = mysqli_real_escape_string($db, $_POST['password'] ?? '');

        // Validar los campos
        if (!$email) $errores[] = "El email es obligatorio";
        if (!$password) $errores[] = "El password es obligatorio";

        if (empty($errores)) {
            $query = "SELECT * FROM usuario WHERE email = '$email'";
            $resultado = mysqli_query($db, $query);

            if ($resultado && mysqli_num_rows($resultado) === 1) {
                $usuario = mysqli_fetch_assoc($resultado);
                if (password_verify($password, $usuario['password'])) {
                    session_start();
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['nombre'] = $usuario['nombre']; // Almacenar el nombre del usuario en la sesión
                    $_SESSION['rol'] = $usuario['rol'];
                    $_SESSION['login'] = true;
                    $_SESSION['id_usuario'] = $usuario['id']; // Asegúrate de que el campo 'id' existe en la tabla usuario


                    // Redirigir al inicio o página protegida
                    header('Location: /TicketXPress/index.php');
                    exit;
                } else {
                    $errores[] = "El password es incorrecto";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/869dc8f5ef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/TicketXPress/build/css/log.css?v=1.6" />
    <title>Login / Registro</title>
</head>
<body>
    <button id="backButton" onclick="goBack()">VOLVER</button>
    <div class="container" id="container">
        <!-- Formulario de Registro -->
        <div class="form-container sign-up-container">
            <form action="log.php" method="POST">
                <h1>Crea tu Cuenta</h1>

                <?php if ($success): ?>
                    <div class="alert alert-success">¡Te has registrado exitosamente! Ahora puedes iniciar sesión.</div>
                <?php endif; ?>

                <?php foreach ($errores as $error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endforeach; ?>

                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google" id="red"></i></a>
                    <a href="#" class="social"><i class="fab fa-apple" id="black"></i></a>
                </div>
                <span>o usa tu email como registro</span>
                <input type="text" name="nombre" placeholder="Nombres" required />
                <input type="text" name="apellido" placeholder="Apellidos" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Contraseña" required />
                
                <button id="lila" type="submit">Registrar</button>
                <input type="hidden" name="action" value="register">
            </form>
        </div>

        <!-- Formulario de Login -->
        <div class="form-container sign-in-container">
            <form action="log.php" method="POST">
                <h1>Iniciar Sesión</h1>

                <?php foreach ($errores as $error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endforeach; ?>

                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google" id="red"></i></a>
                    <a href="#" class="social"><i class="fab fa-apple" id="black"></i></a>
                </div>
                <span>o usa tu email</span>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <a href="#">Olvidaste tu contraseña?</a>
                <button type="submit">Iniciar sesión</button>
                <input type="hidden" name="action" value="login">
            </form>
        </div>

        <!-- Overlay para cambiar entre formularios -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>¡Bienvenido!</h1>
                    <p>Inicia sesión con tu cuenta</p>
                    <button class="ghost" id="signIn">Inicia sesión</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Bienvenido a Ticket X Press</h1>
                    <p>Crea tu cuenta</p>
                    <button class="ghost" id="signUp">Registrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./build/js/log.js"></script>
    <script>
      function goBack() {
        window.history.back();
      }
    </script>
    <script src="/TicketXPress/build/js/log.js"></script>
</body>
</html>

