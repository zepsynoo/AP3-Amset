<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <div>
        <p id="errorMsg">&nbsp;</p>
        <form method="post" action="http://domaine.ext">
            <label for="login">Login</label>
            <input type="text" id="login" name="login" value="">
            <label for="pass">Mot de passe</label>
            <input type="password" id="pass" name="pass" value="">
            <input type="submit" id="valid" value="Se connecter">
            <!-- <a href="#">Mot de passe oublié</a> -->
            <!-- lien de la page du code pour le CSS -->
            <!-- https://believemy.com/r/creer-un-formulaire-de-connexion-glassmorphique -->
        </form>
    </div>

    <div>
        <button><a href="<?= url_to('accueil') ?>">redirection vers accueil</a></button>
    </div>


</body>

</html>