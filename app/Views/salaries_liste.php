<?= $this->extend('_layout') ?>

<?= $this->section('contenu') ?>

<div>

    <h1>Bienvenue sur la liste de Salariés</h1>

</div>

</header>
<!-- commencer le code ici  -->

<body>
    <h2>Liste des Salariés</h2>
    <a href="<?= url_to('salarie_ajout') ?>">Ajouter un Salariés</a>
</body>





<?= $this->endSection() ?>