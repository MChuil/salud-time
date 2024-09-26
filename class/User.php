<?php
require_once 'Db.php';

class User extends Db
{

    public function __construct()
    {
        parent::__construct('users');
    }

    public function login($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $resultado = $this->conexion->query($query);
        if ($resultado->num_rows > 0) {
            $user = $resultado->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //listar usuarios de tipo Doctor
    public function listDoctors(){
        $sql = "SELECT id, name, lastname FROM users WHERE type = 'doctor'";
        $query = $this->conexion->query($sql);
        return $query->fetch_all(MYSQLI_ASSOC); //devuelve un array
    }
    
    //funcion para traducir

    public function traduccion($type)
    {
        $traducciones = [
            'admin' => 'Administrador',
            'receptionist' => 'Recepcionista',
            'doctor' => 'Doctor',
            'patient' => 'Paciente'
        ];

        return isset($traducciones[$type]) ? $traducciones[$type] : '';
    }
}
