<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Connexions</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <?php include('header.php');?>
    <main>
        <?php    
    
        require_once("db_connect.php");
   
        // VÃ©rification des identifiants
    if(isset($_POST['login']) && isset($_POST['mdp'])) {
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];

        //vÃ©rifications si les identifiants sont les bons
        $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ? AND mdp = ?");
        $stmt->execute([$login, $mdp]);
        $count = $stmt->rowCount();
        $user = $stmt->fetch();
    
        if ($count == 1) {
            // Connexion rÃ©ussie
            
            $_SESSION['login'] = $login;
            $_SESSION['roles'] = $user['roles'];
            $_SESSION['idusr'] = $user['id'];
            if ($user['idrole'] == '2') {
                header("location: crud.php");
            } else {
                echo "<p>Connexion réussie !</p>";
                header("Location: index.php");
            }
            exit();
        } else {
            echo "<p>Identifiant ou mot de passe incorrect</p>";
        }
    }
    ?>
    <br>
    <div class ="formulaire_connexion">
        <h2>Connectez-vous</h2>
        <form method="post" action="login.php">
            <label for="login"><b>Login :</b></label><br>
            <input type="text" id="login" name="login" class="formulaire_connexion" required><br>

            <label for="mdp"><b>Mot de passe :</b></label><br>
            <input type="password" id="mdp" name="mdp" class="formulaire_connexion" required>
            <br><br>
            <input type="submit" value="Se connecter" class="formulaire_connexion"><br>
        </form>
    </div>
    <br>
    <br>
    </main>
    <?php include('footer.php') ?>
</body>
</html>