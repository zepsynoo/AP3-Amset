<?php

namespace App\Controllers;

/**
 * Classe qui gère les mission
 */
class Mission extends BaseController
{
    private $missionModel;
    private $clientModel;
    private $profilModel;
    private $salarieModel;

    /**
     * Constructeur de la modèle Mission
     * Instanciation des model Mission, Client, Profil et Salarie
     * @return void
     */
    public function __construct()
    {
        $this->missionModel = model('Mission');
        $this->clientModel = model('Client');
        $this->profilModel = model('Profil');
        $this->salarieModel = model('Salarie');
    }

    // function pour vérifier si l'utilisateur est admin ou com
    // pour afficher les pages admin et com
    private function isAuthorized(): bool
    {
        $user = auth()->user();
        return $user->inGroup('admin') || $user->inGroup('com');
    }


    public function liste()
    {
        // Vérifie si l'utilisateur est admin ou com
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        // Récupère les missions 
        $listeMission = $this->missionModel->findAll();
        // Récupère les clients et les missions
        $clientMissionProfils = $this->missionModel->getClientMissionProfil();

        $missionClients = $this->missionModel->getMissionClient();

        $listeJoinMissionSalarie = $this->missionModel->getJoinMissionSalarie();

        //Retourn la vue 'mission_liste'
        return view('mission_liste', [
            'listeMission' => $listeMission,
            'missionClients' => $missionClients,
            'clientMissionProfils' => $clientMissionProfils,
            'listeJoinMissionSalaries' => $listeJoinMissionSalarie
        ]);
    }

    /**
     * Méthode qui renvoie vers le formulaire d'ajout mission
     */
    public function ajout()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $listeClient = $this->clientModel->findAll();
        $listeProfil = $this->profilModel->findAll();

        return view('mission_ajoute', [
            'listeClient' => $listeClient,
            'listeProfil' => $listeProfil
        ]);
    }

    /**
     * Méthode qui crée le mission
     */
    public function create()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $data = $this->request->getPost();
        $this->missionModel->save($data);

        // récupérer l'id de mission généré lors de la précédente insertion
        $nouvelMissionId = $this->missionModel->getInsertID();

        // var_dump($data);

        // foreach sur les profils
        $profils = $this->request->getPost('profils[]');
        // var_dump($profils);
        foreach ($profils as $idProfil) {
            // var_dump($idProfil);
            $nbre = $this->request->getPost($idProfil);
            $this->missionModel->addProfil($nouvelMissionId, $idProfil, $nbre);
        }

        return redirect('mission_liste');
    }

    /**
     * Méthode qui réaffiche le mission à modifier
     */
    public function modif($missionId)
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        //Récupère le mission par rapport à son id
        $mission = $this->missionModel->find($missionId);
        //Table client
        $listeClient = $this->clientModel->findAll();
        //Table profils
        $listeProfil = $this->profilModel->findAll();
        //Jointure sur client, mission, profil
        $missionJoins = $this->missionModel->getJoinMissionInfo($missionId);

        $profilNotInMissions = $this->profilModel->getProfilNotInMission($missionId);

        // die(var_dump($profilNotInMission));



        return view('mission_modifier', [
            'mission' => $mission,
            'missionJoins' => $missionJoins,
            'listeClient' => $listeClient,
            'listeProfil' => $listeProfil,
            'profilNotInMissions' => $profilNotInMissions
        ]);
    }

    /**
     * Méthode qui mettre à jour les données de mission
     */
    public function update()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $data = $this->request->getPost();
        // die(var_dump($data));
        if (isset($data)) {

            $data = $this->request->getPost();

            $this->missionModel->save($data);


            $missionId = $this->request->getPost('ID_MISSION');

            $this->missionModel->deleteSalarieMission($missionId);


            return redirect('mission_liste');
        }
    }

    public function updateAddProfil()
    {

        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $missionId = $this->request->getPost('ID_MISSION');
        $profilId = $this->request->getPost('ID_PROFIL');

        $nbre = $this->request->getPost('NOMBRE_PROFIL');

        $this->missionModel->addProfil($missionId, $profilId, $nbre);
        return redirect()->to('modif-mission-' . $missionId);
    }

    public function updateDeleteProfil()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $missionId = $this->request->getPost('ID_MISSION');

        $profilId = $this->request->getPost('ID_PROFIL');

        $this->missionModel->deleteProfil($missionId, $profilId);

        return redirect()->to('modif-mission-' . $missionId);
    }

    /**
     * Méthode qui supprime le mission
     */
    public function delete()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $missionId = $this->request->getPost('ID_MISSION');
        // 
        $this->missionModel->deleteProfilMission($missionId);

        $this->missionModel->deleteSalarieMission($missionId);

        $this->missionModel->delete($missionId);

        return redirect('mission_liste');
    }

    public function PageAttributionDesSalarie($missionId)
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $mission = $this->missionModel->find($missionId);

        $profilsMission = $this->missionModel->getMissionProfil($missionId);

        $listeSalarie = $this->salarieModel->findAll();

        $profilsSalarie = [];
        foreach ($listeSalarie as $salarie) {
            $profilsSalarie[] = $this->salarieModel->getProfil($salarie['ID_SALARIE']);
        }

        return view('mission_affecter_salarier', [
            'mission' => $mission,
            'profilsMission' => $profilsMission,
            'listeSalarie' => $listeSalarie,
            'profilsSalarie' => $profilsSalarie,
        ]);
    }


    public function affect()
    {

        $data = $this->request->getPost();
        // die(var_dump($data));
        $nbr = $this->request->getPost('nbr');

        $missionId = $this->request->getPost('ID_MISSION_0');

        $this->missionModel->deleteSalarieMission($missionId);

        //Cette partie vérifie si c'est le même 
        for ($i = 0; ($i < $nbr); $i++) {
            $salarieId = $this->request->getPost('ID_SALARIE_' . $i);

            $missionId = $this->request->getPost('ID_MISSION_' . $i);
            $salarieId2 = $this->request->getPost('ID_SALARIE_' . ($i + 1));

            $nombreMission = $this->missionModel->getNombreSalarieMission($missionId);

            if ($salarieId != '' || $salarieId != null) {
                if ($salarieId == $salarieId2) {
                    echo '<h1>Selection des salariés non valide !<h1>';
                    echo '<a href=' . url_to("mission_attribution", $missionId) . '><button>Retour</button>';

                    $this->missionModel->deleteSalarieMission($missionId);
                    die();

                } else {

                    $this->missionModel->addSalarieMission($salarieId, $missionId);
                }
            } else {
                echo '<h1>Selection des salariés vide !<h1>';
                echo '<a href=' . url_to("mission_attribution", $missionId) . '><button>Retour</button>';
                $this->missionModel->deleteSalarieMission($missionId);
                die();
            }
        }
        ;
        return redirect()->to(url_to("mission_liste", $missionId));
    }
}
