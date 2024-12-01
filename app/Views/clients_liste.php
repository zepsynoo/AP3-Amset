<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<div>

    <h1>Bienvenue sur la liste des Clients</h1>

    <h2>Liste des Clients</h2>

    <a href="<?= url_to('client_ajout') ?>"><button class="button">Ajouter Client</button></a>
    <?php var_dump($missions);?>
    <?php
    $tableau = new \CodeIgniter\View\Table();
    $tableau->setHeading('nom', 'prenom', 'email', 'telephone', 'adresse', 'ville', 'code postal', 'raison_social', 'modifier', 'supprimer');
    //-----------------------------------------
    // foreach pour message d'erreur
    // foreach ($missions as $mission)
    //     foreach ($clients as $client){
    //     if ($client['ID_CLIENT']== $mission['ID_CLIENT']) {
    //         echo '<script> alert("Il faut supprimer tout les mission qui sont en rapport avec le client que vous voulez supprimer")</script>',
    //         url_to('client_liste');
    //     } else {
    //         $msgErreur = '<input type="submit" value="Supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce client ?\')" >';
    //     }
    // }

    foreach ($clients as $client) {
        $tableau->addRow(
            $client['NOM'],
            $client['PRENOM'],
            $client['EMAIL'],
            $client['TELEPHONE'],
            $client['ADRESSE'],
            $client['VILLE'],
            $client['CODE_POSTAL'],
            $client['RAISON_SOCIAL'],

            '<a href="' . url_to('client_modif', $client['ID_CLIENT']) . ' "><button class="button">Modifier</button></a>',

            '<form method="post" action="' . url_to('client_delete', $client['ID_CLIENT']) . '">
                <input type="hidden" name="ID_CLIENT" value="' . $client['ID_CLIENT'] . '">
                <input type="submit" value="Supprimer" onclick="return confirm(\'Si vous supprimer ce client cela supprimeras tout les mission qui sont associer à ce client \')" >
                </form>'
        );
    }

    echo $tableau->generate();
    ?>


</div>

</header>
<!-- commencer le code ici  -->




<?= $this->endSection() ?>