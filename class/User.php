<?php 
    require_once 'Db.php';

    class User extends Db {

        public function __construct()
        {   
            parent::__construct('users');
        }

    }