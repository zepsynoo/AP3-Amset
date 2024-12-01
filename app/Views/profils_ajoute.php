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
                <legend>Nouveau Profil</legend>

                <label for="libelle">Désignation :</label>
                <input id="LIBELLE" name="LIBELLE" type="text">

                <input type="submit" value="Valider">
            </fieldset>
        </form>
    </div>
</section>


<?= $this->endSection() ?>