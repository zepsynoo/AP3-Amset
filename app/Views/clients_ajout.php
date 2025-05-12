<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>
<div>

    <h1>Ajouter un Salariés</h1>

</div>
</header>
<!-- formulaire d'ajout d'un client -->
<section>
    <div class="form-style">
        <!-- route vers le controler Client.php qui vas chercher la function Client_create -->
        <form method="post" action="<?= url_to('client_create') ?>" enctype="multipart/form-data">
            <label for="nom">Nom :</label>
            <input type="text" id="NOM" name="NOM" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="PRENOM" name="PRENOM" required>

            <label for="email">Email :</label>
            <input type="text" id="EMAIL" name="EMAIL" required>

            <label for="telephone">Telephone :</label>
            <input type="text" id="TELEPHONE" name="TELEPHONE" required>

            <label for="adresse">Adresse :</label>
            <input type="text" id="ADRESSE" name="ADRESSE" required>

            <label for="ville">Ville :</label>
            <input type="text" id="VILLE" name="VILLE" required>

            <label for="code_postal">Code Postal :</label>
            <input type="text" id="CODE_POSTAL" name="CODE_POSTAL" required>

            <label for="raison_social">Raison Social :</label>
            <input type="text" id="RAISON_SOCIAL" name="RAISON_SOCIAL" required>

            <input type="submit" value="Ajouter">
        </form>
    </div>
</section>

<?= $this->endSection() ?>