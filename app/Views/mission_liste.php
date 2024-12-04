<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<div>

    <h1>Bienvenue sur la liste des Mission</h1>

    <h2>Liste des Mission</h2>

</div>

<section>
    <a class="bouton" href="<?= url_to('mission_ajout') ?>">Ajout mission</a>
    <?php

    // die(var_dump($clientMissionProfils));
    // die(var_dump($listeMission)); 

    $table = new \CodeIgniter\View\Table();
    $table->setHeading('Client concerné', 'Intitulé', 'Description', 'Profil(s)', 'Début', 'Fin', 'Affecter les salarié', 'Modifier', 'Supprimer');

    foreach ($listeMission as $mission) {
        $missionLigne = [];

        // $i = 0;
        // $profilMission[$i] = [];
        
        // $profilMission = [];

        $missionLigne['profils'] = "";
        foreach ($clientMissionProfils as $clientMissionProfil) {
            // die(var_dump(($clientMissionProfils)));
            if ($mission['ID_MISSION'] == $clientMissionProfil['ID_MISSION']) {
                $missionLigne['profils'] .= $clientMissionProfil['LIBELLE'] . ' x' . $clientMissionProfil['NOMBRE_PROFIL'] . '<br/>';
                // $profilMission[$i] = $clientMissionProfil['ID_PROFIL'];
            }
            // $i++;
        }
        // die(var_dump(($profilMission)));
        // die(var_dump(($clientMissionProfil)));
        
        foreach ($missionClients as $missionClient) {
            if ($mission['ID_MISSION'] == $missionClient['ID_MISSION']) {
                $table->addRow(
                    $missionClient['PRENOM'] . ' ' . $missionClient['NOM'],
                    $mission['INTITULE_MISSION'],
                    $mission['DESCRIPTION_MISSION'],
                    $missionLigne['profils'],
                    $mission['DATE_DEBUT'],
                    $mission['DATE_FIN'],
                    '<a class="bouton" href="' . url_to('mission_affect', $missionClient['ID_MISSION']) . '"> Affecter </a>',
                    '<a class="bouton" href="' . url_to('mission_modif', $mission['ID_MISSION']) . '"> Modifier </a>',
                    // '<a class="bouton" href="' . url_to('mission_delete', $mission['ID_MISSION']) . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ?\')"> Supprimer </a>'
                    '<form method="post" action="' . url_to('mission_delete', $mission['ID_MISSION']) . ' ">
                    <input type="hidden" name="ID_MISSION" value="' . $mission['ID_MISSION'] . '">
                    <input type="submit" value="Supprimer" >
                    </form>'
                );
                // <input type="hidden" name="profils[]" value="' . $profilMission . '">
            }
            // find a way to display the profil list in vardump
        }
    }
    
    echo $table->generate();
    
    ?>

</section>

<?= $this->endSection() ?>