<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<section>

    <h2>Formulaire de Modification d'un client</h2>
    <form method="post" action= "<?= url_to('client_update') ?>"enctype="multipart/form-data">
    <input type="hidden" name="ID_CLIENT" value="<?= $client['ID_CLIENT'] ?>">
        
            <label for="nom">Nom :</label>
            <input type="text" id="NOM" name="NOM" value= "<?=$client['NOM']?>"><br><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="PRENOM" name="PRENOM" value= "<?=$client['PRENOM']?>"><br><br>

            <label for="email">email :</label>
            <input type="text" id="EMAIL" name="EMAIL" value= "<?=$client['EMAIL']?>"><br><br>

            <label for="telephone">telephone :</label>
            <input type="text" id="TELEPHONE" name="TELEPHONE" value= "<?=$client['TELEPHONE']?>"><br><br>

            <label for="adresse">adresse :</label>
            <input type="text" id="ADRESSE" name="ADRESSE" value= "<?=$client['ADRESSE']?>"><br><br>

            <label for="ville">ville :</label>
            <input type="text" id="VILLE" name="VILLE" value= "<?=$client['VILLE']?>"><br><br>

            <label for="code_postal">code_postal :</label>
            <input type="text" id="CODE_POSTAL" name="CODE_POSTAL" value= "<?=$client['CODE_POSTAL']?>"><br><br>

            <label for="raison_social">raison_social :</label>
            <input type="text" id="RAISON_SOCIAL" name="RAISON_SOCIAL" value= "<?=$client['RAISON_SOCIAL']?>"><br><br>

            <label for="image">Choisir une image :</label>
            <input type="file" name="image" id="image" required>

            <label for="image_name">Nom personnalisé de l'image :</label>
            <input type="text" id="image_name" name="image_name" placeholder="Entrez un nom pour l'image">

            <input type="submit" value="Modifier">
            <input type="button" value="retour" onclick="window.location.href='index.php'">
            <input type="reset" value="Annuler">
    </form>
</section>

<?= $this->endSection() ?>