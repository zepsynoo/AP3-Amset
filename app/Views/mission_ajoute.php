<?= $this->extend('_layout')?>
<?= $this->section('contenu')?>

<form method="post" action="<?= url_to('mission_update')?>">
    <label for="client">Client</label>
    <select name="ID_CLIENT">
        <?php
//Affiche liste des clients pour choisir
    //faire un foreach on profil to affich all then 
    //Create a box to affect the amount we need of profil in the mission
        ?>
        
    </select>


</form>
<?php 
//
?>

<?= $this->endSection()?>