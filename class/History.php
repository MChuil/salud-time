<?php 
    require_once 'Db.php';

    class History extends Db{
        
        public function __construct()
        {
            parent::__construct('historys');
        }
    }