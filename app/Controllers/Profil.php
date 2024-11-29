<?php

namespace App\Controllers;

/**
 * Classe Profil
 */
class Profil extends BaseController
{
    public $profilsModel;

    public function __construct()
    {
        $this->profilsModel = model('Profil');
    }

    private function isAuthorized(): bool
    {
        $user = auth()->user();
        return $user->inGroup('admin') || $user->inGroup('rhu');
    }

    //------------------------------------------
    //Liste
    public function liste()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }


        $listeProfils = $this->profilsModel->findall();
        return view(
            'profils_liste',
            [
                'listeProfils' => $listeProfils
            ]
        );
    }

    //------------------------------------------
    //Ajouter

    public function ajout()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        return view('profils_ajoute');
    }

    //Create
    public function create()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $profilsData = $this->request->getpost();
        $this->profilsModel->save($profilsData);

        return redirect('profils_liste');
    }
    //------------------------------------------
    // Modifier
    public function modif($profil)
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $modifProfils = $this->profilsModel->find($profil);

        return view(
            'profils_modifier',
            [
                'afficheProfils' => $modifProfils
            ]
        );
    }

    // Update
    public function update()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $profilsData = $this->request->getpost();
        $this->profilsModel->save($profilsData);

        return redirect('profils_liste');
    }
    //------------------------------------------
    // Delete
    public function delete()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $profilsData = $this->request->getpost();
        $this->profilsModel->delete($profilsData['ID_PROFIL']);

        return redirect('profils_liste');
    }
}
