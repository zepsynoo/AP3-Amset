<?php

namespace App\Controllers;

class Client extends BaseController

{
    private $clientModel;
    private $missionModel;

    public function __construct()
    {
        $this->clientModel = model('Client');
        $this->missionModel = model('mission');
    }

    //-------------------------------------
    // affichage

    public function liste(): string
    {
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
        return view('clients_ajout');
    }


    public function create()
    {
        $data = $this->request->getPost();
    
        $this->clientModel->save($data);

        return redirect('client_liste');
    }

    //-------------------------------------
    // modif

    public function modif($idClient): string
    {
        $client = $this->clientModel->find($idClient);

        return view('clients_modifier',['client'=>$client]);
    }


    public function update()
    {
        $data = $this->request->getPost();
    
        $this->clientModel->save($data);

        return redirect('client_liste');
    }
    //-------------------------------------
    // Delete

    public function delete()
    {
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
