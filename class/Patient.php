<?php 
    require_once 'Db.php';

    class Patient extends Db{
        
        public function __construct()
        {
            parent::__construct('patients');
        }
    }