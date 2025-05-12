<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<div>

    <h1>Bienvenue sur la liste des Clients</h1>

</div>
</header>

<h2>Liste des Clients</h2>
<div>
    <section>
        <form method=get action=<?= url_to('client_ajout') ?>><button>Ajouter Client</button></form>
        <div class="table-container">
            <?php
            // creation d'un tableau pour afficher les clients
            use \CodeIgniter\View\Table;
            $tableau = new \CodeIgniter\View\Table();
            $tableau->setHeading('Nom', 'Prenom', 'Email', 'Telephone', 'Adresse', 'Ville', 'Code Postal', 'Raison Social', 'Modifier', 'Supprimer');

            // foreach pour afficher les clients
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

                    '<a href="' . url_to('client_modif', $client['ID_CLIENT']) . ' "><button>Modifier</button></a>',

                    '<form method="post" action="' . url_to('client_delete', $client['ID_CLIENT']) . '">
                        <input type="hidden" name="ID_CLIENT" value="' . $client['ID_CLIENT'] . '">
                        <input type="submit" class="bouton" value="Supprimer" onclick="return confirm(\'Si vous supprimer ce client cela supprimeras tout les mission qui sont associer à ce client\')" >
                    </form>'
                );
            }
            echo $tableau->generate();
            ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>