<body>
    <?php include(__DIR__ . '/partials/header.php'); ?>
    
    <div class="tulipe-container"></div>
    <script src="script.js"></script>
    <main>
        <div class="au_dessus">
            <div class="container-fluid d-flex flex-column justify-content-center align-items-center" style="flex: 1;">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Bienvenue</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Salut l'ami !</h6>
                        <p class="card-text">Commandons des tulipes ensemble, mais d'abord connecte toi !</p>
                        <?php if(isset($_SESSION['login'])){
                            echo '<a href="login.php" class="btn btn-primary">Ajouter une commande</a>';
                        } else {
                            echo'<a href="login.php" class="btn btn-primary">Se connecter</a>';
                        } ?>           
                    </div>
                </div>
            </div>
        </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </main>
    <?php include(__DIR__.'/partials/footer.php'); ?>
</body>