<html>
<head>
    <title>Ajout commande</title>
</head>

<body>
<?php
require_once("db_connect.php");

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $quantite = $_POST['quantite'];
    $livraison = $_POST['livraison'];
    $reglement = $_POST['reglement'];
    $prix = 10*$quantite;

    
   
    if ((empty($nom)) || (empty($quantite)) || (empty($livraison)) || (empty($reglement))){
        if (empty($nom)){
            echo "<font color='red'>Veuillez entrer le nom de la commande</font><br/>";
        }
        if (empty($quantite)){
            echo "<font color='red'>Veuillez entrer la quantité de la commande</font><br/>";
        }
        if (empty($livraison)){
            echo "<font color='red'>Veuillez entrer la date de livraison</font><br/>";
        }
        if (empty($reglement)){
            echo "<font color='red'>Veuillez entrer le moyen de réglement</font><br/>";
        }
    } else { 
        $stmt = $pdo->prepare("INSERT INTO commandes (`nom`,`quantite`,`reglement`, `montant`, `livraison`) VALUES (:nom, :quantite, :reglement, :montant, :livraison)");
        $stmt->execute([':nom' => $nom, ':quantite' => $quantite, ':montant' => $prix, ':livraison' => $livraison]);
        
       
        
        echo "<p><font color='green'>Tournoi ajouté avec succès!</p>";
        echo "<a href='addcommande.php'>Retour au menu</a>";
    }
}
?>
</body>
</html>