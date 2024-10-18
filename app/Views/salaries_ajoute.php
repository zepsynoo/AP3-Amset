<?= $this->extend('_layout') ?>

<?= $this->section('contenu') ?>

<div>

    <h1>Ajouter un Salariés</h1>

</div>

</header>

<section>
    <form action=<?= url_to('salarie_create') ?> method="post">
        <fieldset>
            <legend>Nouveau Salariés</legend>

            <label for="prenom">Prénom :</label>
            <input id="PRENOM_SALARIE" name="PRENOM_SALARIE" type="text">

            <label for="nom">nom :</label>
            <input id="NOM_SALARIE" name="NOM_SALARIE" type="text">

            <label for="civilite">Civilite :</label>
            <input id="CIVILITE" name="CIVILITE" type="text">

            <label for="email">email :</label>
            <input id="EMAIL_SALARIE" name="EMAIL_SALARIE" type="text">

            <label for="Telephone">Téléphone :</label>
            <input id="TELEPHONE_SALARIE" name="TELEPHONE_SALARIE" type="text">

            <label for="adresse">Adresse :</label>
            <input id="ADRESSE_SALARIE" name="ADRESSE_SALARIE" type="text">

            <label for="code-postal">Code-Postal :</label>
            <input id="CODE_POSTAL_SALARIE" name="CODE_POSTAL_SALARIE" type="text">

            <label for="ville">Ville :</label>
            <input id="VILLE_SALARIE" name="VILLE_SALARIE" type="text">

            <!------------------------------------------------------------------------------------------------------------------->

            <!-- <img src="chemin/vers/l'image.jpg" alt="Description de l'image" width="largeur" height="hauteur"> -->

            <!-- <h3>Upload d'une Image</h3>
            <form action="upload_image.php" method="POST" enctype="multipart/form-data">
                <label for="image">Sélectionner une image :</label>
                <input type="file" id="IMG_SALARIE" name="IMG_SALARIE" accept="image/*" required>
            </form> -->

            <input type="submit" value="Valider">
        </fieldset>
    </form>
</section>


<?= $this->endSection() ?>