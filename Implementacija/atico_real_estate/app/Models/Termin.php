<?php
/**
 * Nikola Lazić 2020/0318
 * Stefan Dumić 2020/0012
 */
namespace App\Models;

use CodeIgniter\Model;

/**
 * Termin - model za rad sa bazom i tabelom termin
 * 
 * @version 1.0
 */
class Termin extends Model
{
    protected $table      = 'termin';
    protected $primaryKey = 'idTer';

    protected $useAutoIncrement = true;
//
//    protected $returnType     = 'array';
//    protected $useSoftDeletes = true;
//
   protected $allowedFields = ['idTer', 'korImeAgent','korImeKlijent' ,'datumVreme', 'idO'];
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
