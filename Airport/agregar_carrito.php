<?php
session_start();

// Verificar que el usuario esté logeado
if (!isset($_SESSION['id_usuario'])) {
    echo "Debe iniciar sesión para agregar un evento al carrito.";
    exit;
}

// Obtener datos del formulario
$id_usuario = $_SESSION['id_usuario'];
$id_evento = $_POST['id_evento'];
$id_servicio = empty($_POST['id_servicio']) ? null : intval($_POST['id_servicio']);
$cantidad = $_POST['cantidad'] ?? 0;

// Conectar a la base de datos
require 'includes/config/database.php';
$db = conectarDB();

// Validar si el evento ya existe en el carrito del usuario
$sqlCheck = "SELECT id FROM carrito WHERE id_usuario = ? AND id_evento = ?";
$stmtCheck = $db->prepare($sqlCheck);
$stmtCheck->bind_param("ii", $id_usuario, $id_evento);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    // Si ya existe, mostrar alerta y redirigir
    echo "<script>
            alert('El evento ya está en tu carrito.');
            window.location.href = '/TicketXPress/evento.php';
          </script>";
    exit;
}

// Si no existe, insertar un nuevo registro en la tabla carrito
$sqlInsert = "INSERT INTO carrito (id_usuario, id_evento, id_servicio, cantidad) VALUES (?, ?, ?, ?)";
$stmtInsert = $db->prepare($sqlInsert);
$stmtInsert->bind_param("iiii", $id_usuario, $id_evento, $id_servicio, $cantidad);

if ($stmtInsert->execute()) {
    echo "<script>
            alert('Evento agregado al carrito exitosamente!');
            window.location.href = '/TicketXPress/evento.php';
          </script>";
    exit;
} else {
    echo "Error al agregar el evento al carrito: " . $stmtInsert->error;
}

$stmtCheck->close();
$stmtInsert->close();
$db->close();
?>
