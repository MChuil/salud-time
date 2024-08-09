<?php 
    require_once 'Db.php';

    class Doctor extends Db{
        
        public function __construct()
        {
            parent::__construct('doctors');
        }
    }