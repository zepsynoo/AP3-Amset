<?php

namespace App\Controllers;

/**
 * Classe qui gère les mission
 */
class Mission extends BaseController
{
    private $missionModel;
    private $clientModel;
    private $profilModel;
    private $salarieModel;

    /**
     * Constructeur de la modèle Mission
     * Instanciation de modèl mission
     */
    public function __construct()
    {
        $this->missionModel = model('Mission');
        $this->clientModel = model('Client');
        $this->profilModel = model('Profil');
        $this->salarieModel = model('Salarie');
    }

    private function isAuthorized(): bool
    {
        $user = auth()->user();
        return $user->inGroup('admin') || $user->inGroup('com');
    }


    /**
     * Méthode qui liste tous les mssion dans la vue
     */
    public function liste()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $listeMission = $this->missionModel->findAll();
        $clientMissionProfils = $this->missionModel->getClientMissionProfil();
        // die(var_dump($clientMissionProfil)); 
        $missionClients = $this->missionModel->getMissionClient();
        // die(var_dump($missionClients)); 
        // $missionProfils = $this->missionModel->getMissionProfil();
        // die(var_dump($missionProfils)); 

        //affecter un variable qui va contenir le salarié affecter

        //affecter un variable qui y aura les mission de profils

        //Retourn la vue 'mission_liste'
        return view('mission_liste', [
            'listeMission' => $listeMission,
            'missionClients' => $missionClients,
            'clientMissionProfils' => $clientMissionProfils
        ]);
    }

    /**
     * Méthode qui renvoie vers le formulaire d'ajout mission
     */
    public function ajout()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $listeClient = $this->clientModel->findAll();
        $listeProfil = $this->profilModel->findAll();

        return view('mission_ajoute', [
            'listeClient' => $listeClient,
            'listeProfil' => $listeProfil
        ]);
    }

    /**
     * Méthode qui crée le mission
     */
    public function create()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $data = $this->request->getPost();
        $this->missionModel->save($data);

        // récupérer l'id de mission généré lors de la précédente insertion
        $nouvelMissionId = $this->missionModel->getInsertID();

        // var_dump($data);

        // foreach sur les profils
        $profils = $this->request->getPost('profils[]');
        // var_dump($profils);
        foreach ($profils as $idProfil) {
            // var_dump($idProfil);
            $nbre = $this->request->getPost($idProfil);
            $this->missionModel->addProfil($nouvelMissionId, $idProfil, $nbre);
        }

        return redirect('mission_liste');
    }

    /**
     * Méthode qui réaffiche le mission à modifier
     */
    public function modif($missionId)
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }
        
        //Récupère le mission par rapport à son id
        $mission = $this->missionModel->find($missionId);
        //Table client
        $listeClient = $this->clientModel->findAll();
        //Table profils
        $listeProfil = $this->profilModel->findAll();
        //Jointure sur client, mission, profil
        $missionJoins = $this->missionModel->getJoinMissionInfo($missionId);
        
        $profilNotInMissions = $this->profilModel->getProfilNotInMission($missionId);
        
        // die(var_dump($profilNotInMission));



        return view('mission_modifier', [
            'mission' => $mission,
            'missionJoins' => $missionJoins,
            'listeClient' => $listeClient,
            'listeProfil' => $listeProfil,
            'profilNotInMissions' => $profilNotInMissions
        ]);
    }

    /**
     * Méthode qui mettre à jour les données de mission
     */
    public function update()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }


