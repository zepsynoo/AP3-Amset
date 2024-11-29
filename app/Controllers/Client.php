<?php

namespace App\Controllers;



class Client extends BaseController

{
    private $clientModel;


    public function __construct()
    {
        $this->clientModel = model('Client');
    }

    private function isAuthorized(): bool
    {
        $user = auth()->user();
        return $user->inGroup('admin') || $user->inGroup('com');
    }

    public function liste()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $clients = $this->clientModel->findAll();
        return view('clients_liste', ['clients' => $clients]);
    }

    public function ajout()
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


    public function modif($idClient)
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $client = $this->clientModel->find($idClient);

        return view('clients_modifier', ['client' => $client]);
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


    public function delete($idClient)
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $this->clientModel->delete($idClient);
        return redirect('client_liste');
    }
}
