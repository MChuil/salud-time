<?php 
    require_once 'Db.php';

    class Patient extends Db{
        
        public function __construct()
        {
            parent::__construct('patients');
        }

        public function getAll() {
            $sql = "SELECT patients.id, patients.name, patients.birthday, patients.address, patients.phone, patients.sex FROM patients";
            $query = $this->conexion->query($sql);
            return $query->fetch_all(MYSQLI_ASSOC); 
        }






    }