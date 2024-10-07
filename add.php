<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter équipe</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
	<main>
		<?php include('header.php') ?>
        <main>
            <h2>Ajouter une équipe</h2>
            <p>
                <a href="crud.php">Gérer les équipes</a>
            </p>

            <form action="addaction.php" method="post" name="add">
                <table width="25%" border="0">
                    <tr> 
                        <td>login :</td>
                        <td><input type="text" name="login"></td>
                    </tr>
                        <td>Mot de passe :</td>
                        <td><input type="text" name="mdp"></td>
                    </tr>
                    <tr> 
                        <td></td>
                        <td><input type="submit" name="submit" value="Ajouter"></td>
                    </tr>
                </table>
            </form>
        </main>
		<?php include('footer.php') ?>
	</main>	
</body>
</html>