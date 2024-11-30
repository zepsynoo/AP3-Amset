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
<<<<<<< HEAD
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
=======
>>>>>>> 64f6b69f54d5de5152a53b83f07231fec733284c

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
<<<<<<< HEAD
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
=======
>>>>>>> 64f6b69f54d5de5152a53b83f07231fec733284c

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
