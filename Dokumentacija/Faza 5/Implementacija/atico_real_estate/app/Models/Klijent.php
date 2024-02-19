<?php

/**
 * Nikola Lazić 2020/0318
 */
namespace App\Models;

use CodeIgniter\Model;

/**
 * Klijent - model za rad sa bazom i tabelom klijent
 * 
 * @version 1.0
 */
class Klijent extends Model
{
    protected $table      = 'klijent';
    protected $primaryKey = 'korIme';

//    protected $useAutoIncrement = true;
//
//    protected $returnType     = 'array';
//    protected $useSoftDeletes = true;
//
    protected $allowedFields = ['korIme', 'aktivan'];
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
