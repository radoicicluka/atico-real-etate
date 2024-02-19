<?php
/**
 * Luka Radoičić 2020/0085
 * Nikola Lazić 2020/0318
 */
namespace App\Models;

use CodeIgniter\Model;

/**
 * Korisnik - model za rad sa bazom i tabelom korisnik
 * 
 * @version 1.0
 */
class Korisnik extends Model
{
    protected $table      = 'korisnik';
    protected $primaryKey = 'korIme';

//    protected $useAutoIncrement = true;
//
//    protected $returnType     = 'array';
//    protected $useSoftDeletes = true;
//
   protected $allowedFields = ['ime', 'prezime', 'email','korIme','lozinka'];
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
     * Dohvatanje korisnika iz baze.
     * 
     * @return object
     */
    function getKorisnik($korIme){
        return $this->where('korIme', $korIme)->get()->getRow();
    }


}
