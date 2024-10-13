<?php 
    require_once 'Db.php';

    class Schedule extends Db{

    public function __construct()
    {   
        parent::__construct('schedules');
    }


    public function getAll()
    {
        $query = "SELECT schedules.id, schedules.doctor_id, schedules.days, schedules.start, schedules.end,schedules.created_at, schedules.updated_at, doctors.speciality, doctors.phone, users.name, users.lastname
                FROM schedules
                JOIN doctors ON schedules.doctor_id = doctors.id
                JOIN users ON doctors.user_id = users.id";
        $resultado = $this->conexion->query($query);
    
        
    
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($doctor_id, $days, $start, $end) {
        
        $query = "INSERT INTO schedules (doctor_id, days, start, end)
                  VALUES (?, ?, ?, ?)";

        
        $stmt = $this->conexion->prepare($query);

        
        $stmt->bind_param('isss', $doctor_id, $days, $start, $end);

        
        $stmt->execute();

        
    }



    public function getDr($user_id){
        $query = "SELECT * FROM doctors WHERE user_id ={$user_id} LIMIT 1";
        $resultado = $this->conexion->query($query);
    
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }


    public function getById($id) {
        $query = "SELECT schedules.id, schedules.doctor_id, schedules.days, schedules.start, schedules.end, 
                         users.name, users.lastname 
                  FROM schedules 
                  JOIN doctors ON schedules.doctor_id = doctors.id
                  JOIN users ON doctors.user_id = users.id
                  WHERE schedules.id = {$id}";
                  
        $resultado = $this->conexion->query($query);
    
       
    
        $row = $resultado->fetch_all(MYSQLI_ASSOC);
        return $row[0];
    }

    public function getByDoctor($id){
        $query = "SELECT days, start, end FROM schedules WHERE doctor_id = {$id}";
        $resultado = $this->conexion->query($query);
        $row = $resultado->fetch_all(MYSQLI_ASSOC);
        /*if(count($row)>0){
            return $row[0];
        }else{
            return [];
        }*/

        return (count($row)>0) ? $row[0] : [];

    }



    
    
}