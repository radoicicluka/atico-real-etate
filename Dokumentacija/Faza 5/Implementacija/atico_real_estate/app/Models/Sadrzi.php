<?php
/**
 * Luka Radoičić 2020/0085
 * Nikola Lazić 2020/0318
 * Stefan Dumić 2020/0012
 */
namespace App\Models;

use CodeIgniter\Model;

/**
 * Sadrzi - model za rad sa bazom i tabelom sadrzi
 * 
 * @version 1.0
 */
class Sadrzi extends Model
{
    protected $table      = 'sadrzi';
    protected $primaryKey = 'idO';

//    protected $useAutoIncrement = true;
//
//    protected $returnType     = 'array';
//    protected $useSoftDeletes = true;
//
   protected $allowedFields = ['idS', 'idO'];
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
     * Dohvatanje dodatnih specifikacija za dati oglas.
     * 
     * @param int $idO
     * @return array
     */
    function dohvatiDodatneSpecifikacije($idO){
        return $this->where('idO', $idO)->get()->getResult();
    }
    
    /**
     * Provera da li oglas dati oglas sadrzi datu specifikacju
     * 
     * @param int $idO
     * @param int $idS
     * @return bool
     */
    function oglasSadrziSpecifikaciju($idO, $idS){
        if ($this->where('idO', $idO)->where('idS', $idS)->get()->getResult()) return true;
        return false;
    }

}
