<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<div>

    <h1>Bienvenue sur la liste de Salariés</h1>

</div>
</header>

<h2>Liste des Salariés</h2>
<div>
    <section>
        <form method=get action=<?= url_to('salarie_ajout') ?>><button>Ajouter un Salariés</button></form>
        <div class="table-container">
            <?php
            use \CodeIgniter\View\Table;
            $table = new \CodeIgniter\View\Table();
            $table->setHeading('Prenom', 'Nom', 'Civilité', 'Email', 'Téléphone', 'Adresse', 'Code-Postal', 'Ville', 'Profils', 'Modifier', 'Supprimer');

            foreach ($listeSalaries as $salarie) {
                $table->addRow(
                    esc($salarie['PRENOM_SALARIE']),
                    esc($salarie['NOM_SALARIE']),
                    esc($salarie['CIVILITE']),
                    esc($salarie['EMAIL_SALARIE']),
                    esc($salarie['TELEPHONE_SALARIE']),
                    esc($salarie['ADRESSE_SALARIE']),
                    esc($salarie['CODE_POSTAL_SALARIE']),
                    esc($salarie['VILLE_SALARIE']),
                    esc($salarie['profil']), // Profils concaténés
                    '<a href="' . url_to('salarie_modif', $salarie['ID_SALARIE']) . '"><button>Modifier</button></a>',

                    '<form method="post" action="' . url_to('salarie_delete', $salarie['ID_SALARIE']) . '">
                        <input type="hidden" name="ID_SALARIE" value="' . $salarie['ID_SALARIE'] . '">
                        <input type="submit" value="Supprimer" onclick="return confirm(\'Si vous supprimez ce salarié, cela supprimera toutes les affectations auxquelles il est associé. Confirmez-vous ?\')">
                    </form>'

                );
            }
            echo $table->generate();
            ?>
        </div>
    </section>
</div>



<?= $this->endSection() ?>