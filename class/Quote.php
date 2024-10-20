<?php 
require_once 'Db.php';

class Quote extends Db {

    public function __construct()
    {   
        parent::__construct('quotes');
    }

    public function getByDoctorAndDateTime($doctorId, $date, $hour) {
        $sql = "SELECT * FROM quotes WHERE doctor_id = ? AND date = ? AND hour = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('iss', $doctorId, $date, $hour);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
}
