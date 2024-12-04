<?php

namespace App\Models;

use CodeIgniter\Model;

class Client extends Model
{
    protected $table            = 'client';
    protected $primaryKey       = 'ID_CLIENT';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'RAISON_SOCIAL',
        'NOM',
        'PRENOM',
        'EMAIL',
        'TELEPHONE',
        'ADRESSE',
        'CODE_POSTAL',
        'VILLE',
        'IMG'

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

    public function deleteMissionProfils($missionid){
        $db = \Config\Database::Connect();
        $builder = $db->table('profil_mission');
        $builder->where('ID_MISSION',$missionid);
        $builder->delete();

    }

    public function deleteMissionSalarie($missionid){
        $db = \Config\Database::connect();
        $builder = $db->table('salarie_mission');
        $builder->where('ID_MISSION', $missionid);
        $builder->delete();
    }


    public function deleteMissionClient($client){
        $db = \Config\Database::Connect();
        $builder = $db->table('mission');
        $builder->where('ID_CLIENT',$client);
        $builder->delete();

    }


    public function getIdMission($idClient){
        return $this->db->table('mission')
            ->select('ID_MISSION')
            ->where('ID_CLIENT', $idClient)
            ->get()
            ->getRowArray();
    }
}



