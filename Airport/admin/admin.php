<?php
include "../includes/templates/navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/TicketXPress/build/css/admin.css?v=1.0">
    <title>Admin - TicketXPress</title>
</head> 
<body>
<h1>PANEL DE ADMINISTRACION</h1>
    <div class="container">
        <div class="adminbotones">
            <div class="buttonGroup">
                <button onclick="location.href='/TicketXPress/admin/evento/list.php'">EVENTOS</button>
                <button onclick="location.href='/TicketXPress/admin/atencion/list.php'">ATENCION</button>
                <button onclick="location.href='/TicketXPress/admin/servicios/list.php'">SERVICIOS</button>
                <button onclick="location.href='/TicketXPress/admin/vender/list.php'">VENDER</button>
                <button onclick="location.href='/TicketXPress/admin/usuarios/list.php'">USUARIOS</button>
                <button onclick="location.href='/TicketXPress/admin/carrito/list.php'">CARRITO</button>
            </div>
        </div>
    </div>
</body>
</html>