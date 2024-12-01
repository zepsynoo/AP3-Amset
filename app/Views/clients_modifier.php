<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>
<div>

    <h1 classe="titres-blanc">Modifier un client</h1>

</div>
</header>
<section>
    <div class="form-style">
        <form method="post" action="<?= url_to('client_update') ?>" enctype="multipart/form-data">
            <input type="hidden" name="ID_CLIENT" value="<?= $client['ID_CLIENT'] ?>">

            <label for="nom">Nom :</label>
            <input type="text" id="NOM" name="NOM" value="<?= $client['NOM'] ?>">

            <label for="prenom">Prénom :</label>
            <input type="text" id="PRENOM" name="PRENOM" value="<?= $client['PRENOM'] ?>">

            <label for="email">Email :</label>
            <input type="text" id="EMAIL" name="EMAIL" value="<?= $client['EMAIL'] ?>">

            <label for="telephone">Telephone :</label>
            <input type="text" id="TELEPHONE" name="TELEPHONE" value="<?= $client['TELEPHONE'] ?>">

            <label for="adresse">Adresse :</label>
            <input type="text" id="ADRESSE" name="ADRESSE" value="<?= $client['ADRESSE'] ?>">

            <label for="ville">Ville :</label>
            <input type="text" id="VILLE" name="VILLE" value="<?= $client['VILLE'] ?>">

            <label for="code_postal">Code Postal :</label>
            <input type="text" id="CODE_POSTAL" name="CODE_POSTAL" value="<?= $client['CODE_POSTAL'] ?>">

            <label for="raison_social">Raison Social :</label>
            <input type="text" id="RAISON_SOCIAL" name="RAISON_SOCIAL" value="<?= $client['RAISON_SOCIAL'] ?>">

            <!-- <label for="image">Choisir une image :</label>
            <input type="file" name="image" id="image" required>

            <label for="image_name">Nom personnalisé de l'image :</label>
            <input type="text" id="image_name" name="image_name" placeholder="Entrez un nom pour l'image"> -->

            <input type="submit" value="Modifier">
        </form>
    </div>
</section>

<?= $this->endSection() ?>