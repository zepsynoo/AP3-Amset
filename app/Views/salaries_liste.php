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
        <div>
            <?php

            use \CodeIgniter\View\Table;
            use PhpParser\Node\Expr\AssignOp\Div;

            $table = new \CodeIgniter\View\Table();
            $table->setHeading('Prenom', 'Nom', 'Civilité', 'Email', 'Téléphone', 'Adresse', 'Code Postal', 'Ville', 'modifier', 'supprimer');

            foreach ($listeSalaries as $salarie) {
                $table->addRow(
                    // $salarie['IMG_SALARIE'],
                    $salarie['PRENOM_SALARIE'],
                    $salarie['NOM_SALARIE'],
                    $salarie['CIVILITE'],
                    $salarie['EMAIL_SALARIE'],
                    $salarie['TELEPHONE_SALARIE'],
                    $salarie['ADRESSE_SALARIE'],
                    $salarie['CODE_POSTAL_SALARIE'],
                    $salarie['VILLE_SALARIE'],
                    '<a href="' . url_to('salarie_modif', $salarie['ID_SALARIE']) . '">Modifier</a>',

                    '<form method=post action="' . url_to('salarie_delete', $salarie['ID_SALARIE']) . '">
	                <input type="hidden" name="ID_SALARIE" value="' . $salarie['ID_SALARIE'] . '">
	                <input type="submit" value="Supprimer">
                    </form>'
                );
            }
            echo $table->generate();
            ?>
        </div>
    </section>
</div>



<?= $this->endSection() ?>