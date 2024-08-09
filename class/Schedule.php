<?php 
    require_once 'Db.php';

    class Schedule extends Db{

        public function __construct()
    {   
       
        parent::__construct('schedules');
    }
        
    }