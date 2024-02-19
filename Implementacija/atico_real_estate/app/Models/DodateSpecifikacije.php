<?php
/**
 * Luka Radoičić 2020/0085
 * Nikola Lazić 2020/0318
 */

namespace App\Models;

use CodeIgniter\Model;

/**
 * DodatneSpecifikacije - model za rad sa bazom i tabelom dodatne_specifikacije
 * 
 * @version 1.0
 */
class DodateSpecifikacije extends Model
{
    protected $table      = 'dodate_specifikacije';
    //protected $primaryKey = 'korIme';

//    protected $useAutoIncrement = true;
//
//    protected $returnType     = 'array';
//    protected $useSoftDeletes = true;
//
//    protected $allowedFields = ['name', 'email'];
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
     * Dohvatanje naziva specifikacije.
     * 
     * @param int $idS ID specifikacije
     * @return string
     */
    function dohvatiNaziv($idS){
        return $this->where('idS', $idS)->get()->getRow()->naziv;
    }
}
