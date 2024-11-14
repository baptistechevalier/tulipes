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
    <main class="container my-5">
		<div class="photo">
            <img src="/tulipe/assets/images/baudimont.png" class = "image_right" alt="Image droite" heigt="auto" width="auto">
			<img src="/tulipe/assets/images/lionsClub.png" class="image_left" alt="Image gauche" height="auto"width="auto">
		</div>
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Ajouter une Commande</h2>
                <form action="/tulipe/addcommandeaction.php" method="POST">
                    <div class="form-group">
                        <label for="nom">Nom et Prénom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>

                    <div class="form-group">
                        <label for="civilite">Civilité :</label>
                        <select class="form-control" id="civilite" name="civilite" required>
                            <option value="">~Choisir une option~</option>
                            <option value="M">M.</option>
                            <option value="Mme">Mme</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantite">Quantité :</label>
                        <input type="number" class="form-control" id="quantite" name="quantite" min="1" required>
                    </div>

                    <div class="form-group">
                        <label for="livraison">Semaine de livraison :</label>
                        <select class="form-control" id="livraison" name="livraison" required>
                            <option value="">~Choisir une option~</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="S1 et S2">1 et 2</option>
                            <option value="S1 et S3">1 et 3</option>
                            <option value="S2 et S3">2 et 3</option>
                            <option value="S1, S2, et S3">1, 2 et 3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="adresse_liv">Adresse de livraison :</label>
                        <input type="text" class="form-control" id="adresse_liv" name="adresse_liv" required>
                    </div>

                    <div class="form-group">
                        <label for="adresse_pers">Adresse de la personne :</label>
                        <input type="text" class="form-control" id="adresse_pers" name="adresse_pers" required>
                    </div>

                    <div class="form-group">
                        <label for="reglement">Moyen de règlement :</label>
                        <select class="form-control" id="reglement" name="reglement" required>
                            <option value="">~Choisir une option~</option>
                            <option value="cheque">Chèque</option>
                            <option value="especes">Espèces</option>
							<option value="carte bancaire">Carte Bancaire</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="numero_cheque">Numéro de chèque (Si paiment par chèque)</label>
                        <input type="text" class="form-control" id="numero_cheque" name="numero_cheque">
                    </div>

                    <div class="form-group">
                        <label for="vendupar">Commande prise en charge par :</label>
                        <input type="text" class="form-control" id="vendupar" name="vendupar" required>
                    </div>

                    <div class="form-group">
                        <label for="num">Numéro de téléphone :</label>
                        <input type="tel" class="form-control" id="num" name="num" pattern="[0-9]{10}" placeholder="Ex: 0123456789" required>
                    </div>

                    <div class="form-group">
                        <label for="mail">Email :</label>
                        <input type="email" class="form-control" id="mail" name="mail" required>
                    </div>

                    <div class="form-group">
                        <label for="signaturePad">Signature :</label>
                        <canvas id="signaturePad"></canvas>
                        <button type="button" class="btn btn-secondary btn-clear" onclick="clearSignature()">Effacer</button>
                        <input type="hidden" name="signature" id="signatureInput">
                    </div>
					<div class="form-group">
						<label for="remarques">Remarques :</label>
						<input type="text" name="remarques" id="remarques" height="auto" width="auto">
					</div>

                    <button type="submit" class="btn btn-primary btn-block">Prendre la commande</button>
                </form>
            </div>
        </div>
    </main>
    

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
	<?php include('./partials/footer.php') ?>
    <div class="tulipe-container"><script src="script.js"></script></div>
    
</body>
</html>