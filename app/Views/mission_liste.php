<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<div>

    <h1>Bienvenue sur la liste des Mission</h1>


</div>
</header>

<h2>Liste des Mission</h2>
<section>
    <form method=get action=<?= url_to('mission_ajout') ?>><button>Ajouter mission</button></form>
    <?php

    // die(var_dump($clientMissionProfils));
    // die(var_dump($listeMission)); 
    // die(var_dump($listeJoinMissionSalaries)); 
    
    $table = new \CodeIgniter\View\Table();
    $table->setHeading('Intitulé', 'Description', 'Client concerné', 'Profil(s) demandés', 'Début', 'Fin', 'Salarié(s) affecter', 'Affecter les salarié', 'Modifier', 'Supprimer');

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

        $salarieMissionLigne = [];
        $salarieMissionLigne['salaries'] = "";
        foreach ($listeJoinMissionSalaries as $listeJoinMissionSalarie){
            if ($mission['ID_MISSION'] == $listeJoinMissionSalarie['ID_MISSION']){
                $salarieMissionLigne['salaries'] .= $listeJoinMissionSalarie['PRENOM_SALARIE'] . ' ' . $listeJoinMissionSalarie['NOM_SALARIE'] . '<br/>';
            }
        }

        
        // die(var_dump(($profilMission)));
        // die(var_dump(($clientMissionProfil)));
    
        foreach ($missionClients as $missionClient) {
            if ($mission['ID_MISSION'] == $missionClient['ID_MISSION']) {
                $table->addRow(
                    $mission['INTITULE_MISSION'],
                    $mission['DESCRIPTION_MISSION'],
                    $missionClient['PRENOM'] . ' ' . $missionClient['NOM'],
                    $missionLigne['profils'],
                    $mission['DATE_DEBUT'],
                    $mission['DATE_FIN'],
                    $salarieMissionLigne['salaries'],
                    '<a href="' . url_to('mission_attribution', $missionClient['ID_MISSION']) . '"><button>Affecter</button></a>',
                    '<a href="' . url_to('mission_modif', $mission['ID_MISSION']) . '"><button>Modifier</button></a>',
                    // '<a class="bouton" href="' . url_to('mission_delete', $mission['ID_MISSION']) . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ?\')"> Supprimer </a>'
                    '<form method="post" action="' . url_to('mission_delete', $mission['ID_MISSION']) . ' ">
                        <input type="hidden" name="ID_MISSION" value="' . $mission['ID_MISSION'] . '">
                        <input type="submit"  class="bouton" value="Supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette mission ?\');">
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