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
            if ($password == $user['password']) {
                return $user;
            } else {
              return false;
            }
        } else {
            return false;
        }
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
