<?php
/**
 * Nikola Lazić 2020/0318
 */
namespace App\Models;

use CodeIgniter\Model;

/**
 * ZahtevZaOglase - model za rad sa bazom i tabelom zahtev_za_oglase
 * 
 * @version 1.0
 */
class ZahtevZaOglase extends Model
{
    protected $table      = 'zahtev_za_oglase';
    protected $primaryKey = 'idZah';

//    protected $useAutoIncrement = true;
//
//    protected $returnType     = 'array';
//    protected $useSoftDeletes = true;
//
    protected $allowedFields = ['idZah', 'idO'];
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
}
