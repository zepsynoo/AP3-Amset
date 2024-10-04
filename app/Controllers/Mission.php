<?php

namespace App\Controllers;
/**
 * Classe qui gère les mission
 */
class Mission extends BaseController
{
    private $missionModel;

    /**
     * Constructeur de la modèle Mission
     */
    public function __construct()
    {
        $this->missionModel = model('Mission');
    }

    /**
     * Méthode qui liste tous les mssion dans la vue
     * @return String Direction vers la vue
     */
    public function liste(): string
    {
        $listeMission = $this->missionModel->findAll();

        return view('mission_liste', [
            'listeMission' => $listeMission
        ]);
    }

    public function ajout(): string
    {   
        return view('mission_ajoute');
    }

    // public function create(): 
    // {
    //     $data = $this->missionModel->getPost();
    //     $this->missionModel->save($data);

    //     return redirect('mission_liste');
    // }
}