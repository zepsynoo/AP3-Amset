<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<div>

    <h1>Bienvenue sur la liste des Clients</h1>

    <h2>Liste des Clients</h2>

    <a href="<?= url_to('client_ajout') ?>"><button class="button">Ajouter Client</button></a>

    <?php
    $tableau = new \CodeIgniter\View\Table();
    $tableau->setHeading('nom', 'prenom', 'email', 'telephone', 'adresse', 'ville', 'code postal', 'raison social', 'image', 'modifier', 'supprimer');

    foreach ($clients as $client) {
        $imageSrc = $client['IMG'] ? base_url($client['IMG']) : 'default-image-path.jpg';
        var_dump($client);
        $tableau->addRow(
            $client['NOM'],
            $client['PRENOM'],
            $client['EMAIL'],
            $client['TELEPHONE'],
            $client['ADRESSE'],
            $client['VILLE'],
            $client['CODE_POSTAL'],
            $client['RAISON_SOCIAL'],
            '<img src="' . $imageSrc . '" alt="Image du client" width="100" height="100">',
            '<a href="' . url_to('client_modif', $client['ID_CLIENT']) . ' "><button class="button">Modifier</button></a>',
            '<a href="' . url_to('client_delete', $client['ID_CLIENT']) . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce client ?\')"><button class="button">Supprimer</button></a>'
        );
    }

    echo $tableau->generate();
    ?>


</div>

</header>
<!-- commencer le code ici  -->




<?= $this->endSection() ?>