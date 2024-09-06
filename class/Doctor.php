<?php 
    require_once 'Db.php';

    class Doctor extends Db{
        
        public function __construct()
        {
            parent::__construct('doctors');
        }

        public function getAll(){
            $sql = "SELECT doctors.id, doctors.speciality, doctors.phone, users.name, users.lastname, users.email FROM doctors JOIN users ON doctors.user_id = users.id";
            $query = $this->conexion->query($sql);
            return $query->fetch_all(MYSQLI_ASSOC); 
        }
    }