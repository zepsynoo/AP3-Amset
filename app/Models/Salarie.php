<?php

namespace App\Models;

use CodeIgniter\Model;

class Salarie extends Model
{
    protected $table            = 'salarie';
    protected $primaryKey       = 'ID_SALARIE';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'NOM_SALARIE',
        'PRENOM_SALARIE',
        'CIVILITE',
        'EMAIL_SALARIE',
        'TELEPHONE_SALARIE',
        'ADRESSE_SALARIE',
        'CODE_POSTAL_SALARIE',
        'VILLE_SALARIE',
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
}
