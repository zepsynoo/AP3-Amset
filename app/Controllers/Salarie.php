<?php

namespace App\Controllers;

/**
 * Classe Salarier
 */
class Salarie extends BaseController
{
    private $salarieModel;
    private $profilModel;
    private $salarieProfilModel;

    public function __construct()
    {
        $this->salarieModel = model('Salarie');
        $this->profilModel = model('Profil');
        $this->salarieProfilModel = model('SalarieProfil');
    }

    //-----------------------------------
    // Liste

    public function liste()
    {
        // Récupérer les salariés avec leurs profils
        $listeSalaries = $this->salarieModel->findAllAvecProfils();

        // Passer les données à la vue
        return view(
            'salaries_liste',
            [
                'listeSalaries' => $listeSalaries
            ]
        );
    }

    //-----------------------------------
    // Ajouter

    public function ajout(): string
    {
        $idSalaries = $this->salarieModel->find();
        $listeProfils = $this->profilModel->findAll();

        return view(
            'salaries_ajoute',
            [
                'listeProfils' => $listeProfils,
            ]
        );
    }

    // Create
    public function create()
    {
        $salarieData = $this->request->getpost();
        $this->salarieModel->save($salarieData);

        //récupére l'id du salarie
        $nouvelSalarieID = $this->salarieModel->getInsertID();

        $profils = $this->request->getPost('profils[]');

        foreach ($profils as $idProfil) {
            $this->salarieModel->addProfil($idProfil, $nouvelSalarieID);
        }

        return redirect('salarie_liste');
    }

    //-----------------------------------
    // Modifier
    public function modif($salarieId)
    {
        $salarie = $this->salarieModel->find($salarieId);
        $idSalarie = $salarie['ID_SALARIE'];
        $listeProfilsSalaries = $this->salarieModel->getProfil($salarieId);
        $listNonProfilSalarie = $this->profilModel->getProfilsNotSalarie($idSalarie);
        return view(
            'salaries_modifier',
            [
                'salarieAffiche' => $salarie,
                'listeProfilsSalaries' => $listeProfilsSalaries,
                'listNonProfilSalarie' => $listNonProfilSalarie
            ]
        );
    }

    // Update
    public function update()
    {
        $salarieData = $this->request->getpost();
        $this->salarieModel->save($salarieData);

        return redirect('salarie_liste');
    }

    //-------------------------------------
    // Delete
    public function delete()
    {
        
        $salarieData = $this->request->getpost(['ID_SALARIE']);
        $this->salarieModel->deleteProfilsSalarie($salarieData);
        $this->salarieModel->delete($salarieData);
        return redirect('salarie_liste');
    }

    //-----------------------------------------
    //modifier profils salarie (ajouter/supprimer)

    public function ajoutProfil()
    {
        $idProfil = $this->request->getPost('ID_PROFIL');
        $idSalarie = $this->request->getPost('ID_SALARIE');
        $this->salarieModel->addProfil($idProfil,$idSalarie);

        return redirect()->to(url_to("salarie_modif", $idSalarie));
    }

    public function supprProfil()
    {
        // $data = $this->request->getPost();
        $idSalarie = $this->request->getPost('ID_SALARIE');
        $idProfil = $this->request->getPost('ID_PROFIL');
        $this->salarieModel->deleteProfilSalarie($idSalarie, $idProfil);

        return redirect()->to(url_to("salarie_modif", $idSalarie));
    }



}
