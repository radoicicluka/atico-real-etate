<?php
/**
 * Luka Radoičić 2020/0085
 * Nikola Lazić 2020/0318
 */
namespace App\Models;

use CodeIgniter\Model;

/**
 * ZahtevZaLicitaciju - model za rad sa bazom i tabelom zahtev_za_licitaciju
 * 
 * @version 1.0
 */
class ZahtevZaLicitaciju extends Model
{
    protected $table      = 'zahtev_za_licitaciju';
    protected $primaryKey = 'idZah';

    protected $useAutoIncrement = true;
//
//    protected $returnType     = 'array';
//    protected $useSoftDeletes = true;
//
    protected $allowedFields = ['idZah', 'idO', 'datum', 'cena'];
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
