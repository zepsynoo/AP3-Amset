<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<form method="post" action="<?= url_to('mission_update') ?>">
    <?php
    // die(var_dump($mission));
    // var_dump($mission);
    var_dump($missionJoins);
    // die(var_dump($listeClient));
    // var_dump($listeClient);

    ?>
    <label for="ID_CLIENT">Client</label>
    <select name="ID_CLIENT">
        <?php
        //Affiche liste des clients pour choisir
        foreach ($listeClient as $client) {
            // Find a way to make client select
            echo '<option value="' . $client['ID_CLIENT'] . '" ' .  $client['ID_CLIENT'] == $mission['ID_CLIENT'] ? 'slected' : '' .  '>' . $client['NOM'] . '</option>';
        }
        ?>
    </select>

    <label for="intitule">Intitulé</label>
    <input id="INTITULE_MISSION" name="INTITULE_MISSION" value=<?= $mission['INTITULE_MISSION'] ?> type="text">

    <label for="DESCRIPTION_MISSION">Déscription</label>
    <textarea id="DESCRIPTION_MISSION" name="DESCRIPTION_MISSION"><?= $mission['DESCRIPTION_MISSION'] ?></textarea>

    <label for="DATE_DEBUT">Date début</label>
    <input id="DATE_DEBUT" name="DATE_DEBUT" type="date" value=<?= $mission['DATE_DEBUT'] ?>>

    <label for="DATE_FIN">Date fin</label>
    <input id="DATE_FIN" name="DATE_FIN" type="date" value=<?= $mission['DATE_FIN'] ?>>

    <label for="profil">Profil</label>
    <?php
    // var_dump($listeProfil);
    foreach ($missionJoins as $missionJoin) {
        echo '<input type="checkbox" name="profils[]" value=' . $missionJoin['ID_PROFIL'] . '>' . $missionJoin['LIBELLE'];
        echo '<input type="number" name=' . $missionJoin['ID_PROFIL'] . ' value="' . $missionJoin['NOMBRE_PROFIL'] . '"></br>';
    }

    ?>

    <input type="submit" value="Valider">
</form>

<?= $this->endSection() ?>