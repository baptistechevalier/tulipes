<?php
// DÃ©marre la session
session_start();

// DÃ©truit toutes les donnÃ©es de la session
session_destroy();

// Redirige l'utilisateur vers la page d'accueil ou une autre page aprÃ¨s la dÃ©connexion
header("Location: index.php");
exit(); // Assure que le script se termine ici
?>