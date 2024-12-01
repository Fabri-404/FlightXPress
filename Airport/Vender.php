<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vender con Ticket X Press</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/TicketXPress/build/css/vender.css?v=1.6">
</head>

<body>
    <?php
    include "includes/templates/navbar.php"
    ?>
    <!-- Form Container -->
    <div class="form-container">
        <div class="form-header text-center">
            <img src="./build/img/logo.png" alt="Your Logo">
            <h5>¿Organizas un evento? Déjanos tus datos para contactarte.</h5>
        </div>
        <form method="POST" action="/TicketXPress/admin/vender/regitrartikect.php">
            <div class="form-group mb-3">
                <label for="name">Organizador: <span class="text-danger">*</label>
                <input type="text" name="organizador" class="form-control" placeholder="Organizador" required>
            </div>
            <div class="form-group mb-3">
                <label for="name">Email: <span class="text-danger">*</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group mb-3">
                <label for="name">Teléfono: <span class="text-danger">*</label>
                <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required>
            </div>
            <div class="form-group mb-3">
                <label for="name">Mensaje del Evento: <span class="text-danger">*</label>
                <textarea name="evento_mensaje" class="form-control" placeholder="Escribe el mensaje del evento aquí" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="/TicketXPress/admin/vender/list.php" class="btn btn-secondary">Volver</a>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="venderModal" tabindex="-1" aria-labelledby="venderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="venderModalLabel">Vender con Ticket X Press</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Información y detalles sobre cómo vender con Ticket X Press.</p>
                    <h1>buenas tardes</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php
include "includes/templates/footer.php"
?>