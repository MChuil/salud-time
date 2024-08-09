<?php 
require_once 'Db.php';

class Quote extends Db {

    public function __construct()
    {   
        parent::__construct('quotes');
    }
}
