<?php
session_start();
require 'includes/config/database.php';
$db = conectarDB();

// Verificar si el usuario está logueado
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header('Location: /TicketXPress/index.php');
    exit;
}

// Obtener el ID del usuario logueado desde la sesión
$id_usuario = $_SESSION['id_usuario']; // Asegúrate de almacenar este dato en la sesión al iniciar sesión

// Consulta para obtener los datos del carrito del usuario logueado
$query = "
    SELECT c.id, u.nombre AS usuario, e.titulo AS evento, e.imagen, 
           s.servicios_adicionales AS servicio, c.cantidad
    FROM carrito c
    JOIN usuario u ON c.id_usuario = u.id
    JOIN evento e ON c.id_evento = e.id
    LEFT JOIN servicios s ON c.id_servicio = s.id
    WHERE c.id_usuario = $id_usuario
";
$resultado = mysqli_query($db, $query);

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del carrito y la acción
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    // Verificar que el ID sea válido
    if ($id > 0) {
        if ($action === 'incrementar' || $action === 'decrementar') {
            // Obtener la cantidad actual del carrito
            $query = "SELECT cantidad FROM carrito WHERE id = $id";
            $resultadoCantidad = mysqli_query($db, $query);

            if ($resultadoCantidad && mysqli_num_rows($resultadoCantidad) === 1) {
                $carrito = mysqli_fetch_assoc($resultadoCantidad);
                $cantidad = intval($carrito['cantidad']);

                if ($action === 'incrementar') {
                    // Incrementar la cantidad
                    $cantidad++;
                } elseif ($action === 'decrementar' && $cantidad > 1) {
                    // Decrementar la cantidad si es mayor a 1
                    $cantidad--;
                }

                // Actualizar la cantidad en la base de datos
                $updateQuery = "UPDATE carrito SET cantidad = $cantidad WHERE id = $id";
                mysqli_query($db, $updateQuery);
            } else {
                echo "Error: No se encontró el producto en el carrito.";
            }
        } elseif ($action === 'cancelar') {
            // Eliminar el producto del carrito
            $deleteQuery = "DELETE FROM carrito WHERE id = $id";
            mysqli_query($db, $deleteQuery);
        }

        // Redirigir de vuelta al carrito
        header('Location: carrito.php');
        exit;
    } else {
        echo "Error: ID no válido.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="/TicketXPress/build/css/carrito.css?v=1.0">
</head>
<body class="background-class">
    <?php include 'includes/templates/navbar.php'; ?>

    <div class="container">
        <h1>- - - CARRITO DE COMPRAS - - -</h1>
        
        <!-- Tabla de carrito -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Usuario</th>
                    <th>Evento</th>
                    <th>Servicio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($resultado) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><img src="/TicketXPress/admin/evento/imagenes/<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo $row['evento']; ?>" style="width: 100px; height: auto;"></td>
                            <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                            <td><?php echo htmlspecialchars($row['evento']); ?></td> 
                            <td><?php echo htmlspecialchars($row['servicio'] ?? 'Sin servicio'); ?></td>
                            <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="action" value="decrementar">-</button>
                                    <button type="submit" name="action" value="incrementar">+</button>
                                    <button type="submit" name="action" value="cancelar" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto del carrito?');">Cancelar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No tienes ningún producto en tu carrito.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php include 'includes/templates/footer.php'; ?>
</body>
</html>
