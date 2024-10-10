<?php 
// Inclure la connexion à la base de données
include_once ($_SERVER['DOCUMENT_ROOT'] . '/tulipe/db_connect.php');
?>
<!-- // Inclure le header -->
<?php include(__DIR__ . '/partials/header.php'); 

// Requête SQL pour récupérer le classement des équipes
$sql = "SELECT u.login AS equipe, SUM(c.quantite) AS total_quantite
        FROM users u
        JOIN commandes c ON u.login = c.vendupar
        WHERE u.roles = 1  -- '1' représente une équipe
        GROUP BY u.login
        ORDER BY total_quantite DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$classement = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                foreach ($classement as $row): ?>
                    <tr class="<?= ($rank === 1) ? 'table-success' : '' ?>"> <!-- Classe spéciale pour le premier -->
                        <th scope="row"><?= $rank ?></th>
                        <td><?= htmlspecialchars($row['equipe']) ?></td>
                        <td><?= htmlspecialchars($row['total_quantite']) ?></td>
                    </tr>
                    <?php $rank++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Inclure le footer -->
<?php 
include_once ($_SERVER['DOCUMENT_ROOT'] . '/tulipe/partials/footer.php');
?>
