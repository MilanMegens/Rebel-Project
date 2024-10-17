<?php
// Start de sessie
session_start();

// Verwijder alle sessievariabelen
session_unset();

// Vernietig de sessie
session_destroy();

// Doorsturen naar de inlogpagina
header("Location: login.php");
exit;
?>
