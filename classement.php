<?php 
// Inclure la connexion à la base de données
require_once($_SERVER['DOCUMENT_ROOT'] . '/tulipe/db_connect.php');
?>
<!-- // Inclure le header -->
 <body>
<?php include('/partials/header.php'); 

// Requête SQL pour récupérer le classement des équipes
$sql = "SELECT u.login AS equipe, SUM(c.quantite) AS total_quantite
        FROM users AS u
        JOIN commandes AS c ON c.id_user = u.id_users
        WHERE u.roles = 1  -- '1' représente une équipe
        GROUP BY u.login
        ORDER BY total_quantite DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute(); 
$classements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Classement des Équipes</h1>
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Équipe</th>
                    <th scope="col">Total Quantités Vendues</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $rank = 1; // Compteur de rang
                foreach ($classements as $classement): ?>
                    <tr class="<?= ($rank === 1) ? 'table-success' : '' ?>"> <!-- Classe spéciale pour le premier -->
                        <th scope="row"><?= $rank ?></th>
                        <td><?= htmlspecialchars($classement['equipe']) ?></td>
                        <td><?= htmlspecialchars($classement['total_quantite']) ?></td>
                    </tr>
                    <?php $rank++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Inclure le footer -->
<?php 
include ('/tulipe/partials/footer.php');
?>
</body>