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

        //insertar un nuevo usuario<
        public function create($data)
        {
            $sql = "INSERT INTO users (name, lastname, email, password, type) VALUES(?, ?, ?, ?, ?)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param('sssss', $data['name'], $data['lastname'], $data['email'], $data['password'], $data['type']);
            return $stmt->execute();
        }
        
        public function update($id, $data)
        {
            $sql = "UPDATE users SET name = ?, lastname= ?, email=?, password=?, type=? WHERE id = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param('sssssi', $data['name'], $data['lastname'], $data['email'], $data['password'], $data['type'], $id);
            return $stmt->execute();
        }


        public function delete($id){
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $this->conexion->prepare(($sql));
            $stmt->bind_param('i', $id);
            $stmt->execute();
        }
    }