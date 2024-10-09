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
		<br>
		<div class="titre">
			<h2>Accueil</h2>
		</div>
		<p>
			<a href="liste_commande.php">Liste des commandes</a>
			<a href="add.php">Ajouter une équipe</a>
		</p>
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
		<br>
		<br>
		<br>
	</main>
	<?php include('../partials/footer.php'); ?>
</body>