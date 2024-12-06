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
     * Instanciation de modèl mission
     */
    public function __construct()
    {
        $this->missionModel = model('Mission');
        $this->clientModel = model('Client');
        $this->profilModel = model('Profil');
        $this->salarieModel = model('Salarie');
    }

    private function isAuthorized(): bool
    {
        $user = auth()->user();
        return $user->inGroup('admin') || $user->inGroup('com');
    }


    /**
     * Méthode qui liste tous les mssion dans la vue
     */
    public function liste()
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        $listeMission = $this->missionModel->findAll();
        $clientMissionProfils = $this->missionModel->getClientMissionProfil();
        // die(var_dump($clientMissionProfil)); 
        $missionClients = $this->missionModel->getMissionClient();
        // die(var_dump($missionClients)); 
        // $missionProfils = $this->missionModel->getMissionProfil();
        // die(var_dump($missionProfils)); 
        
        $listeJoinMissionSalarie = $this->missionModel->getJoinMissionSalarie();
        // die(var_dump($joinMissionSalarie)); 

        //affecter un variable qui va contenir le salarié affecter

        //affecter un variable qui y aura les mission de profils

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

            // $data = $this->request->getPost(['ID_CLIENT', 'INTITULE_MISSION', 'DESCRIPTION_MISSION', 'DATE_DEBUT', 'DATE_FIN']);
            $data = $this->request->getPost();
            // die(var_dump($data));
            $this->missionModel->save($data);


            $missionId = $this->request->getPost('ID_MISSION');
            // die(var_dump($missionId));
            // $profilId = $this->request->getPost('profil');
            // $nbre = $this->request->getPost('nombreProfil');

            // if ($missionId != null && $profilId != null && $nbre != null) {

            //     $this->missionModel->addProfil($missionId, $profilId, $nbre);
            // }


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
        // die(var_dump($missionId));
        $profilId = $this->request->getPost('ID_PROFIL');
        // die(var_dump($profilId));
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
        // die(var_dump($missionId));
        //Instruction pour supprimer le mission
        // $profils = $this->request->getPost('profils[]');
        // die(var_dump($profils));
        // foreach ($profils as $idProfil) {
        $this->missionModel->deleteProfilMission($missionId);
        // }
        // $this->missionModel->deleteMissionProfil($missionId);/
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

        // die(var_dump($mission));
        // die(var_dump($missionId));
        // die(var_dump($profilsMission));
        // die(var_dump($listeSalarie));

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
        // // die(var_dump($nbr));

        $missionId = $this->request->getPost('ID_MISSION_0');
        // // die(var_dump($missionId));

        // $salarieId = $this->request->getPost('ID_SALARIE_0');
        // // die(var_dump($salarieId));

        // //Cree un methode 
        // $verif = $this->missionModel->verifSalarieMission($missionId, $salarieId);
        // // die(var_dump($verif));

        // $nombreMission = $this->missionModel->getNombreSalarieMission($missionId);
        // die(var_dump($nombreMission));

        // //Cree un condition ou il verifie si les cle primaire sont deja inserer dand salarie_mission
        // if ($verif == true) {
        //     $this->missionModel->deleteSalarieMission($missionId);
        // } 
        // if ($nombreMission >= $nbr) {
        //     $this->missionModel->deleteSalarieMission($missionId);
        // }

        // $this->missionModel->addSalarieMission($salarieId, $missionId);





        $this->missionModel->deleteSalarieMission($missionId);

        //Cette partie est OK mais il faut que je vérifie si c'est le même
        // for ($i = 0; ($i < $nbr); $i++) {
        //     $idSalarie = $this->request->getPost('ID_SALARIE_' . $i);
        //     $idMission = $this->request->getPost('ID_MISSION_' . $i);
        //     $this->missionModel->addSalarie($idSalarie, $idMission);
        // };

        //Cette partie vérifie si c'est le même
        for ($i = 0; ($i < $nbr); $i++) {
            $salarieId = $this->request->getPost('ID_SALARIE_' . $i);
            $missionId = $this->request->getPost('ID_MISSION_' . $i);
            $salarieId2 = $this->request->getPost('ID_SALARIE_' . ($i + 1));
            // var_dump($data);
            // die();
            // var_dump($idSalarie2);
            $nombreMission = $this->missionModel->getNombreSalarieMission($missionId);
            // die(var_dump($nombreMission));
            // die(var_dump($nombreMission));

            if ($salarieId != '' || $salarieId != null) {
                if ($salarieId == $salarieId2) {
                    echo '<h1>Selection des salariés non valide !<h1>';
                    echo '<a href=' . url_to("mission_attribution", $missionId) . '><button>Retour</button>';

                    $this->missionModel->deleteSalarieMission($missionId);
                    die();
                    // } elseif ($nombreMission > $nbr) {
                    //     $this->missionModel->deleteSalarieMission($missionId);
                } else {

                    $this->missionModel->addSalarieMission($salarieId, $missionId);
                }
            } else {
                echo '<h1>Selection des salariés vide !<h1>';
                echo '<a href=' . url_to("mission_attribution", $missionId) . '><button>Retour</button>';
                $this->missionModel->deleteSalarieMission($missionId);
                die();
            }
        };
        return redirect()->to(url_to("mission_liste", $missionId));
    }



    // }
    //     public function affect()
    // {
    //     $data = $this->request->getPost();
    //     $nbr = $this->request->getPost('nbr'); // Number of workers required
    //     $profile = $this->request->getPost('ID_PROFIL'); // Required profile for the mission
    //     // die(var_dump($profile));
    //     $missionId = $this->request->getPost('ID_MISSION');
    //     die(var_dump($missionId));

    //     // Retrieve workers matching the required profile
    //     $availableWorkers = $this->missionModel->getAvailableWorkersByProfile($profile);

    //     if (count($availableWorkers) === 0) {
    //         session()->setFlashdata('error', 'Aucun salarié ne correspond au profil demandé.');
    //         return redirect()->to(url_to("attribution_mission", $missionId));
    //     }

    //     // Get the current number of workers assigned to this mission
    //     $currentCount = $this->missionModel->getNombreSalarieMission($missionId);

    //     if ($currentCount >= $nbr) {
    //         session()->setFlashdata('error', 'Le nombre requis de salariés est déjà atteint pour cette mission.');
    //         return redirect()->to(url_to("mission_liste", $missionId));
    //     }

    //     // Assign workers to the mission until the required number is reached
    //     foreach ($availableWorkers as $worker) {
    //         if ($currentCount >= $nbr) {
    //             break; // Stop if we’ve assigned the required number of workers
    //         }

    //         $result = $this->missionModel->addSalarieMission($worker['ID_SALARIE'], $missionId);
    //         if ($result) {
    //             $currentCount++;
    //         }
    //     }

    //     session()->setFlashdata('success', 'Affectation réussie.');
    //     return redirect()->to(url_to("mission_liste", $missionId));
    // // }
}
