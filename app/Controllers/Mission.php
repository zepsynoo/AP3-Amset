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

    /**
     * Méthode qui liste tous les mssion dans la vue
     * @return String 
     */
    public function liste(): string
    {
        //Variable qui récupère la table mission
        $listeMission = $this->missionModel->findAll();

        //Retourn la vue 'mission_liste'
        return view('mission_liste', [
            'listeMission' => $listeMission
        ]);
    }

    /**
     * Méthode qui renvoie vers le formulaire d'ajout mission
     * @return String 
     */
    public function ajout(): string
    {   $listeClient = $this->clientModel->findAll();
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
        $data = $this->request->getPost();
        $this->missionModel->save($data);

        // récupérer l'id de mission généré lors de la précédente insertion
        $nouvelMissionId = $this->missionModel->getInsertID();
        // faire un var_dump sur $data pour analyser la structure
        //var_dump($data);

        // foreach sur les profils
        // recup nombre de personnes pour le profil courant
        // insert dans profil_mission... solution :
        // > utiliser méthode spéciale (à créer) dans le modèle mission : addProfil($idMission, $idProfil, $nbProfils)
            $this->missionModel->addProfil($nouvelMissionId);

        // return redirect('mission_liste');
        return null;
    }

    /**
     * Méthode qui réaffiche le mission à modifier
     */
    public function modif($missionId): string
    {
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
        $data = $this->request->getPost();
        $this->missionModel->save($data);

        return redirect('mission_liste');
    }

    /**
     * Méthode qui supprime le mission
     */
    public function delete($missionId)
    {
        //Instruction pour supprimer le mission
        $this->missionModel->delete($missionId);

        return redirect('mission_liste');
    }
}