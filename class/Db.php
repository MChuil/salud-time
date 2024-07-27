<?php 
    require_once 'conexion.php';
    //CRUD (CREATE, READ, UPDATE, DELETE)

    class Db{
        private $conexion;
        private $table;

        public function __construct($table)
        {
            $this->table = $table;
            $conexion = new Conexion();
            $this->conexion = $conexion->conectar();
        }

        /**
         * Buscar un registro por su ID
         */
        public function getById($id){
            $stmt = $this->conexion->prepare("SELECT * FROM {$this->table} WHERE id = ? LIMIT 1");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result();
        }


        /**
         * Listar TODOS los registro de la tabla
         */
        public function getAll(){
            $sql =  "SELECT * FROM {$this->table}";
            $query = $this->conexion->query($sql);
            return $query; //devuelve un array
        }

        /**
         * Buscar por una columna especifica
         */
        public function getByColumn($column, $value){
            $stmt = $this->conexion->prepare("SELECT * FROM {$this->table} WHERE $column = ?");
            $stmt->bind_param('s', $value);
            $stmt->execute();
            return $stmt->get_result();
        }


        public function create(){

        }


        public function update($id){

        }


        public function delete($id){

        }


    }