<?php
    namespace config;
    use config\Conexion;
    use PDO;
    require_once realpath('.../../vendor/autoload.php');
    class ORM{
        protected $tabla;
        protected $id_tabla;
        protected $atributos;
        private $query;
        private $contadorWhere;
        function __construct(){
            $this->atributos = $this->atributos_tabla();        
        }
  
        private function atributos_tabla(){
            $consulta = Conexion::obtener_conexion()->prepare("DESCRIBE $this->tabla");
            $consulta->execute();
            $campos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $atributos = [];
            foreach($campos as $campo){
                array_push($atributos,$campo['Field']);              
            }
            return $atributos;        
        }

        public function where($campo,$valor_campo,$tipo="AND"){
            $queryFinal = $this->query;
            if($this->contadorWhere > 0){
                $this->query = "$queryFinal ".($tipo != "AND" ? 'OR' : $tipo)." $campo = '$valor_campo'";
            }else{
                $this->query = "$queryFinal WHERE $campo = '$valor_campo'";
            }
            $this->contadorWhere++;
            return $this;            
        }

        public function all(){
            $queryFinal = $this->query;
            $consulta = Conexion::obtener_conexion()->prepare($queryFinal);
            if($consulta->execute()){
                $data = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $data = [];
            }    
            return $data;        
        }
        public function first(){
            $queryFinal = $this->query;
            $consulta = Conexion::obtener_conexion()->prepare($queryFinal);
            if($consulta->execute()){
                $data = $consulta->fetch(PDO::FETCH_ASSOC);
            }else{
                $data = [];
            }    
            return $data;        
        }

        public function get(){
            $queryFinal = $this->query;
            $consulta = Conexion::obtener_conexion()->prepare($queryFinal);
            return $consulta->execute(); 
        }

        public function consulta($seleccion = ['*']){
            $seleccion = implode(',',$seleccion);
            $this->query = "SELECT $seleccion FROM $this->tabla";
            return  $this;
        }

        public function insercion($datos){
            $temp = array();
            foreach($this->atributos as $valor){
                if($this->id_tabla != $valor){
                    array_push($temp,$valor);                    
                }
            }
            $propiedades = implode(",", $temp);
            $propiedades_key = ":" . implode(", :", $temp);
            $consulta = Conexion::obtener_conexion()->prepare("INSERT INTO $this->tabla ($propiedades) VALUES ($propiedades_key)");
            return $consulta->execute($datos);
        }

        public function actualizar($datos){
            $queryBloque = [];
            foreach(array_keys($datos) as $key ){
                if($this->id_tabla != $key){
                    array_push($queryBloque,$key.'='."'$datos[$key]'");
                }
            }
            $queryBloque = implode(', ',$queryBloque);
            $this->query = "UPDATE $this->tabla SET $queryBloque";
            return $this;
        }

        public function eliminar(){
            $this->query = "DELETE FROM $this->tabla";
            return $this;
        }
    }
?>