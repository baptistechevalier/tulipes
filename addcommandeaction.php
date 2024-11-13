<body>
    <?php
    include(__DIR__ . '/partials/header.php');
    require_once("db_connect.php");

    // Active l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $id_equip = $_SESSION['idusr'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nom = $_POST['nom'];
        $quantite = $_POST['quantite'];
        $livraison = $_POST['livraison'];
        $reglement = $_POST['reglement'];
        $prix = 10 * $quantite;
        $signature_base64 = $_POST['signature'];
        $civilite = $_POST['civilite'];
        $adresse_liv = $_POST['adresse_liv'];
        $adresse_pers = $_POST['adresse_pers'];
        $vendupar = $_POST['vendupar'];
        $numtel = $_POST['num'];
        $mail = $_POST['mail'];
        $remarque = $_POST['remarques'];
        $numero_cheque = $_POST['numero_cheque'];

        
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
            // Traitement de la signature
            $signature_base64 = str_replace('data:image/png;base64,', '', $signature_base64);
            $signature_base64 = str_replace(' ', '+', $signature_base64);
            $signature_data = base64_decode($signature_base64);

            // Génération d'un nom unique pour la signature
            $signature_name = uniqid() . '.png';
            $signature_path = 'images/' . $signature_name;

            // Stocker la signature
            if (!file_put_contents($signature_path, $signature_data)) {
                echo "<font color='red'>Erreur lors de l'enregistrement de la signature</font><br/>";
                exit;
            }

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            try {
    // Préparation de la requête SQL
            $stmt = $pdo->prepare("INSERT INTO commandes (nom, quantite, reglement, montant, livraison, signature, adresse_personne, adresse_de_livraison, vendupar, telephone, mail, civilite, remarque, id_user, numero_cheques) 
            VALUES (:nom, :quantite, :reglement, :montant, :livraison, :signature, :adresse_personne, :adresse_de_livraison, :vendupar, :telephone, :mail, :civilite, :remarque, :id_equip, :numero_cheque)");



    // Exécution de la requête avec les paramètres
            $executeResult = $stmt->execute([
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
                ':civilite' => $civilite,
                ':remarque' => $remarque,
                ':id_equip' => $id_equip,
                ':numero_cheque' => !empty($numero_cheque) ? $numero_cheque : null
            ]);

   
            if ($executeResult) {
                echo "Données insérées avec succès.";
                ?>
                <script>
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 5000);
                </script>
                <?php
            } else {
                $errorInfo = $stmt->errorInfo();
                throw new Exception("Erreur lors de l'insertion : " . $errorInfo[2]);
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue : " . $e->getMessage();
        }
    }
    }
    
?>

</body>
