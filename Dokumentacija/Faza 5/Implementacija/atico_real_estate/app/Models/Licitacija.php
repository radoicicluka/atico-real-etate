<?php
/**
 * Luka Radoičić 2020/0085
 * Nikola Lazić 2020/0318
 * Stefan Dumić 2020/0012
 */

namespace App\Models;

use CodeIgniter\Model;

/**
 * Licitacija - model za rad sa bazom i tabelom licitacija
 * 
 * @version 1.0
 */
class Licitacija extends Model
{
    protected $table      = 'licitacija';
    protected $primaryKey = 'idLic';

//    protected $useAutoIncrement = true;
//
//    protected $returnType     = 'array';
//    protected $useSoftDeletes = true;
//
    protected $allowedFields = ['idLic', 'korImeKlijent', 'idO','trenutnaCena','vremeKraj'];
//
//    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
//
//    // Validation
//    protected $validationRules      = [];
//    protected $validationMessages   = [];
//    protected $skipValidation       = false;
//    protected $cleanValidationRules = true;
//
//    // Callbacks
//    protected $allowCallbacks = true;
//    protected $beforeInsert   = [];
//    protected $afterInsert    = [];
//    protected $beforeUpdate   = [];
//    protected $afterUpdate    = [];
//    protected $beforeFind     = [];
//    protected $afterFind      = [];
//    protected $beforeDelete   = [];
//    protected $afterDelete    = [];
    /**
     * Dohvatanje licitacije korišćenjem ID oglasa
     * 
     * @param int $idO ID Oglasa
     * @return object
     */
    function dohvatiLicitaciju($idO){
        return $this->where('idO', $idO)->get()->getRow();
    }
}
