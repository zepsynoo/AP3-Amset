<?= $this->extend('_layout')?>
<?= $this->section('contenu')?>

<section>

    <?php
        $table = new \CodeIgniter\View\Table();

        $table->setHeading('Intitulé', 'Description', 'Client', 'Début', 'Fin');
        
    ?>

</section>

<?= $this->endSection()?>