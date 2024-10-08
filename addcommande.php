<?php require_once('db_connect.php');?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include('header.php');?>
    <main>
        <form action="addcommandeaction.php" method="post" name="add">
			<table width="25%" border="0">
				<tr> 
					<td>Nom et Prénom : </td>
					<td><input type="text" name="nom"></td>
				</tr>
				<tr> 
					<td>Quantité  : </td>
					<td><input type="int" name="quantite"></td>
				</tr>
				<tr> 
					<td>Livraison :</td>
					<td><input type="text" name="livraison"></td>
				</tr>
                <tr>
                    <td>Moyen de réglement :</td>
                    <td><input type="text" name="reglement"></td>
                </tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Ajouter"></td>
				</tr>
			</table>
		</form>
    </main>
</body>
</html>