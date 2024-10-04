<?= $this->extend('_layout')?>
<?= $this->section('contenu')?>

<div>

    <h1>Bienvenue sur la liste des Mission</h1>

    <h2>Liste des Mission</h2>

</div>

<section>
<?php
        $table = new \CodeIgniter\View\Table();

        $table->setHeading('Intitulé', 'Description', 'Client', 'Début', 'Fin');
        
    ?>

</section>

<?= $this->endSection()?>