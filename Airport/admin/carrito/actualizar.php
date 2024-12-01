<?php
session_start();
require '../../includes/config/database.php';
$db = conectarDB();


// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del carrito y la acción
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    // Verificar que el ID sea válido
    if ($id > 0) {
        // Obtener la cantidad actual del carrito
        $query = "SELECT cantidad FROM carrito WHERE id = $id";
        $resultado = mysqli_query($db, $query);

        if ($resultado && mysqli_num_rows($resultado) === 1) {
            $carrito = mysqli_fetch_assoc($resultado);
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

            // Redirigir de vuelta al carrito
            header('Location: carrito.php');
            exit;
        } else {
            // Si no se encontró el registro, mostrar error
            echo "Error: No se encontró el producto en el carrito.";
        }
    } else {
        echo "Error: ID no válido.";
    }
} else {
    echo "Acceso no permitido.";
}
