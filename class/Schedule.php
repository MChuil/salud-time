<?php 
    require_once 'Db.php';

    class Schedule extends Db{

        public function __construct()
    {   
       
        parent::__construct('schedules');
    }


    public function getAll()
    {
        $query = "SELECT schedules.id, schedules.doctor_id, schedules.days, schedules.start, schedules.end, 
                         schedules.created_at, schedules.updated_at, doctors.speciality, doctors.phone
                  FROM schedules
                  JOIN doctors ON schedules.doctor_id = doctors.id";
        $resultado = $this->conexion->query($query);
    
        
    
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
        
    }