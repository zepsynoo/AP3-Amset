<?= $this->extend('_layout') ?>

<?= $this->section('contenu') ?>

<div>

    <h1>Bienvenue sur la liste des Profils</h1>

</div>
</header>

<h2>Liste des Profil</h2>
<div>
    <!-- ($listeProfils) -->
    <section>
        <form method=get action=<?= url_to('profils_ajout') ?>><button>Ajouter un Profils</button></form>
        <div>
            <?php 

            use \CodeIgniter\View\Table;
            use PhpParser\Node\Expr\AssignOp\Div;

            $table = new \CodeIgniter\View\Table();
            $table->setHeading('Libelle', 'modifier', 'supprimer');

            foreach ($listeProfils as $profil) {
                $table->addRow(
                    $profil['LIBELLE'],
                    '<a href="'.url_to('profils_modif', $profil['ID_PROFIL']).'"><button>Modifier</button></a>',

                    '<form method=post action="'.url_to('profils_delete', $profil['ID_PROFIL']).'">
	                <input type="hidden" name="ID_PROFIL" value="'.$profil['ID_PROFIL'].'">
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