<?php 
    require_once 'Db.php';

    class Doctor extends Db{
        
        public function __construct()
        {
            parent::__construct('doctors');
        }

        public function getAll()
        {
            $query = "SELECT doctors.id, doctors.speciality, doctors.phone, users.name, users.lastname, users.email 
                      FROM doctors 
                      JOIN users ON doctors.user_id = users.id";
            $resultado = $this->conexion->query($query);
        
            if ($resultado === false) {
                echo 'Error en la consulta: ' . $this->conexion->error;
                return [];
            }
        
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
    }
?>

    