<<<<<<< HEAD
        $data = $this->request->getPost();
        die(var_dump($data));
        if (isset($data)) {
=======
        // $data = $this->request->getPost(['ID_CLIENT', 'INTITULE_MISSION', 'DESCRIPTION_MISSION', 'DATE_DEBUT', 'DATE_FIN']);
        $data = $this->request->getPost();
        // die(var_dump($data));
        $this->missionModel->save($data);
>>>>>>> 6e736d3cb75c086c775256101bf9ef4528076441

        $missionId = $this->request->getPost('ID_MISSION');
        // die(var_dump($missionId));
        // $profilId = $this->request->getPost('profil');
        // $nbre = $this->request->getPost('nombreProfil');

        // if ($missionId != null && $profilId != null && $nbre != null) {

        //     $this->missionModel->addProfil($missionId, $profilId, $nbre);
        // }


        return redirect()->to('modif-mission-' . $missionId);
    }

    public function updateAddProfil()
    {

        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

<<<<<<< HEAD

        $missionId = $this->request->getPost('missionId');
        $profilId = $this->request->getPost('profil');
        $nbre = $this->request->getPost('nombreProfil');

        if ($missionId != null && $profilId != null && $nbre != null) {
=======
        $missionId = $this->request->getPost('ID_MISSION');
        $profilId = $this->request->getPost('ID_PROFIL');
        // die(var_dump($profilId));
        $nbre = $this->request->getPost('NOMBRE_PROFIL');
>>>>>>> 6e736d3cb75c086c775256101bf9ef4528076441

        $this->missionModel->addProfil($missionId, $profilId, $nbre);

        return redirect()->to('modif-mission-' . $missionId);
    }

    public function updateDeleteProfil()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $missionId = $this->request->getPost('ID_MISSION');
        // die(var_dump($missionId));

        $profilId = $this->request->getPost('ID_PROFIL');
        // die(var_dump($profilId));

        $this->missionModel->deleteProfil($missionId, $profilId);

        return redirect()->to('modif-mission-' . $missionId);
    }

    /**
     * Méthode qui supprime le mission
     */
    public function delete()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

<<<<<<< HEAD
=======
        $missionId = $this->request->getPost('ID_MISSION');
        // die(var_dump($missionId));
>>>>>>> 6e736d3cb75c086c775256101bf9ef4528076441
        //Instruction pour supprimer le mission
        // $profils = $this->request->getPost('profils[]');
        // die(var_dump($profils));
        // foreach ($profils as $idProfil) {
        $this->missionModel->deleteProfilMission($missionId);
        // }
        // $this->missionModel->deleteMissionProfil($missionId);/
        $this->missionModel->delete($missionId);

        return redirect('mission_liste');
    }












    public function attribution($missionId)
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $mission = $this->missionModel->find($missionId);
        $profilsMission = $this->missionModel->getProfil($missionId);

        $listeSalarie = $this->salarieModel->findAll();
        $profilsSalarie = [];
        foreach ($listeSalarie as $salarie) {
            $profilsSalarie[] = $this->salarieModel->getProfil($salarie['ID_SALARIE']);
        }

        // var_dump($mission);
        // var_dump($profilsMission);
        // var_dump($listeSalarie);
        // die();

        return view('mission/affect_mission', [
            'mission' => $mission,
            'profilsMission' => $profilsMission,
            'listeSalarie' => $listeSalarie,
            'profilsSalarie' => $profilsSalarie,
        ]);
    }


    public function affect()
    {

        $data = $this->request->getPost();
        $nbr = $this->request->getPost('nbr');

        $missionId = $this->request->getPost('ID_MISSION_0');
        $this->missionModel->deleteSalarie($missionId);

        //Cette partie est OK mais il faut que je vérifie si c'est le même
        // for ($i = 0; ($i < $nbr); $i++) {
        //     $idSalarie = $this->request->getPost('ID_SALARIE_' . $i);
        //     $idMission = $this->request->getPost('ID_MISSION_' . $i);
        //     $this->missionModel->addSalarie($idSalarie, $idMission);
        // };

        //Cette partie vérifie si c'est le même
        for ($i = 0; ($i < $nbr); $i++) {
            $idSalarie = $this->request->getPost('ID_SALARIE_' . $i);
            $idMission = $this->request->getPost('ID_MISSION_' . $i);
            $idSalarie2 = $this->request->getPost('ID_SALARIE_' . ($i + 1));
            // var_dump($data);
            // die();
            // var_dump($idSalarie2);
            if ($idSalarie != '' || $idSalarie != null) {
                if ($idSalarie == $idSalarie2) {
                    echo '<h1>Selection des salariés non valide !<h1>';
                    echo '<a href=' . url_to("attribution_mission", $missionId) . '><button>Retour</button>';
                    $this->missionModel->deleteSalarie($missionId);
                    die();
                } else {

                    $this->missionModel->addSalarie($idSalarie, $idMission);
                }
            } else {
                echo '<h1>Selection des salariés vide !<h1>';
                echo '<a href=' . url_to("attribution_mission", $missionId) . '><button>Retour</button>';
                $this->missionModel->deleteSalarie($missionId);
                die();
            }
        }
        ;


        return redirect()->to(url_to("mission_liste", $missionId));
    }

}
