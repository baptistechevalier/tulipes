<?php
require_once("../db_connect.php");


$stmt = $pdo->prepare("SELECT * FROM users ORDER BY id_users ");
$stmt->execute();
?>
<body>
	<?php include('../partials/header.php'); ?>
	<div class="tulipe-container"></div>
    <script src="/tulipe/script.js"></script>
	<main>
		<div class="titre">
			<h2>Accueil</h2>
		</div>
		<br>
		<br>
		<div class="tableau_commande">
			<table width='80%' border=0>
				<tr bgcolor='#DDDDDD'>
					<td><strong>Id</strong></td>
					<td><strong>Login</strong></td>
					<td><strong>Mdp</strong></td>
					<td><strong>Action</strong></td>
				</tr>
				<?php
				
				while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "<tr>";
					echo "<td>".$res['id_users']."</td>";
					echo "<td>".$res['login']."</td>";
					echo "<td>".$res['mdp']."</td>";
					echo "<td><a href=\"edit.php?id=".$res['id_users']."\">Modifier</a> | 
					<a href=\"delete.php?id=".$res['id_users']."\" onClick=\"return confirm('Êtes vous sur de vouloir supprimer l'utilisateur ?')\">Supprimer</a></td>";
				}
		
				?>
			</table>
		</div>
		<br>
		<div class="bouton">
			<p>
				<a href="/tulipe/prof/liste_commandes.php" class="btn btn-secondary">Récap des commandes</a>
				<a href="/tulipe/prof/add.php" class="btn btn-secondary">Ajouter une équipe</a>
			</p>
		</div>
		<br>
		<br>
	</main>
	<?php include('../partials/footer.php'); ?>
</body>