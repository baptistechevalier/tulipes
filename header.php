<?php 
session_start(); 
require_once('db_connect.php');

$role = $_SESSION['idrole'] ?? '1'; // Par défault on a 'idrole' = 1 si personne est connecté
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arras Game</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">🎮</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="liste_tournoi.php">Tournois</a>
                    </li>
                    <li>
                    <?php
                    // Vérifie si la session contient un nom d'utilisateur
                    if(isset($_SESSION['pseudo'])) {
                        // Si un nom d'utilisateur est présent dans la session, affiche un bouton de déconnexion
                        echo '<a class="nav-link" href="deconnexion.php">Déconnexion</a>';
                    } else {
                        // Si aucun nom d'utilisateur n'est présent dans la session, affiche un bouton de connexion
                        echo '<a class="nav-link" href="connexions.php">Connexion</a>';
                    }
                    ?>
                    </li>                  
                    <li>
                        <?php if(isset($_SESSION['idrole']) && $_SESSION['idrole'] == '2'){
                            echo '<a class="nav-link" href="crudtournois.php">Gérer les tournois</a>';
                        } 
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>