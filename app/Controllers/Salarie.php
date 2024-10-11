<?php

namespace App\Controllers;
/**
 * Classe Salarier
 */
class Salarie extends BaseController
{
    private $salarieModel;

    public function __construct()
    {
        $this->salarieModel = model('Salarie');
    }

    //-----------------------------------
    // Liste
    public function liste()
    {
        $listeSalaries = $this->salarieModel->findAll();
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
        // $ajoutProfils = $this->profilsModel->findAll();
        return view('salaries_ajoute');
    }

    // Create
    public function create()
    {
        $salarieData = $this->request->getpost();
        $this->salarieModel->save($salarieData);

        return redirect('salarie_liste');
    }

    //-----------------------------------
    // Modifier
    public function modif($salarie)
    {
        $modifSalaries = $this->salarieModel->find($salarie);

        return view(
            'salaries_modifier',
            [
                'afficheSalaries' => $modifSalaries
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

    //-----------------------------------
    // Delete
    public function delete($salarie)
    {
        $this->salarieModel->delete($salarie);
        
        return redirect('salarie_liste');
    }
}
