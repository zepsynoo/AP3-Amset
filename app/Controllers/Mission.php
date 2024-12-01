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
        $clientMissionProfil = $this->missionModel->getClientMissionProfil();

        //affecter un variable qui va contenir le salarié affecter

        //affecter un variable qui y aura les mission de profils

        //Retourn la vue 'mission_liste'
        return view('mission_liste', [
            'listeMission' => $listeMission,
            'clientMissionProfils' => $clientMissionProfil
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
        $listeClient = $this->clientModel->findAll();
        $listeProfil = $this->profilModel->findAll();

        return view('mission_modifier', [
            'mission' => $mission,
            'listeClient' => $listeClient,
            'listeProfil' => $listeProfil
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

        $data = $this->request->getPost();
        $this->missionModel->save($data);

        return redirect('mission_liste');
    }

    /**
     * Méthode qui supprime le mission
     */
    public function delete($missionId)
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }
        
        //Instruction pour supprimer le mission
        $this->missionModel->delete($missionId);

        return redirect('mission_liste');
    }
}
