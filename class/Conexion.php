<?php

    require_once 'settings/config.php';

    class Conexion {
        private $host = 'localhost'; 
        private $dbname = 'salud_time';
        private $username = 'root'; 
        private $password = '';
        private $conexion;

        
        public function conectar() {
            $this->conexion = new mysqli($this->host, $this->username, $this->password, $this->dbname);

            if ($this->conexion->connect_error) {
                die('Error de conexión (' . $this->conexion->connect_errno . ') '
                    . $this->conexion->connect_error);
            }

            return $this->conexion;
        }

        
    }

