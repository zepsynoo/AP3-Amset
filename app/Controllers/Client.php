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

    }

    // function pour vérifier si l'utilisateur est admin ou com
    // pour afficher les pages admin et com
    private function isAuthorized(): bool
    {
        $user = auth()->user();
        return $user->inGroup('admin') || $user->inGroup('com');

    }

    // ---------------affichage--------------------------------------------------------//

    // affiche la liste des clients et des missions
    public function liste()
    {
        // Vérifie si l'utilisateur est admin ou com
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        // Récupère les clients et les missions 
        $clients = $this->clientModel->findAll();
        $missions = $this->missionModel->findAll();


        return view(
            'clients_liste',
            [
                'clients' => $clients,
                'missions' => $missions
            ]
        );

    }

    // --------------------ajout + create----------------------------------------------------------//

    // affiche le formulaire d'ajout d'un client
    // et le renvoie à la vue clients_ajout
    public function ajout()
    {
        // Vérifie si l'utilisateur est admin ou com
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        return view('clients_ajout');
    }


    public function create()
    {
        // Vérifie si l'utilisateur est admin ou com
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        // Récupère les données de la requête POST
        $data = $this->request->getPost();

        // enregistre les données dans la base de données
        $this->clientModel->save($data);

        // redirect vers la vue clients_liste
        return redirect('client_liste');
    }

    //------------------modif + upadte--------------------------------------//

    public function modif($idClient)
    {
        // Vérifie si l'utilisateur est admin ou com
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        // Récupère les données du client par rapport a son id
        $client = $this->clientModel->find($idClient);

        // retourne la vue clients_modifier
        // et lui envoie les données du client dans un tableau
        return view('clients_modifier', ['client' => $client]);
    }


    public function update()
    {
        // Vérifie si l'utilisateur est admin ou com
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        // Récupère les données de la requête POST
        $data = $this->request->getPost();

        // modifie les données dans la base de données
        // enregistre les données dans la base de données
        $this->clientModel->save($data);

        // redirect vers la vue clients_liste
        return redirect('client_liste');
    }
    //---------------------Delete------------------------------------------------------//

    public function delete()
    {
        // Vérifie si l'utilisateur est admin ou com
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        // Récupère l' id du client dans la requête POST
        $clientData = $this->request->getPost(['ID_CLIENT']);

        // recupère les données de la mission par l'id du client
        $missionData = $this->clientModel->getIdMission($clientData);

        // delete en cascade :
        // supprime les missions du client
        $this->clientModel->deleteMissionProfils($missionData);

        //  suprime les missions du salarié
        $this->clientModel->deleteMissionSalarie($missionData);

        // supprime les missions du client
        $this->clientModel->deleteMissionClient($clientData['ID_CLIENT']);

        // supprime le client
        $this->clientModel->delete($clientData);

        // redirect vers la vue clients_liste
        return redirect('client_liste');



        // Pour debug : 
        // var_dump($clientData);
        // die();
        // dd($clientData);
    }
}
