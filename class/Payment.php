<?php 
    require_once 'Db.php';

    class Payment extends Db{
        
        
        public function __construct()
        {   
            parent::__construct('payments');
        }
    }