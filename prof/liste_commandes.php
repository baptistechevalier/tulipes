<?php require_once (($_SERVER['DOCUMENT_ROOT'] . '/tulipe/db_connect.php'));
try {
    $sql = "SELECT * FROM commandes ORDER BY id_commande";
    $stmt = $pdo->query($sql);
    $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : ". $e->getMessage();
    exit;
}
?>

<body>
    <?php include('../partials/header.php');?>
    <main>
        <div class="liste_commande">
            <h1><b>Liste des commandes</b></h1>
        </div>
        <div class = "tableau_commande">
            <table border="1">
                <tr>
                    <th>Numéro de commande</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Prix total</th>
                    <th>Moyen de réglement</th>
                    <th>Semaine de livraison</th>
                </tr>
                <?php foreach ($commandes as $commande):?>
                <tr>
                    <td><?=htmlspecialchars($commande['id_commande'])?></td>
                    <td><?=htmlspecialchars($commande['nom'])?></td>
                    <td><?=htmlspecialchars($commande['quantite'])?></td>
                    <td><?=htmlspecialchars($commande['montant'])?></td>
                    <td><?=htmlspecialchars($commande['reglement'])?></td>
                    <td><?=htmlspecialchars($commande['livraison'])?></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
    </main>
    <?php include('../partials/footer.php');?>
</body>
