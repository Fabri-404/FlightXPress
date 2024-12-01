<?php
    session_start();
    // $_SESSION=[];
    session_destroy();
    //echo "<pre>";
    //var_dump($_SESSION);
    //echo "</pre>";
    header('Location:/TicketXPress/index.php');
?>