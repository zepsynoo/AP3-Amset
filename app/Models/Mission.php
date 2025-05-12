<?php

namespace App\Models;

use CodeIgniter\Model;

class Mission extends Model
{
    protected $table = 'mission';
    protected $primaryKey = 'ID_MISSION';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'ID_CLIENT',
        'INTITULE_MISSION',
        'DESCRIPTION_MISSION',
        'DATE_DEBUT',
        'DATE_FIN'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    //Methode pour executer une requete sql
    // pour inserer 
    public function addProfil($idMission, $idProfil, $nombreProfil)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('profil_mission');

        $builder->insert([
            'ID_MISSION' => $idMission,
            'ID_PROFIL' => $idProfil,
            'NOMBRE_PROFIL' => $nombreProfil,
        ]);
    }

    //fonction pour executer une requete sql
    // pour faire la jointure entre mission et client
    // et recuperer les missions d'un client
    public function getClientMissionProfil()
    {
        return (
            $this->select('*')
            ->join('client', 'mission.ID_CLIENT = client.ID_CLIENT')
            ->join('profil_mission', 'profil_mission.ID_MISSION = mission.ID_MISSION')
            ->join('profil', 'profil.ID_PROFIL = profil_mission.ID_PROFIL')
            ->orderBy('profil_mission.ID_MISSION')
            ->findAll()
        );
    }

    //fonction pour executer une requete sql
    // pour faire la jointure entre salarie_mission et mission
    // et recuperer les missions d'un salarie  
    public function getJoinMissionSalarie()
    {
        return (
            $this->select('*')
            ->join('salarie_mission', 'salarie_mission.ID_MISSION = mission.ID_MISSION')
            ->join('salarie', 'salarie.ID_SALARIE = salarie_mission.ID_SALARIE')
            ->orderBy('salarie_mission.ID_MISSION')
            ->findAll()
        );
    }

    /// Fonction insérant un salarie selon l'idSalarie et l'idMission
    /// ! adapter selon la base de données !

    public function addSalarieMission($idSalarie, $idMission)
    {
        $db = \Config\Database::Connect();
        $builder = $db->table('salarie_mission');
        $builder->insert([
            'ID_SALARIE' => $idSalarie,
            'ID_MISSION' => $idMission
        ]);
    }

    /// Fonction supprimant tout les salaries selon l'idMission
    /// ! adapter selon la base de données !

    public function deleteSalarieMission($missionId)
    {
        $db = \Config\Database::Connect();
        $builder = $db->table('salarie_mission');
        $builder->Where('salarie_mission.ID_MISSION', $missionId);
        // $builder->Where('salarie_mission.ID_SALARIE', $salarieId);
        $builder->delete();
    }

    public function getMissionClient()
    {
        return (
            $this->select('*')
            ->join('client', 'mission.ID_CLIENT = client.ID_CLIENT')
            ->orderBy('mission.ID_MISSION')
            ->findAll()

        );
    }


    // Join sur mission et profil

    public function getMissionProfil($idmission)
    {
        return (
            $this->select('pm.ID_PROFIL, pm.ID_MISSION, pm.NOMBRE_PROFIL, p.LIBELLE')
            ->from('profil_mission pm')
            ->join('mission m', 'm.ID_MISSION = pm.ID_MISSION')
            ->join('profil p', 'p.ID_PROFIL = pm.ID_PROFIL')
            ->where('pm.ID_MISSION', $idmission)
            ->groupBy('pm.ID_PROFIL') // Grouper par ID_PROFIL pour éviter les doublons
            ->orderBy('pm.ID_PROFIL')
            ->findAll()
        );
    }


    //Methode pour afficher avec id de mission
    public function getJoinMissionInfo($missionId)
    {
        return (
            $this->select('*')
            ->join('client', 'mission.ID_CLIENT = client.ID_CLIENT')
            ->join('profil_mission', 'profil_mission.ID_MISSION = mission.ID_MISSION')
            ->join('profil', 'profil.ID_PROFIL = profil_mission.ID_PROFIL')
            ->where('mission.ID_MISSION', $missionId)
            ->orderBy('profil_mission.ID_MISSION')
            ->findAll()
        );
    }

    public function deleteProfil($missionId, $profilId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('profil_mission');
        $builder->where('ID_MISSION', $missionId);
        $builder->where('ID_PROFIL', $profilId);
        $builder->delete();
    }

    public function deleteProfilMission($missionId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('profil_mission');
        $builder->where('ID_MISSION', $missionId);
        // $builder->where('ID_PROFIL', $profilId);
        $builder->delete();
    }
    
    public function verifSalarieMission($missionId, $salarieId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('salarie_mission');

        $exists =
            $builder
            ->where('ID_MISSION', $missionId)
            ->where('ID_SALARIE', $salarieId)
            ->countAllResults() > 0;

        return $exists;
    }

    public function getNombreSalarieMission($missionId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('salarie_mission');

        $count = $builder
                ->where('ID_MISSION', $missionId)
                // ->where('ID_SALARIE', $salarieId)
                ->countAllResults();

        return $count; 
    }
}
