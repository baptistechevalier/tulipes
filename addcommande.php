<?php require_once('db_connect.php');?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet" href="/tulipe/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<?php include(__DIR__ . '/partials/header.php'); ?>
	<div class="tulipe-container"></div>
    <script src="script.js"></script>
    <main>
        <form action="/tulipe/addcommandeaction.php" method="post" name="add">
		<table width="25%" border="0">
				<tr> 
					<td>Nom et Prénom : </td>
					<td><input type="text" name="nom"></td>
				</tr>
				<tr>
					<td>Civilité :</td>
					<td><select id="civilite" name="civilite">
						<option value="option">~Choisir une option~</option>
						<option value="M">M.</option>
						<option value="Mme">Mme</option>
						<option value="autre">Autre</option>
					</select></td>
				</tr>
				<tr>
					<td>Quantité  : </td>
					<td><input type="int" name="quantite"></td>
				</tr>
				<tr> 
					<td>Semaine de livraison :</td>
					<td><input type="text" name="livraison"></td>
				</tr>
				<tr>
					<td>Adresse de livraison :</td>
					<td><input type = "text" name = "adresse_liv"></td>
				</tr>
				<tr>
					<td>Adresse de la personne :</td>
					<td><input type = "text" name = "adresse_pers"></td>
				</tr>
                <tr>
                    <td>Moyen de réglement :</td>
                    <td><select id="reglement" name="reglement">
						<option value="option">~Choisir une option~</option>
						<option value="cheque">Chèque</option>
						<option value="espèce">Espèce</option>
						</select>
					</td>
                </tr>
				<tr>
					<td>Commande pris en charge par :</td>
					<td><input type="text" name="vendupar"></td>
				</tr>
				<tr>
					<td>Numéro de téléphone :</td>
					<td><input type="text" name="num"></td>
				</tr>
				<tr>
					<td>Email :</td>
					<td><input type="mail" name="mail"></td>
				</tr>
				<tr>
					<td>Signature :</td>
					<td>
						<canvas id="signaturePad"></canvas>
						<br>
						<button type="button" onclick="clearSignature()">Effacer</button>						
						<input type="hidden" name="signature" id="signatureInput">
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Ajouter"></td>
				</tr>
			</table>
		</form>
    </main>
	<script>
		const canvas = document.getElementById('signaturePad');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseleave', stopDrawing);

        function startDrawing(e) {
            isDrawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        }

        function draw(e) {
            if (!isDrawing) return;
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
        }

        function stopDrawing() {
            isDrawing = false;
        }

        function clearSignature() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        // Avant soumission, convertir le canvas en image Base64
        document.querySelector('form').addEventListener('submit', function(e) {
            const signatureInput = document.getElementById('signatureInput');
            signatureInput.value = canvas.toDataURL('image/png');
        });
	</script>
</body>
</html>