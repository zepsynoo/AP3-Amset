<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<div>

    <h1>Bienvenue sur la liste de Salariés</h1>

</div>
</header>

<h2>Affectation des salariés aux mission</h2>

<?php
// var_dump($mission);
// var_dump($profilsMission);
// var_dump($listeSalarie);
// die();
?>

<section>
    <div class="form-style">
        <form method="post" action="<?= url_to('mission_affect') ?>">
            <fieldset>
                <legend>Affectation</legend>
                <p class="red">\Vous ne pouvez pas ajouter deux fois le meme salarier/</p>
                <div>
                    <?php
                    $y = 0;
                    // $z = 0;
                    foreach ($profilsMission as $profilM) {
                        // var_dump($profilM);
                        // $y += $z;
                        for ($i = 0; $i != $profilM['NOMBRE_PROFIL']; $i++) {
                            ?>
                            <div>
                                <label><?= $profilM['LIBELLE'] ?></label>

                                <input id="ID_MISSION" name=<?= 'ID_MISSION_' . $y ?> type="hidden"
                                    value="<?= $mission['ID_MISSION'] ?>">

                                <input id="ID_PROFIL" name=<?= 'ID_PROFIL_' . $y ?> type="hidden"
                                    value="<?= $profilM['ID_PROFIL'] ?>">

                                <select id="ID_SALARIE" name="<?= 'ID_SALARIE_' . $y ?>">

                                    <option value="" require>Sélectionner un salarié</option>
                                    <?php
                                    foreach ($listeSalarie as $salarie) {
                                        foreach ($profilsSalarie as $profils) {
                                            foreach ($profils as $profil) {
                                                if ($salarie['ID_SALARIE'] == $profil['ID_SALARIE']) {
                                                    if ($profil['ID_PROFIL'] == $profilM['ID_PROFIL']) {
                                                        echo '<option value="' . $salarie['ID_SALARIE'] . '" required>' . $salarie['NOM_SALARIE'] . '</option>';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                            $y += 1;
                        }
                    }
                    ?>
                </div>
            </fieldset>
            <input name="nbr" type="hidden" value="<?= $y ?>">
            <input type="submit" value="+">
        </form>
        <a href=<?= url_to("mission_liste", $mission['ID_MISSION']) ?>><button>Retour</button></a>

    </div>
</section>




<?= $this->endSection() ?>