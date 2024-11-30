<?php

namespace App\Controllers;

class Client extends BaseController

{
    private $clientModel;

    public function __construct()
    {
        $this->clientModel = model('Client');
    }

    public function liste(): string
    {
        $clients = $this->clientModel->findAll();
        return view('clients_liste', ['clients' => $clients]);
    }

    public function ajout(): string
    {
        return view('clients_ajout');
    }


    public function create()
    {
        $data = $this->request->getPost();
        $imageName = $this->request->getPost('image_name');
        $file = $this->request->getFile('image');

        if ($file->isValid() && !$file->hasMoved()) {
            if ($imageName) {
                $newName = $imageName . '.' . $file->getExtension();
            } else {
                $newName = $file->getRandomName();
            }


            $file->move(WRITEPATH . '../public/upload/', $newName);

            $imagePath = 'upload/' . $newName;
            $data['IMG'] = $imagePath; // Stocker le chemin relatif à l'image dans la base de données
        } else {
            $data['IMG'] = null;
        }

        $this->clientModel->save($data);

        return redirect('client_liste');
    }


    public function modif($idClient): string
    {
        $client = $this->clientModel->find($idClient);

        return view('clients_modifier', ['client' => $client]);
    }


    public function update()
    {
        $data = $this->request->getPost();
        $imageName = $this->request->getPost('image_name');
        $file = $this->request->getFile('image');

        if ($file->isValid() && !$file->hasMoved()) {
            if ($imageName) {
                $newName = $imageName . '.' . $file->getExtension();
            } else {
                $newName = $file->getRandomName();
            }

            $file->move(WRITEPATH . '../public/upload/', $newName);
            $imagePath = 'upload/' . $newName;
            $data['IMG'] = $imagePath;
        }

        $this->clientModel->save($data);

        return redirect('client_liste');
    }


    public function delete($idClient)
    {
        $this->clientModel->delete($idClient);
        return redirect('client_liste');
    }
}
