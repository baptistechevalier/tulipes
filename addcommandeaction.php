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
    $signature_base64 = $_POST['signature'];
    $civilite = $_POST['civilite'];
    $adresse_liv = $_POST['adresse_liv'];
    $adresse_pers = $_POST['adresse_pers'];
    $vendupar = $_POST['vendupar'];
    $numtel=$_POST['num'];
    $mail = $_POST['mail'];


    //récupérer les données de la signature
    $signature_base64 = str_replace('data:image/png;base64','',$signature_base64);
    $singature_base64 = str_replace('','+',$signature_base64);
    $signature_data = base64_decode($signature_base64);

    $signature_name=uniqid().'.png';
    $signature_path = 'images/'.$signature_name;
    file_put_contents($signature_path,$signature_data);

   
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
        $stmt = $pdo->prepare("INSERT INTO commandes (`nom`,`quantite`,`reglement`, `montant`, `livraison`,`signature`, `adresse_personne`, `adresse_de_livraison`, `vendupar`, `telephone`, `mail`, `civilite`) VALUES (:nom, :quantite, :reglement, :montant, :livraison, :signature, :adresse_personne, :adresse_de_livraison, :vendupar, :telephone, :mail, :civilite)");
        $stmt->execute([':nom' => $nom, ':quantite' => $quantite, ':montant' => $prix, ':livraison' => $livraison, ':reglement' => $reglement, ':signature' => $signature_name, ':adresse_personne' => $adresse_pers, ':adresse_de_livraison' => $adresse_liv, ':vendupar' => $vendupar, ':telephone' => $tel, ':mail' => $mail, ':civilite' => $civilite]);
        
       
        
        echo "<p><font color='green'>Tournoi ajouté avec succès!</p>";
        echo "<a href='addcommande.php'>Retour au menu</a>";
    }
}
?>
</body>
</html>