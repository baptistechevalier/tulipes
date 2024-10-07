<body>
<?php
// Include the database connection file
require_once("../db_connect.php");

if (isset($_POST['submit'])) {
	$login = $_POST['login'];
	$mdp = $_POST['mdp'];

	// Check for empty fields
	if (empty($login) || empty($mdp) ){
        if (empty($login)) {
			echo "<font color='red'>Le pseudo est vide</font><br/>";
		}
        if (empty($mdp)){
            echo "<font color='red'>Le mot de passe est vide.</font><br/>";
        }
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
	
		$stmt = $pdo->prepare("INSERT INTO users (`login`, `mdp`) VALUES (:login, :mdp)");
		$stmt->execute([':login' => $login, ':mdp' => $mdp]);

		echo "<p><font color='green'>Equipe ajouté !</p>";
		echo "<a href='index.php'>Voir les résultat</a>";
	}
}
?>
</body>