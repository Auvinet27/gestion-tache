<?php
// Démarrer la session
session_start();

// Détruire la session et toutes les variables associées
session_unset();
session_destroy();

// Rediriger l'utilisateur vers la page de connexion
header("Location: connexion.php");
exit();
