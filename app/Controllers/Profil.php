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

    //------------------------------------------
    //Liste
    public function liste(): string
    {
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
        return view('profils_ajoute');
    }

    //Create
    public function create()
    {
        $profilsData = $this->request->getpost();
        $this->profilsModel->save($profilsData);

        return redirect('profils_liste');
    }
    //------------------------------------------
    // Modifier
    public function modif($profil)
    {
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
        $profilsData = $this->request->getpost();
        $this->profilsModel->save($profilsData);

        return redirect('profils_liste');
    }
    //------------------------------------------
    // Delete
    public function delete()
    {
        $profilsData = $this->request->getpost();
        $this->profilsModel->delete($profilsData['ID_PROFIL']);

        return redirect('profils_liste');
    }
}
