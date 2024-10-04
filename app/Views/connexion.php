<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="description" content="">
</head>

<body>
    <h1>Bienvenue sur la page de connexion</h1>

    <div>
        <form>
            <p>Se connecter</p>
            <input type="identifiant" placeholder="identifiant"><br>
            <input type="motDePasse" placeholder="mot de passe"><br>
            <input type="button" value="Connexion"><br>
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