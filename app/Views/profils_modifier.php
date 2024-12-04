<?= $this->extend('_layout') ?>

<?= $this->section('contenu') ?>

<div>

    <h1>Ajouter d'un Profil</h1>

</div>

</header>

<section>
    <div class="form-style">
        <form action=<?= url_to('profils_create') ?> method="post">
            <fieldset>
                <legend>Modifier Profil</legend>

                <input id="ID_PROFIL" name="ID_PROFIL" type="hidden" value=<?= $afficheProfils['ID_PROFIL'] ?>>

                <label for="libelle">Désignation :</label>
                <input id="LIBELLE" name="LIBELLE" type="text" value=<?= $afficheProfils['LIBELLE'] ?>>

                <input type="submit" value="Valider">
            </fieldset>
        </form>
    </div>
</section>


<?= $this->endSection() ?>