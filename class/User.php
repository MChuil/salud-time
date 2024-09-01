<?php 
    require_once 'Db.php';

    class User extends Db {
        private $conexion;
        
        public function __construct()
        {   
            parent::__construct('users');
            $conexion = new Conexion();
            $this->conexion = $conexion->conectar();
        }


        
        /* public function update($id, $data)
        {
            $sql = "UPDATE users SET name = ?, lastname= ?, email=?, password=?, type=? WHERE id = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param('sssssi', $data['name'], $data['lastname'], $data['email'], $data['password'], $data['type'], $id);
            return $stmt->execute();
        } */



        
         //funcion para traducir
         
        public function traduccion ($type) {
            $traducciones = [
                'admin' => 'Administrador',
                'receptionist' => 'Recepcionista',
                'doctor' => 'Doctor',
                'patient' => 'Paciente'
            ];
    
            return isset($traducciones[$type]) ? $traducciones[$type] : '';
        }


        
    }