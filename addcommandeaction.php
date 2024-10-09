<html>
<head>
    <title>Ajout commande</title>
</head>

<body>
<?php
require_once("db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $quantite = $_POST['quantite'];
    $livraison = $_POST['livraison'];
    $reglement = $_POST['reglement'];
    $prix = 10 * $quantite; // Calcul du prix basé sur la quantité
    $signature_base64 = $_POST['signature'];
    $civilite = $_POST['civilite'];
    $adresse_liv = $_POST['adresse_liv'];
    $adresse_pers = $_POST['adresse_pers'];
    $vendupar = $_POST['vendupar'];
    $numtel = $_POST['num'];
    $mail = $_POST['mail'];

    // Vérification des champs obligatoires
    if (empty($nom) || empty($quantite) || empty($livraison) || empty($reglement)) {
        if (empty($nom)) {
            echo "<font color='red'>Veuillez entrer le nom de la commande</font><br/>";
        }
        if (empty($quantite)) {
            echo "<font color='red'>Veuillez entrer la quantité de la commande</font><br/>";
        }
        if (empty($livraison)) {
            echo "<font color='red'>Veuillez entrer la date de livraison</font><br/>";
        }
        if (empty($reglement)) {
            echo "<font color='red'>Veuillez entrer le moyen de règlement</font><br/>";
        }
    } else {
        // Traitement de la signature (suppression du préfixe 'data:image/png;base64,' et décodage)
        $signature_base64 = str_replace('data:image/png;base64,', '', $signature_base64);
        $signature_base64 = str_replace(' ', '+', $signature_base64);
        $signature_data = base64_decode($signature_base64);

        // Génération d'un nom unique pour le fichier de signature et stockage dans le dossier 'images'
        $signature_name = uniqid() . '.png';
        $signature_path = 'images/' . $signature_name;
        file_put_contents($signature_path, $signature_data);

        // Préparation de la requête SQL pour insérer la commande
        $stmt = $pdo->prepare("INSERT INTO commandes (nom, quantite, reglement, montant, livraison, signature, adresse_personne, adresse_de_livraison, vendupar, telephone, mail, civilite) 
                               VALUES (:nom, :quantite, :reglement, :montant, :livraison, :signature, :adresse_personne, :adresse_de_livraison, :vendupar, :telephone, :mail, :civilite)");

        // Exécution de la requête avec les paramètres du formulaire
        $stmt->execute([
            ':nom' => $nom,
            ':quantite' => $quantite,
            ':montant' => $prix,
            ':livraison' => $livraison,
            ':reglement' => $reglement,
            ':signature' => $signature_name,
            ':adresse_personne' => $adresse_pers,
            ':adresse_de_livraison' => $adresse_liv,
            ':vendupar' => $vendupar,
            ':telephone' => $numtel,
            ':mail' => $mail,
            ':civilite' => $civilite
        ]);

        // Affichage du message de confirmation
        echo "<p><font color='green'>Commande ajoutée avec succès!</font></p>";
        echo "<a href='addcommande.php'>Retour au menu</a>";
    }
}
?>
</body>
</html>
