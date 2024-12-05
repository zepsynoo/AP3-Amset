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

    private function isAuthorized(): bool
    {
        $user = auth()->user();
        return $user->inGroup('admin') || $user->inGroup('rhu');
    }

    //-----------------------------------
    // Liste

    public function liste()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        // Récupérer tous les profils pour le filtre
        $listeProfils = $this->profilModel->findAll();

        // Récupérer l'ID du profil sélectionné (si présent)
        $profilId = $this->request->getGet('profil');

        // Récupérer les salariés filtrés ou non
        if ($profilId) {
            $listeSalaries = $this->salarieModel->recupSalariesDuProfil((int) $profilId);
            // die(var_dump($listeSalaries));
        } else {
            $listeSalaries = $this->salarieModel->findAllAvecProfils();
        }

        // Passer les données à la vue
        return view(
            'salaries_liste',
            [
                'listeSalaries' => $listeSalaries,
                'listeProfils' => $listeProfils,
                'profilSelectionne' => $profilId, // Passer le profil sélectionné pour la vue
            ]
        );
    }

    //-----------------------------------
    // Ajouter

    public function ajout()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

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
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $salarieData = $this->request->getpost();
        $this->salarieModel->save($salarieData);

        //récupére l'id du salarie
        $nouvelSalarieID = $this->salarieModel->getInsertID();

        $profils = $this->request->getPost('profils[]');
        // die(var_dump($profils));
        foreach ($profils as $idProfil) {
            $this->salarieModel->addProfil($idProfil, $nouvelSalarieID);
        }

        return redirect('salarie_liste');
    }

    //-----------------------------------
    // Modifier
    public function modif($salarieId)
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

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
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $salarieData = $this->request->getpost();
        $this->salarieModel->save($salarieData);

        return redirect('salarie_liste');
    }

    //-------------------------------------
    // Delete
    public function delete()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $salarieData = $this->request->getpost(['ID_SALARIE']);
        $this->salarieModel->deleteProfilsSalarie($salarieData);
        $this->salarieModel->deleteMissionSalarie($salarieData);
        $this->salarieModel->delete($salarieData);
        return redirect('salarie_liste');
    }

    //-----------------------------------------
    //modifier profils salarie (ajouter/supprimer)

    public function ajoutProfil()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $idProfil = $this->request->getPost('ID_PROFIL');
        $idSalarie = $this->request->getPost('ID_SALARIE');
        $this->salarieModel->addProfil($idProfil, $idSalarie);

        return redirect()->to(url_to("salarie_modif", $idSalarie));
    }

    public function supprProfil()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        // $data = $this->request->getPost();
        $idSalarie = $this->request->getPost('ID_SALARIE');
        $idProfil = $this->request->getPost('ID_PROFIL');
        $this->salarieModel->deleteProfilSalarie($idSalarie, $idProfil);

        return redirect()->to(url_to("salarie_modif", $idSalarie));
    }



}
