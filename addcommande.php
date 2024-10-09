<?php require_once('db_connect.php');?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Commande</title>
    <link rel="stylesheet" href="/tulipe/style.css">
    <!-- Utilisation d'une seule version de Bootstrap pour éviter les conflits -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Style personnalisé pour le canvas de signature */
        #signaturePad {
            border: 1px solid #ced4da;
            border-radius: .25rem;
            width: 100%;
            height: 200px;
            touch-action: none; /* Empêche le défilement lors de la signature sur mobile */
        }

        /* Ajustement des marges pour les boutons */
        .btn-clear {
            margin-top: 10px;
        }
    </style>
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
					<td><select id="livraison" name="livraison">
						<option value="option">~Choisir une option~</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="S1 et S2">1 et 2</option>
						<option value = "S1 et S3">1 et 3</option>
						<option value = "S2 et S3">2 et 3</option>
						<option value = "S1, S2, et S3">1 ; 2 et 3</option>
					</td>
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
    <?php include('./partials/footer.php') ?>

    <!-- Inclusion de jQuery et Bootstrap JS pour le bon fonctionnement des composants Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXD5zBBpXk8qv3eBGTR+2SJo1OtqU3/B3+zoEux/fdHZSWuTpp17MgfiCcOtBJN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const canvas = document.getElementById('signaturePad');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;

        // Redimensionner le canvas pour qu'il soit responsive
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            ctx.scale(ratio, ratio);
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
        }

        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        canvas.addEventListener('touchstart', startDrawingTouch, {passive: false});
        canvas.addEventListener('touchmove', drawTouch, {passive: false});
        canvas.addEventListener('touchend', stopDrawing, {passive: false});
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseleave', stopDrawing);

        function startDrawing(e) {
            isDrawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        }

        function startDrawingTouch(e) {
            e.preventDefault();
            if (e.touches.length > 0) {
                const rect = canvas.getBoundingClientRect();
                const touch = e.touches[0];
                const x = touch.clientX - rect.left;
                const y = touch.clientY - rect.top;
                isDrawing = true;
                ctx.beginPath();
                ctx.moveTo(x, y);
            }
        }

        function draw(e) {
            if (!isDrawing) return;
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
        }

        function drawTouch(e) {
            e.preventDefault();
            if (!isDrawing) return;
            if (e.touches.length > 0) {
                const rect = canvas.getBoundingClientRect();
                const touch = e.touches[0];
                const x = touch.clientX - rect.left;
                const y = touch.clientY - rect.top;
                ctx.lineTo(x, y);
                ctx.stroke();
            }
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
