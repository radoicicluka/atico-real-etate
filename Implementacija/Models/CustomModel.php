<?php

    namespace App\Models;
    
    use CodeIgniter\Database\ConnectionInterface;
    
    class CustomModel{
        
        protected $db;
        
        public function __construct(ConnectionInterface &$db) {
            $this->db =& $db;
        }
        
        function getTable(){
            $posts = $this->db->table('korisnik')->get()->getResult();
            return $posts;
        }
        
    }
    
    