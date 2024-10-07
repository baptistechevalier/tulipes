<footer>
    <hr>
        <ul class="navbar-nav">
            <li class="nav-item">
            <?php
            // Vérifie si la session contient un nom d'utilisateur
            if(isset($_SESSION['login'])) {
                // Si un nom d'utilisateur est présent dans la session, affiche un bouton de déconnexion
                echo '<a class="nav-link" href="deconnexion.php">Déconnexion</a>';
            } else {
                // Si aucun nom d'utilisateur n'est présent dans la session, affiche un bouton de connexion
                echo '<a class="nav-link" href="connexions.php">Connexion</a>';
            }
            ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mentions_legales.php">Mentions Légales</a>
            </li>
        </ul>
        <p>Copyright © 2024</p>
</footer>