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
    $missionLigne = [];
    $i = 0;
    foreach ($listeMission as $mission) {
        $missionLigne[$i] = [];

        foreach ($clientMissionProfils as $clientMissionProfil) {
            if ($mission['ID_MISSION'] == $clientMissionProfil['ID_MISSION']) {
                
                if (!ISSET($missionLigne[$i]['profils'])) {
                    $missionLigne[$i] = $clientMissionProfil;
                    $missionLigne[$i]['profils'] = "";
                    $raisonSocial = $missionLigne[$i]['PRENOM'] . ' ' . $missionLigne[$i]['NOM'];
                }

                $missionLigne[$i]['profils'] .= $clientMissionProfil['LIBELLE'] . ' x' . $clientMissionProfil['NOMBRE_PROFIL'] . '<br/>';
            }
        }
        // die(var_dump($missionLigne[$i])); 
        $table->addRow(
            $raisonSocial,
            $missionLigne[$i]['INTITULE_MISSION'],
            $missionLigne[$i]['DESCRIPTION_MISSION'],
            $missionLigne[$i]['profils'],
            $missionLigne[$i]['DATE_DEBUT'],
            $missionLigne[$i]['DATE_FIN'],
            '<a class="bouton" href="' . url_to('mission_affect', $mission['ID_CLIENT']) . '"> Affecter </a>',
            '<a class="bouton" href="' . url_to('mission_modif', $mission['ID_MISSION']) . '"> Modifier </a>',
            '<a class="bouton" href="' . url_to('mission_delete') . '"> Supprimer </a>'
        );
        $i++;
    }
    
    echo $table->generate();

    ?>

</section>

<?= $this->endSection() ?>