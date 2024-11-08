<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<form method="post" action="<?= url_to('mission_create') ?>">
    <label for="ID_CLIENT">Client</label>
    <select name="ID_CLIENT">
        <?php
        //Affiche liste des clients pour choisir
        // var_dump($listeClient);
        foreach ($listeClient as $client) {
            echo '<option value=' . $client['ID_CLIENT'] . '>' . $client['NOM'] . '</option>';
        }
        ?>
    </select>
    
    <label for="intitule">Intitulé</label>
    <input id="INTITULE_MISSION" name="INTITULE_MISSION" type="text">

    <label for="DESCRIPTION_MISSION">Déscription</label>
    <textarea id="DESCRIPTION_MISSION" name="DESCRIPTION_MISSION"></textarea>

    <label for="DATE_DEBUT">Date début</label>
    <input id="DATE_DEBUT" name="DATE_DEBUT" type="date">
    
    <label for="DATE_FIN">Date fin</label>
    <input id="DATE_FIN" name="DATE_FIN" type="date">

    <label for="profil">Profil</label>
    <?php
    // var_dump($listeProfil);
    foreach($listeProfil as $profil){
        echo '<input type="checkbox" name="profils[]" value=' . $profil['ID_PROFIL'] . '>' . $profil['LIBELLE'];
        echo '<input type="number" name=' . $profil['ID_PROFIL'] . ' value="0"></br>'; 
        
    }
    
    ?>
    <input type="submit" value="Valider">
</form>


<?= $this->endSection() ?>