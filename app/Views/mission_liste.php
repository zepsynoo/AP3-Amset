<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<div>

    <h1>Bienvenue sur la liste des Mission</h1>

    <h2>Liste des Mission</h2>

</div>

<section>
    <a class="bouton" href="<?= url_to('mission_ajout') ?>">Ajout mission</a>
    <?php
//    die(var_dump($listeProfil));
  // die(var_dump($missionProfil));
    // var_dump($listeMission);
    $table = new \CodeIgniter\View\Table();
    $table->setHeading('Client concerné', 'Intitulé', 'Description', 'Profil(s)', 'Début', 'Fin', 'Affecter les salarié', 'Modifier', 'Supprimer');
    foreach ($listeMission as $mission) {
        foreach ($missionProfil as $mProfil) {
            foreach ($listeProfil as $profil) {
                $PlaceHolder = $profil['ID_PROFIL'] == $mProfil['ID_PROFIL'] ? $profil['LIBELLE'] . 'x' . $mProfil['NOMBRE_PROFIL'] : '';
                $table->addRow(
                    $mission['ID_CLIENT'],
                    $mission['INTITULE_MISSION'],
                    $mission['DESCRIPTION_MISSION'],
                    $PlaceHolder,
                    $mission['DATE_DEBUT'],
                    $mission['DATE_FIN'],
                    '<a class="bouton" href="' . url_to('mission_affect', $mission['ID_CLIENT']) . '"> Affecter </a>',
                    '<a class="bouton" href="' . url_to('mission_modif', $mission['ID_MISSION']) . '"> Modifier </a>',
                    '<a class="bouton" href="' . url_to('mission_delete') . '"> Supprimer </a>'

                );
            }
        }
    }




    echo $table->generate();

    ?>

</section>

<?= $this->endSection() ?>