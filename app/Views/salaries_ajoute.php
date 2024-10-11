<?= $this->extend('_layout') ?>

<?= $this->section('contenu') ?>

<div>

    <h1>Ajouter un Salariés</h1>

</div>

</header>
<!-- commencer le code ici  -->

<body>
    <section>
        <form action="<?= url_to('salarie_create') ?>" method="post">
            <fieldset>
                <legend>Nouveau Salariés</legend>

                <label for="prenom">Prenom :</label>
                <input id="PRENOM_SALARIE" name="prenom" type="text">

                <label for="nom">nom :</label>
                <input id="NOM_SALARIE" name="nom" type="text">

                <label for="prenom">Civilite :</label>
                <input id="CIVILITE" name="prenom" type="text">

                <label for="prenom">email :</label>
                <input id="EMAIL_SALARIE" name="prenom" type="text">

                <label for="prenom">Téléphone :</label>
                <input id="prenom" name="prenom" type="text">

                <label for="prenom">Adresse :</label>
                <input id="prenom" name="prenom" type="text">

                <label for="prenom">Code-Postal :</label>
                <input id="prenom" name="prenom" type="text">

                <label for="prenom">Ville :</label>
                <input id="prenom" name="prenom" type="text">

                <img src="chemin/vers/l'image.jpg" alt="Description de l'image" width="largeur" height="hauteur">

                <input type="submit" value="Valider">
            </fieldset>
        </form>
    </section>
</body>




<?= $this->endSection() ?>