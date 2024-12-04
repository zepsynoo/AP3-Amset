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

    /**
     * Constructeur de la modèle Mission
     * Instanciation de modèl mission
     */
    public function __construct()
    {
        $this->missionModel = model('Mission');
        $this->clientModel = model('Client');
        $this->profilModel = model('Profil');
    }

    private function isAuthorized(): bool
    {
        $user = auth()->user();
        return $user->inGroup('admin') || $user->inGroup('com');
    }


    /**
     * Méthode qui liste tous les mssion dans la vue
     * @return String 
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
     * @return String 
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


        // $data = $this->request->getPost(['ID_CLIENT', 'INTITULE_MISSION', 'DESCRIPTION_MISSION', 'DATE_DEBUT', 'DATE_FIN']);
        $data = $this->request->getPost();
        // die(var_dump($data));
        $this->missionModel->save($data);

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

        $missionId = $this->request->getPost('ID_MISSION');
        $profilId = $this->request->getPost('ID_PROFIL');
        // die(var_dump($profilId));
        $nbre = $this->request->getPost('NOMBRE_PROFIL');

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

        $missionId = $this->request->getPost('ID_MISSION');
        // die(var_dump($missionId));
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
}
