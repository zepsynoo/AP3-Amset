<?php

namespace App\Controllers;

class Client extends BaseController

{
    private $clientModel;
    private $missionModel;

    public function __construct()
    {
        $this->clientModel = model('Client');
        $this->missionModel = model('Mission');
<<<<<<< HEAD
=======
    }

    private function isAuthorized(): bool
    {
        $user = auth()->user();
        return $user->inGroup('admin') || $user->inGroup('com');
>>>>>>> 6e736d3cb75c086c775256101bf9ef4528076441
    }

    //-------------------------------------
    // affichage

    public function liste(): string
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $clients = $this->clientModel->findAll();
        $missions = $this->missionModel->findAll();
        return view(
            'clients_liste', 
            [
                'clients' => $clients,
                'missions' => $missions
            ]);

    }

    //-------------------------------------
    // ajout

    public function ajout(): string
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        return view('clients_ajout');
    }


    public function create()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $data = $this->request->getPost();
    
        $this->clientModel->save($data);

        return redirect('client_liste');
    }

    //-------------------------------------
    // modif

    public function modif($idClient): string
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $client = $this->clientModel->find($idClient);

        return view('clients_modifier',['client'=>$client]);
    }


    public function update()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $data = $this->request->getPost();
    
        $this->clientModel->save($data);

        return redirect('client_liste');
    }
    //-------------------------------------
    // Delete

    public function delete()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }
        
        $clientData = $this->request->getPost(['ID_CLIENT']);

        $missionData = $this->clientModel->getIdMission($clientData);

        // var_dump($clientData);
        // die();
        
        $this->clientModel->deleteMissionProfils($missionData);

        $this->clientModel->deleteMissionSalarie($missionData);
        
        $this->clientModel->deleteMissionClient($clientData['ID_CLIENT']);

        $this->clientModel->delete($clientData);

        return redirect('client_liste');
    }
}
