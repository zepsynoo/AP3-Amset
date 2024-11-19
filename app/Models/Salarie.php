<?php

namespace App\Models;

use CodeIgniter\Model;

class Salarie extends Model
{
    protected $table = 'salarie';
    protected $primaryKey = 'ID_SALARIE';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
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

    // insertion dans la table "salarie_profils" (ajoute  un  profils au salarie)
    public function addProfil($idProfil, $idSalarie)
    {
        if ($idProfil != null) {
            $db = \Config\Database::connect();
            $builder = $db->table('salarie_profil');

            $builder->insert([
                'ID_PROFIL' => $idProfil,
                'ID_SALARIE' => $idSalarie
            ]);

            // var_dump($idProfil, $idSalarie);
            // die();
        }
    }

    //retourne tout les profils qui sont crée dans la  table profils
    public function getProfil($idSalarie)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('salarie_profil');
        $builder->join('profil', 'profil.ID_PROFIL = salarie_profil.ID_PROFIL');
        $query = $builder->getWhere(['ID_SALARIE' => $idSalarie]);
        return $query->getResultArray();
    }

    // affiche tout les profils du salrier qui sont relier au lui
    public function findAllAvecProfils()
    {
        return $this->db->table('salarie')
            ->select('salarie.*, GROUP_CONCAT(profil.LIBELLE SEPARATOR ", ") as profil')
            ->join('salarie_profil', 'salarie.ID_SALARIE = salarie_profil.ID_SALARIE', 'left')
            ->join('profil', 'salarie_profil.ID_PROFIL = profil.ID_PROFIL', 'left')
            ->groupBy('salarie.ID_SALARIE')
            ->get()
            ->getResultArray();
    }
    //----------------------------------------------------------------------
    // delete

    // supprime l'id du salarier dans la table "salarie_profil" et odns tou tles profils du salarie
    public function deleteProfilsSalarie($idSalarie)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('salarie_profil');
        $builder->where('ID_SALARIE', $idSalarie);
        $builder->delete();
    }

    // supprime l'id du profils qui et selection par le salarie dans la table "salarie_profil"
    public function deleteProfilSalarie($idSalarie, $idProfil)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('salarie_profil');
        $builder->where('ID_SALARIE', $idSalarie);
        $builder->where('ID_PROFIL', $idProfil);
        $builder->delete();
    }
}
