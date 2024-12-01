<?php
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
    <link rel="stylesheet" href="/TicketXPress/build/css/app.css?v=1.18">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<!---PARTE DE FOOTER-->
<footer>
    <div class="footerContainer">
        
        <div class="adminbotones">
        </div>
        <!-- Mostrar solo si el usuario es administrador -->
        
        
        <div class="socialIcons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>    
        
        <div class="footerNav">
            <button id="scrollToTopBtn" class="scroll-to-top">
                <i class="fas fa-arrow-up"></i>
            </button>
            <ul>
                <li><a href="/TicketXPress/Evento.php">EVENTOS</a></li>
                <li><a href="/TicketXPress/Atencion.php">ATENCION AL CLIENTE</a></li>
                <li><a href="/TicketXPress/Vender.php">VENDE CON T-X-P</a></li>
                <li><a href="/TicketXPress/Faq.php">FAQ</a></li>
                <li><a href="/TicketXPress/Contactanos.php">CONTACTANOS</a></li>
                <li><a href="/TicketXPress/Carrito.php">CARRITO</a></li>
            </ul>
        </div>
        <!-- Íconos sociales -->
        
    </div>
    <div class="footerBottom">
        <p>Copyright &copy;2024 <span class="designer">UMSA WEB - 3</span> GRUPO : 30 </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mostrar el botón cuando se hace scroll hacia abajo
    window.addEventListener('scroll', function() {
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    });

    // Función para ir arriba de la página
    document.getElementById('scrollToTopBtn').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
</body>
</html>