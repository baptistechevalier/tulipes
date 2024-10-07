<body>
	<?php include('../partials/header.php') ?>
    <main>
        <h2>Ajouter une équipe</h2>
        <p>
            <a href="./prof/crud.php">Gérer les équipes</a>
        </p>

        <form action="./prof/addaction.php" method="post" name="add">
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
	<?php include('../partials/footer.php') ?>
</body>
</html>