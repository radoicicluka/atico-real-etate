<?php

/**
 * Nikola Lazić 2020/0318
 * Stefan Dumić 2020/0012
 */
namespace App\Models;

use CodeIgniter\Model;

/**
 * Oglas - model za rad sa bazom i tabelom oglas
 * 
 * @version 1.0
 */
class Oglas extends Model
{
    protected $table      = 'oglas';
    protected $primaryKey = 'idO';

    protected $useAutoIncrement = true;
//
//    protected $returnType     = 'array';
//    protected $useSoftDeletes = true;
//
   protected $allowedFields = ['idO', 'korImeAgent', 'korImeKlijent', 'naziv', 'opis', 'cena', 'adresa', 'brSoba','kvadratura', 'opstina','grejanje','aktivan','grad','prodat','agencija'];
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
 * Dohvatanje oglasa korišćenjem ID oglasa
 * 
 * @param int $idO ID oglasa
 * @return object
 */
function getOglas($idO){
    return $this->where('idO', $idO)->get()->getRow();
}

}
