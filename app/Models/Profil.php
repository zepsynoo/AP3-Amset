<?php

namespace App\Models;

use CodeIgniter\Model;

class Profil extends Model
{
    protected $table            = 'profil';
    protected $primaryKey       = 'ID_PROFIL';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'LIBELLE'
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

    public function getProfilsNotSalarie($idSalarie)
    {
        $db = \Config\Database::connect(); // Connexion à la base de données

        $sql = 'SELECT profil.ID_PROFIL, profil.LIBELLE 
            FROM `profil` 
            LEFT JOIN `salarie_profil` 
            ON `salarie_profil`.`ID_PROFIL` = `profil`.`ID_PROFIL` 
            AND `salarie_profil`.`ID_SALARIE` = ? 
            WHERE `salarie_profil`.`ID_PROFIL` IS NULL;';

        // Exécution de la requête avec le paramètre lié
        return $db->query($sql, [$idSalarie])->getResultArray();
    }
    
}
