<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Connexion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('./partials/header.php');?>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow" style="width: 400px;">
            <div class="card-body">
                <h3 class="card-title text-center">Connectez-vous</h3>
                <?php
                    require_once("db_connect.php");

                    // Vérification des identifiants
                    if(isset($_POST['login']) && isset($_POST['mdp'])) {
                        $login = $_POST['login'];
                        $mdp = $_POST['mdp'];

                        // Vérifications si les identifiants sont les bons
                        $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ? AND mdp = ?");
                        $stmt->execute([$login, $mdp]);
                        $count = $stmt->rowCount();
                        $user = $stmt->fetch();

                        if ($count == 1) {
                            // Connexion réussie
                            $_SESSION['login'] = $login;
                            $_SESSION['roles'] = $user['roles'];
                            $_SESSION['idusr'] = $user['id_users'];
                            echo $_SESSION['idusr'];
                            echo $_SESSION['login'];
                            echo $_SESSION['roles'];
                            if ($user['roles'] == '2') {
                                // header("location: crud.php");
                            } else {
                                echo "<p>Connexion réussie !</p>";
                                // header("Location: index.php");
                            }
                            exit();
                        } else {
                            echo "<p class='text-danger text-center'>Identifiant ou mot de passe incorrect</p>";
                        }
                    }
                ?>
                <form method="post" action="login.php">
                    <div class="form-group">
                        <label for="login"><b>Login :</b></label>
                        <input type="text" id="login" name="login" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mdp"><b>Mot de passe :</b></label>
                        <input type="password" id="mdp" name="mdp" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                </form>
                <p class="text-center mt-3">Identifiants oubliés ? Demande a ton professeur.
            </div>
        </div>
    </div>
    <div class="tulipe-container"></div>
    <script src="script.js"></script>
    <?php include ('./partials/footer.php') ?>
</body>
</html>
