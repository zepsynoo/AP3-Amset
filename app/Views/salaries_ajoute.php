<?= $this->extend('_layout') ?>

<?= $this->section('contenu') ?>

<div>

    <h1>Ajouter un Salariés</h1>

</div>

</header>

<section>
    <div class="form-style">

        <form action=<?= url_to('salarie_create') ?> method="post">
            <fieldset>
                <legend>Nouveau Salariés</legend>

                <label for="prenom">Prénom :</label>
                <input id="PRENOM_SALARIE" name="PRENOM_SALARIE" type="text">

                <label for="nom">nom :</label>
                <input id="NOM_SALARIE" name="NOM_SALARIE" type="text">

                <label for="civilite">Civilité :</label>
                <select name="CIVILITE" id="civilite" required>
                    <option value="" disabled selected>Genre</option>
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                </select><br>

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

                <label for="ID_PROFIL">Profils</label>
                <?php foreach ($listeProfils as $profil) { ?>
                    <input class="noir" type="checkbox" name="profils[]" value="<?= $profil['ID_PROFIL'] ?>">
                    <label for="profils[]"><?= $profil['LIBELLE'] ?></label><br>
                <?php } ?>

                <input type="submit" value="Valider">
            </fieldset>
        </form>
    </div>
</section>

<?= $this->endSection() ?>