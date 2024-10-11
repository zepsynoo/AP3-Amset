<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<div>

    <h1>Bienvenue sur la liste des Mission</h1>

    <h2>Liste des Mission</h2>

</div>

<section>
    <a class="bouton" href="<?= url_to('mission_ajout')?>">Ajout mission</a>
    <?php
    // var_dump($listeMission);
    $table = new \CodeIgniter\View\Table();
    $table->setHeading('Client concerné' ,'Intitulé', 'Description', 'Début', 'Fin', 'Affecter mission', 'Modifier', 'Supprimer');
    foreach ($listeMission as $mission) {
        $table->addRow(
            $mission['ID_CLIENT'],
            $mission['INTITULE_MISSION'],
            $mission['DESCRIPTION_MISSION'],
            $mission['DATE_DEBUT'],
            $mission['DATE_FIN'],
            '<a class="bouton" href="' . url_to('mission_affect', $mission['ID_CLIENT']) . '"> Affecter </a>',
            '<a class="bouton" href="' . url_to('mission_modif', $mission['ID_CLIENT']) . '"> Modifier </a>',
            '<a class="bouton" href="' . url_to('mission_delete') . '"> Supprimer </a>'

        );
    }

    echo $table->generate();

    ?>

</section>

<?= $this->endSection() ?>