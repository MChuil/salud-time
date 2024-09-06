<?php 
    require_once 'conexion.php';
    //CRUD (CREATE, READ, UPDATE, DELETE)

    class Db{
        protected $conexion;
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
            $resp = $stmt->get_result();
            $row = $resp->fetch_all(MYSQLI_ASSOC);
            return $row[0];
        }


        /**
         * Listar TODOS los registro de la tabla
         */
        public function getAll(){
            $sql =  "SELECT * FROM {$this->table}";
            $query = $this->conexion->query($sql);
            return $query->fetch_all(MYSQLI_ASSOC); //devuelve un array
        }

        /**
         * Buscar por una columna especificas
         */
        public function getByColumn($column, $value){
            $stmt = $this->conexion->prepare("SELECT * FROM {$this->table} WHERE {$column} = ?");
            $stmt->bind_param('s', $value);
            $stmt->execute();
            return $stmt->get_result();
        }


        public function create($data){
            $keys = implode(',', array_keys($data)); //sacamos las claves
            $values = array_values($data);
            $totalFields = count($data);
            $repeat = str_repeat('?,', $totalFields);
            $fields = substr($repeat, 0, -1);
            $sql = "INSERT INTO {$this->table} ($keys) VALUES($fields)";
            $stmt = $this->conexion->prepare($sql);

            $params = '';
            foreach($data as $value){
                if(gettype($value) == 'string'){
                    $params .='s';
                }else if(gettype($value)=='integer'){
                    $params .= 'i';
                }else if(gettype($value)=='boolean'){
                    $params .= 'b';
                }
            }
            $stmt->bind_param($params, ...$values);  //spread operator
            return $stmt->execute();
        }

        public function update($id, $data){
            $keys = implode(' = ?, ', array_keys($data)); //sacamos las claves
            $keys .= '= ?';
            echo $keys;
            $values = array_values($data);
            array_push($values, $id); //agregamos el id al array existente
            $totalFields = count($data);
            $sql = "UPDATE {$this->table} SET $keys WHERE id = ?"; 
            $stmt = $this->conexion->prepare($sql);
            $params = '';
            foreach($data as $value){
                if(gettype($value) == 'string'){
                    $params .='s';
                }else if(gettype($value)=='integer'){
                    $params .= 'i';
                }else if(gettype($value)=='boolean'){
                    $params .= 'b';
                }
            }
            $params .= 'i';
            $stmt->bind_param($params, ...$values);  //spread operator
            return $stmt->execute();

        }


        public function delete($id){
            $sql = "DELETE FROM {$this->table} WHERE id = ?";
            $stmt = $this->conexion->prepare(($sql));
            $stmt->bind_param('i', $id);
            $stmt->execute();
        }


    }