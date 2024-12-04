<?= $this->extend('_layout') ?>
<?= $this->section('contenu') ?>

<div>

    <h1 classe="titres-blanc">Modifier une Mission</h1>

</div>
</header>
<section>
    <div class="form-style">

        <form method="post" action="<?= url_to('mission_update') ?>">

            <input type="hidden" name="ID_MISSION" value="<?= $mission['ID_MISSION'] ?>">
            <?php
            // die(var_dump($mission['ID_MISSION']));
            foreach ($listeProfil as $profil) {
                foreach ($missionJoins as $missionJoin) {

                    if ($profil['ID_PROFIL'] == $missionJoin['ID_PROFIL']) {

                        echo '<input type="hidden" name="ID_PROFIL" value="' . $profil['ID_PROFIL'] . '">';
                    }
                }
            }

            ?>

            <?php
            // die(var_dump($mission));
            // var_dump($mission);
            // var_dump($missionJoins);
            // die(var_dump($listeClient));
            // var_dump($listeClient);
            
            ?>
            <label for="ID_CLIENT">Client</label>
            <select name="ID_CLIENT">
                <?php
                //Affiche liste des clients pour choisir
                // Find a way to make client select
                $selected = "";
                foreach ($listeClient as $client) {
                    // Find a way to make client select
                    if ($client['ID_CLIENT'] == $mission['ID_CLIENT']) {
                        $selected = "SELECTED";
                        // echo "yahou";
                    } else
                        $selected = "";

                    echo '<option value="' . $client['ID_CLIENT'] . '" ' . $selected . '>' . $client['NOM'] . '</option>';
                }



                ?>
            </select>

            <label for="intitule">Intitulé</label>
            <input id="INTITULE_MISSION" name="INTITULE_MISSION" value=<?= $mission['INTITULE_MISSION'] ?> type="text">

            <label for="DESCRIPTION_MISSION">Déscription</label>
            <textarea id="DESCRIPTION_MISSION"
                name="DESCRIPTION_MISSION"><?= $mission['DESCRIPTION_MISSION'] ?></textarea>

            <label for="DATE_DEBUT">Date début</label>
            <input id="DATE_DEBUT" name="DATE_DEBUT" type="date" value=<?= $mission['DATE_DEBUT'] ?>>

            <label for="DATE_FIN">Date fin</label>
            <input id="DATE_FIN" name="DATE_FIN" type="date" value=<?= $mission['DATE_FIN'] ?>>

            <fieldset>
                <label>Profil</label>
                <?php
                foreach ($missionJoins as $missionJoin) {
                    echo '<label>' . $missionJoin['LIBELLE'] . ' : ' . $missionJoin['NOMBRE_PROFIL'] . '</label>';
                }

                ?>
            </fieldset>

            <input type="submit" value="Modifier">
        </form>

        <div class="form-style">
            <form method="post" action="<?= url_to('mission_update_ajout_profil') ?>">
                </fieldset>
                <input type="hidden" name="ID_MISSION" value="<?= $mission['ID_MISSION'] ?>">
                <?php

                foreach ($listeClient as $client) {

                    echo '<input type="hidden" name="ID_CLIENT" value="' . $client['ID_CLIENT'] . '">';
                }
                ?>

                <label for="ID_PROFIL">Ajoutez le(s) profil(s) :</label>
                <select name="ID_PROFIL">
                    <?php
                    // foreach ($missionJoins as $missionJoin) {
                    foreach ($profilNotInMissions as $profilNotInMission) {

                        // if ($profil['ID_PROFIL'] != $missionJoin['ID_PROFIL']) {
                    
                        echo '<option value="' . $profilNotInMission['ID_PROFIL'] . '">' . $profilNotInMission['LIBELLE'] . '</option>';
                        // }
                    }
                    // }
                    ?>
                </select>

                <input type="number" name="NOMBRE_PROFIL" value="1">

                <input type="submit" value="Ajout">
                </fieldset>
            </form>
        </div>

        <div class="form-style">
            <form method="post" action="<?= url_to('mission_update_supp_profil') ?>">
                <fieldset>
                    <input type="hidden" name="ID_MISSION" value="<?= $mission['ID_MISSION'] ?>">

                    <?php
                    foreach ($listeProfil as $profil) {
                        echo '<input type="hidden" name="ID_PROFIL" value="' . $profil['ID_PROFIL'] . '">';
                    }
                    ?>

                    <label for="ID_PROFIL">Supprimez le(s) profil(s) :</label>
                    <select name="ID_PROFIL">
                        <?php
                        foreach ($listeProfil as $profil) {
                            foreach ($missionJoins as $missionJoin) {

                                if ($profil['ID_PROFIL'] == $missionJoin['ID_PROFIL']) {
                                    echo '<option class="noir" value="' . $missionJoin['ID_PROFIL'] . '">' . $missionJoin['LIBELLE'] . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" value="Supprime">
                </fieldset>
            </form>
        </div>

    </div>
</section>

<?= $this->endSection() ?>