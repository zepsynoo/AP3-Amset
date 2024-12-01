<?= $this->extend('_layout') ?>

<?= $this->section('contenu') ?>

<div>

    <h1 classe="titres-blanc">Modifier un Salariés</h1>

</div>

</header>
<!-- commencer le code ici  -->

<section>
    <div class="form-style">
        <form action=<?= url_to('salarie_update') ?> method="post">
            <fieldset>
                <legend>Modifier Salariés</legend>

                <input id="ID_SALARIE" name="ID_SALARIE" type="hidden" value=<?= $salarieAffiche['ID_SALARIE'] ?>>

                <label for="prenom">Prénom :</label>
                <input id="PRENOM_SALARIE" name="PRENOM_SALARIE" type="text" value=<?= $salarieAffiche['PRENOM_SALARIE'] ?>>

                <label for="nom">nom :</label>
                <input id="NOM_SALARIE" name="NOM_SALARIE" type="text" value=<?= $salarieAffiche['NOM_SALARIE'] ?>>

                <label for="civilite">Civilite :</label>
                <select name="CIVILITE" id="civilite">
                    <option value="<?= $salarieAffiche['ID_SALARIE'] ?>"><?= $salarieAffiche['CIVILITE'] ?></option>
                    <option value="homme">homme</option>
                    <option value="femme">femme</option>
                </select>

                <label for="email">email :</label>
                <input id="EMAIL_SALARIE" name="EMAIL_SALARIE" type="text" value=<?= $salarieAffiche['EMAIL_SALARIE'] ?>>

                <label for="Telephone">Téléphone :</label>
                <input id="TELEPHONE_SALARIE" name="TELEPHONE_SALARIE" type="text"
                    value=<?= $salarieAffiche['TELEPHONE_SALARIE'] ?>>

                <label for="adresse">Adresse :</label>
                <input id="ADRESSE_SALARIE" name="ADRESSE_SALARIE" type="text"
                    value=<?= $salarieAffiche['ADRESSE_SALARIE'] ?>>

                <label for="code-postal">Code-Postal :</label>
                <input id="CODE_POSTAL_SALARIE" name="CODE_POSTAL_SALARIE" type="text"
                    value=<?= $salarieAffiche['CODE_POSTAL_SALARIE'] ?>>

                <label for="ville">Ville :</label>
                <input id="VILLE_SALARIE" name="VILLE_SALARIE" type="text" value=<?= $salarieAffiche['VILLE_SALARIE'] ?>>

                <!-- <img src="chemin/vers/l'image.jpg" alt="Description de l'image" width="largeur" height="hauteur"> -->

                <!-- <h3>Upload d'une Image</h3>
                <form action="upload_image.php" method="POST" enctype="multipart/form-data">
                    <label for="image">Sélectionner une image :</label>
                    <input type="file" id="IMG_SALARIE" name="IMG_SALARIE" accept="image/*" required>
                </form> -->

                <!-- <input type="submit" value="Valider"> -->
            </fieldset>
            <fieldset>
                <legend>Profils du salarie</legend>
                <?php

                foreach ($listeProfilsSalaries as $profil) {

                    echo '<label>' . $profil['LIBELLE'] . '</label><br>';
                    echo '<input type="hidden" name="ID_PROFIL[]" value="' . $profil['ID_PROFIL'] . '">';
                }
                ?>
            </fieldset>
            <input type="submit" value="Modifier">
        </form>
    </div>
    <div class="form-style">
        <form method="post" action=" <?= url_to('suppr_profil_salarie') ?>">
            <fieldset>
                <legend>Supprimer un profil</legend>
                <input id="ID_SALARIE" name="ID_SALARIE" type="hidden" value="<?= $salarieAffiche['ID_SALARIE'] ?>">
                <select id="ID_PROFIL" name="ID_PROFIL">
                    <?php
                    foreach ($listeProfilsSalaries as $profil) {
                        echo '<option value="' . $profil['ID_PROFIL'] . '" required>' . $profil['LIBELLE'] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="-">
            </fieldset>
        </form>
    </div>
    <div class="form-style">
        <form method="post" action=" <?= url_to('ajout_profil_salarie') ?>">
            <fieldset>
                <legend>Ajouter un profil</legend>
                <input id="ID_SALARIE" name="ID_SALARIE" type="hidden" value="<?= $salarieAffiche['ID_SALARIE'] ?>">
                <select id="ID_PROFIL" name="ID_PROFIL">
                    <?php
                    foreach ($listNonProfilSalarie as $profil) {
                        echo '<option value="' . $profil['ID_PROFIL'] . '" required>' . $profil['LIBELLE'] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="+">
            </fieldset>
        </form>
    </div>

</section>


<?= $this->endSection() ?>