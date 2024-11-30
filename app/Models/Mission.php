<?php

namespace App\Models;

use CodeIgniter\Model;

class Mission extends Model
{
    protected $table            = 'mission';
    protected $primaryKey       = 'ID_MISSION';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ID_CLIENT',
        'INTITULE_MISSION',
        'DESCRIPTION_MISSION',
        'DATE_DEBUT',
        'DATE_FIN'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function addProfil($idMission, $idProfil, $nombreProfil)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('profil_mission');

        $builder->insert([
            'ID_MISSION' => $idMission,
            'ID_PROFIL' => $idProfil,
            'NOMBRE_PROFIL' => $nombreProfil,
        ]);
    }

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
}
