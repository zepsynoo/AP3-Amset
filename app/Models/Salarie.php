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

    //methode pour le filtre
    public function recupSalariesDuProfil($idProfil = null)
    {
        $builder = $this->db->table('salarie s')
            ->select('s.*, GROUP_CONCAT(p.LIBELLE SEPARATOR ", ") as profil')
            ->join('salarie_profil sp', 's.ID_SALARIE = sp.ID_SALARIE')
            ->join('profil p', 'p.ID_PROFIL = sp.ID_PROFIL');

        // Filtrer par ID_PROFIL si nécessaire
        if ($idProfil !== null) {
            $builder->where('p.ID_PROFIL', $idProfil);
        }

        return $builder->groupBy('s.ID_SALARIE, p.ID_PROFIL')
            ->get()
            ->getResultArray();
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

    // supprime l'id du salarier dans la table "salarie_profil" 
    public function deleteProfilsSalarie($idSalarie)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('salarie_profil');
        $builder->where('ID_SALARIE', $idSalarie);
        $builder->delete();
    }

    // supprime l'id du salarier dans la table "salarie_mission" 
    public function deleteMissionSalarie($idSalarie)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('salarie_mission');
        $builder->where('ID_SALARIE', $idSalarie);
        $builder->delete();
    }

    // supprime l'id du profils et du salarier dans la table "salarie_profil"
    public function deleteProfilSalarie($idSalarie, $idProfil)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('salarie_profil');
        $builder->where('ID_SALARIE', $idSalarie);
        $builder->where('ID_PROFIL', $idProfil);
        $builder->delete();
    }


    public function recupSalariesDeCertification($idProfil = null)
    {
        $builder = $this->db->table('salarie s')
            ->select('s.*, GROUP_CONCAT(p.LIBELLE SEPARATOR ", ") as certification')
            ->join('salarie_profil sp', 's.ID_SALARIE = sp.ID_SALARIE')
            ->join('profil p', 'p.ID_PROFIL = sp.ID_PROFIL');

        // Filtrer par ID_PROFIL si nécessaire
        if ($idProfil !== null) {
            $builder->where('p.ID_CERTIFICATION', $idProfil);
        }

        return $builder->groupBy('s.ID_SALARIE, p.ID_PROFIL')
            ->get()
            ->getResultArray();
    }

    public function findAllAvecProfilsCertification()
    {
        return $this->db->table('salarie')
            ->select('salarie.*, GROUP_CONCAT(profil.LIBELLE SEPARATOR ", ") as profil , GROUP_CONCAT(certification.LIBELLE_CERTIFICATION SEPARATOR ", ") as LIBELLE_CERTIFICATION')
            ->join('salarie_profil', 'salarie.ID_SALARIE = salarie_profil.ID_SALARIE', 'left')
            ->join('profil', 'salarie_profil.ID_PROFIL = profil.ID_PROFIL', 'left')
            ->join('certification_salarie', 'certification_salarie.ID_SALARIE = salarie.ID_SALARIE', 'left')
            ->join('certification', 'certification.ID_CERTIFICATION = certification_salarie.ID_CERTIFICATION', 'left')
            ->groupBy('salarie.ID_SALARIE')
            ->get()
            ->getResultArray();
    }

    public function addCertification($idCertification, $nouvelSalarieID)
    {
        if ($idCertification != null) {
            $db = \Config\Database::connect();
            $builder = $db->table('certification_salarie');

            $builder->insert([
                'ID_CERTIFICATION' => $idCertification,
                'ID_SALARIE' => $nouvelSalarieID
            ]);

            // var_dump($idProfil, $idSalarie);
            // die();
        }
    }
}
