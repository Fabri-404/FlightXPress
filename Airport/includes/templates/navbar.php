<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
$nombreUsuario = $_SESSION['nombre'] ?? '';
if (!isset($_SESSION)) {
    session_start();
}

// Verificar si 'rol' está definido en la sesión antes de acceder a él
$isAdmin = isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket X Press</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Airport/build/css/navbar.css?v=1.29">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <!---PARTE DE NAVBAR-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <!-- LOGO A LA IZQUIERDA -->
            <a class="navbar-brand" href="/Airport/index.php">
                <img src="/Airport/build/img/logo.png" alt="Logo" ;style="height: 100px; width: 210px;">
                <!--  style="height: 80px; width: 180px;" -->
            </a>

            <!-- BOTON -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- BARRA DE NAVEGACION CENTRADA -->
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/Airport/Evento.php">FLIGHTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Airport/Atencion.php">CUSTOMER SERVICEE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Airport/Vender.php">OFFERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Airport/Faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Airport/Contactanos.php">CONTACT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Airport/Carrito.php">
                            <img src="/Airport/build/img/iconocarrito.png" alt="Cart Icon" style="height: 30px; width: 30px">
                        </a>
                    </li>


                    <?php if ($isAdmin): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/Airport/admin/admin.php">
                                <img src="/Airport/build/img/administrador2.png" alt="Cart Icon" style="height: 35px; width: 35px">
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- LOGGING A LA DERECHA -->
            <ul class="navbar-nav ms-auto">
                <?php if ($auth): ?>
                    <li class="nav-item d-flex align-items-center">
                        <span class="nav-link"><?php echo htmlspecialchars($nombreUsuario); ?></span>
                        <a href="/Airport/cerrarsesion.php" class="nav-link">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            Sign Out
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="/Airport/log.php" class="nav-link">
                            <img src="/Airport/build/img/iconolog.png" alt="Icono de no registrado">
                            Sign In
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Archivos de JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="PAG/modal.js"></script>
</body>

</html>